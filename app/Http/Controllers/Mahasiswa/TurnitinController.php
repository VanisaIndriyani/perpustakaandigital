<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\TurnitinSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TurnitinController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $submissions = TurnitinSubmission::query()
            ->where('user_id', Auth::id())
            ->when($q !== '', function ($query) use ($q) {
                $query->where('judul', 'like', "%{$q}%");
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('mahasiswa.turnitin.index', [
            'submissions' => $submissions,
            'statusOptions' => TurnitinSubmission::statusOptions(),
            'q' => $q,
        ]);
    }

    public function create()
    {
        return view('mahasiswa.turnitin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:180'],
            'file_doc' => ['required', 'file', 'max:51200', 'mimes:pdf,doc,docx'],
        ], [
            'file_doc.uploaded' => 'Dokumen gagal diunggah. Pastikan ukuran file tidak melebihi batas server (max 50MB) dan koneksi stabil.',
        ]);

        $path = $request->file('file_doc')->store('turnitin/submissions', 'public');

        TurnitinSubmission::query()->create([
            'user_id' => Auth::id(),
            'judul' => $validated['judul'],
            'file_doc' => $path,
            'status' => 'submitted',
        ]);

        return redirect()->route('mahasiswa.turnitin.index')
            ->with('status', 'Pengajuan Turnitin berhasil dikirim.');
    }
}

