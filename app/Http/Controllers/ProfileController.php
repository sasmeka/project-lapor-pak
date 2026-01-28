<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Tampilkan profil user (READ ONLY)
     */
    public function index(): View
    {
        return view('profile.index', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Form edit profil (no_telp & alamat)
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update no telp & alamat
     */
   public function update(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'phone'  => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Kalau email berubah → reset verifikasi
        if ($request->email !== $user->email) {
            $user->email_verified_at = null;
        }

        $user->update([
            'name'   => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('profile.index')
            ->with('success', 'Profil berhasil diperbarui');
    }



    /**
     * Hapus akun (opsional, biarkan default Laravel)
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
