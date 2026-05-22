<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\TurnitinSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TurnitinController extends Controller
{
    public function index()
    {
        $submissions = TurnitinSubmission::query()
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(12);

        return view('mahasiswa.turnitin.index', [
            'submissions' => $submissions,
            'statusOptions' => TurnitinSubmission::statusOptions(),
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
            'file_doc' => ['required', 'file', 'max:20480', 'mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
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

