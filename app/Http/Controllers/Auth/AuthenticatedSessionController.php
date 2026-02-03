<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah.',
            ]);
        }

        $user = Auth::user();

        // if (!$user->is_active) {
        //     Auth::logout();

        //     throw ValidationException::withMessages([
        //         'email' => 'Akun Anda saat ini dinonaktifkan. Silakan hubungi Ketua RT untuk proses aktivasi kembali.',
        //     ]);
        // }

        if (!$user->is_active) {
            Auth::logout();

            if ($user->role === 'admin') {
                $message = 'Akun admin Anda saat ini dinonaktifkan. Silakan hubungi Super Admin untuk proses aktivasi kembali.';
            } else {
                $message = 'Akun Anda saat ini dinonaktifkan. Silakan hubungi Ketua RT untuk proses aktivasi kembali.';
            }

            throw ValidationException::withMessages([
                'email' => $message,
            ]);
        }


        // REDIRECT BERDASARKAN ROLE
        if (in_array($user->role, ['admin', 'superAdmin'])) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
