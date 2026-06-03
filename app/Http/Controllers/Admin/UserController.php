<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $role = $request->query('role', '');

        $users = User::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('nim', 'like', "%{$q}%");
                });
            })
            ->when($role !== '', function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.user.index', [
            'users' => $users,
            'q' => $q,
            'role' => $role,
        ]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['admin', 'staf', 'mahasiswa', 'dosen'])],
            'nim' => ['nullable', 'string', 'max:50', 'unique:users,nim'],
            'phone' => ['nullable', 'string', 'max:20'],
            'kta' => ['nullable', 'image', 'max:2048'],
        ]);

        $ktaPath = null;
        if ($request->hasFile('kta')) {
            $ktaPath = $request->file('kta')->store('kta', 'public');
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'password_plain' => $validated['password'], // Pakai hasil validasi agar pasti terisi
            'role' => $validated['role'],
            'nim' => $validated['nim'],
            'phone' => $validated['phone'],
            'kta_path' => $ktaPath,
        ]);

        return redirect()
            ->route('admin.user.index')
            ->with('status', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['admin', 'staf', 'mahasiswa', 'dosen'])],
            'nim' => ['nullable', 'string', 'max:50', Rule::unique('users', 'nim')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'kta' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('kta')) {
            $validated['kta_path'] = $request->file('kta')->store('kta', 'public');
        }

        if (!empty($validated['password'])) {
            $validated['password_plain'] = $validated['password'];
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('admin.user.index')
            ->with('status', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'Anda tidak bisa menghapus akun sendiri.']);
        }

        $user->delete();

        return redirect()
            ->route('admin.user.index')
            ->with('status', 'User berhasil dihapus.');
    }

    public function exportPdf(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $role = $request->query('role', '');

        if (!class_exists(Pdf::class)) {
            return redirect()
                ->route('admin.user.index', ['q' => $q, 'role' => $role])
                ->with('status', 'Export PDF belum bisa dipakai di hosting karena library PDF belum terpasang.');
        }

        $items = User::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('nim', 'like', "%{$q}%");
                });
            })
            ->when($role !== '', function ($query) use ($role) {
                $query->where('role', $role);
            })
            ->latest()
            ->get();

        $logoPath = public_path('logo.jpeg');
        $logoDataUri = null;
        if (is_file($logoPath)) {
            $logoDataUri = 'data:image/jpeg;base64,' . base64_encode((string) file_get_contents($logoPath));
        }

        $pdf = Pdf::loadView('admin.user.export_pdf', [
            'items' => $items,
            'q' => $q,
            'role' => $role,
            'logoDataUri' => $logoDataUri,
            'generatedAt' => now(),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('users-' . now()->format('Ymd-His') . '.pdf');
    }
}
