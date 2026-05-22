<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TurnitinSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TurnitinController extends Controller
{
    public function index(Request $request)
    {
        $status = (string) $request->query('status', '');
        $q = trim((string) $request->query('q', ''));

        $submissions = TurnitinSubmission::query()
            ->with('user')
            ->when($status !== '', fn ($query) => $query->where('status', $status))
            ->when($q !== '', function ($query) use ($q) {
                $query->where('judul', 'like', "%{$q}%")
                    ->orWhereHas('user', function ($u) use ($q) {
                        $u->where('name', 'like', "%{$q}%")
                            ->orWhere('email', 'like', "%{$q}%")
                            ->orWhere('nim', 'like', "%{$q}%");
                    });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.turnitin.index', [
            'submissions' => $submissions,
            'status' => $status,
            'q' => $q,
            'statusOptions' => TurnitinSubmission::statusOptions(),
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
}

