<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return Auth::user()->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('mahasiswa.dashboard');
        }

        return view('mahasiswa.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $request->user()?->forceFill(['last_login_at' => now()])->save();

            $userRole = $request->user()?->role;
            $default = $userRole === 'admin'
                ? route('admin.dashboard')
                : route('mahasiswa.dashboard');

            $intended = $request->session()->get('url.intended');
            $intendedPath = is_string($intended) ? (parse_url($intended, PHP_URL_PATH) ?: null) : null;
            $intendedIsAdmin = is_string($intendedPath) && str_starts_with($intendedPath, '/admin');

            if ($userRole === 'admin' && !$intendedIsAdmin) {
                $request->session()->forget('url.intended');
            }

            if ($userRole !== 'admin' && $intendedIsAdmin) {
                $request->session()->forget('url.intended');
            }

            return redirect()->intended($default);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Email atau password tidak valid.',
            ]);
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return Auth::user()->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('mahasiswa.dashboard');
        }

        return view('mahasiswa.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'nim' => ['required', 'string', 'max:30', Rule::unique('users', 'nim')],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::query()->create([
            'name' => $validated['name'],
            'nim' => $validated['nim'],
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'mahasiswa',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        $user->forceFill(['last_login_at' => now()])->save();

        return redirect()->route('mahasiswa.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
