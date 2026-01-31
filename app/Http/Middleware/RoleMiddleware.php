<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Belum login → lempar ke login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // User nonaktif
        if (!$user->is_active) {
            Auth::logout();
            abort(403, 'Akun dinonaktifkan.');
        }

        // Kalau route tidak kirim role parameter → biarkan lewat
        if (empty($roles)) {
            return $next($request);
        }

        // Role tidak sesuai
        if (!in_array($user->role, $roles)) {
            abort(403, 'Tidak punya akses.');
        }

        return $next($request);
    }
}
