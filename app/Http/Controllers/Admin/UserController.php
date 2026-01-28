<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(4)
            ->withQueryString();

        return view('admin.user.index', compact('users'));
    }

    public function toggle(User $user)
    {
        if ($user->role !== 'user') {
            return back();
        }

        $user->is_active = !$user->is_active;
        $user->save();

        activityAdmin(
            'Mengubah status user ' . $user->name . ' menjadi ' . ($user->is_active ? 'Aktif' : 'Nonaktif'),
            'User',
            $user->id
        );


        return back()->with('success', 'Status user berhasil diperbarui');
    }
}
