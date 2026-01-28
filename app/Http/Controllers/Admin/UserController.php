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

        return back()->with('success', 'Status user berhasil diperbarui');
    }
}
