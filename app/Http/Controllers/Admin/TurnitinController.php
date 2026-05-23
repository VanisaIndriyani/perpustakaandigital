<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TurnitinSubmission;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TurnitinController extends Controller
{
    public function index(Request $request)
    {
        $status = (string) $request->query('status', '');
        $q = trim((string) $request->query('q', ''));

        $baseQuery = TurnitinSubmission::query()
            ->with('user')
            ->when($q !== '', function ($query) use ($q) {
                $query->where('judul', 'like', "%{$q}%")
                    ->orWhereHas('user', function ($u) use ($q) {
                        $u->where('name', 'like', "%{$q}%")
                            ->orWhere('email', 'like', "%{$q}%")
                            ->orWhere('nim', 'like', "%{$q}%");
                    });
            });

        $submissions = (clone $baseQuery)
            ->when($status !== '', fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $summaryQuery = TurnitinSubmission::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where('judul', 'like', "%{$q}%")
                    ->orWhereHas('user', function ($u) use ($q) {
                        $u->where('name', 'like', "%{$q}%")
                            ->orWhere('email', 'like', "%{$q}%")
                            ->orWhere('nim', 'like', "%{$q}%");
                    });
            });

        $summary = [
            'total' => (clone $summaryQuery)->count(),
            'submitted' => (clone $summaryQuery)->where('status', 'submitted')->count(),
            'checking' => (clone $summaryQuery)->where('status', 'checking')->count(),
            'completed' => (clone $summaryQuery)->where('status', 'completed')->count(),
        ];

        return view('admin.turnitin.index', [
            'submissions' => $submissions,
            'status' => $status,
            'q' => $q,
            'statusOptions' => TurnitinSubmission::statusOptions(),
            'summary' => $summary,
        ]);
    }

    public function update(Request $request, TurnitinSubmission $turnitinSubmission)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:submitted,checking,completed'],
            'similarity_percent' => ['nullable', 'integer', 'min:0', 'max:100'],
            'report_pdf' => ['nullable', 'file', 'max:20480', 'mimetypes:application/pdf'],
            'catatan_admin' => ['nullable', 'string', 'max:255'],
        ]);

        if ($request->hasFile('report_pdf')) {
            $newReport = $request->file('report_pdf')->store('turnitin/reports', 'public');
            if ($turnitinSubmission->report_pdf) {
                Storage::disk('public')->delete($turnitinSubmission->report_pdf);
            }
            $validated['report_pdf'] = $newReport;
        }

        $turnitinSubmission->update($validated);

        return back()->with('status', 'Turnitin diperbarui.');
    }

    public function exportPdf(Request $request)
    {
        $status = (string) $request->query('status', '');
        $q = trim((string) $request->query('q', ''));

        $query = TurnitinSubmission::query()
            ->with('user')
            ->when($status !== '', fn ($q1) => $q1->where('status', $status))
            ->when($q !== '', function ($q1) use ($q) {
                $q1->where('judul', 'like', "%{$q}%")
                    ->orWhereHas('user', function ($u) use ($q) {
                        $u->where('name', 'like', "%{$q}%")
                            ->orWhere('email', 'like', "%{$q}%")
                            ->orWhere('nim', 'like', "%{$q}%");
                    });
            })
            ->latest();

        $items = $query->get();

        $logoPath = public_path('logo.jpeg');
        $logoDataUri = null;
        if (is_file($logoPath)) {
            $logoDataUri = 'data:image/jpeg;base64,' . base64_encode((string) file_get_contents($logoPath));
        }

        $pdf = Pdf::loadView('admin.turnitin.export_pdf', [
            'items' => $items,
            'status' => $status,
            'q' => $q,
            'logoDataUri' => $logoDataUri,
            'statusOptions' => TurnitinSubmission::statusOptions(),
            'generatedAt' => now(),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('turnitin-' . now()->format('Ymd-His') . '.pdf');
    }
}
