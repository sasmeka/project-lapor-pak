<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::whereIn('role', ['admin','superAdmin'])->latest()->get();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',          // DEFAULT ADMIN
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.admins.index')
            ->with('success', 'Admin berhasil ditambahkan');
    }

    public function edit(User $admin)
    {
        if (!in_array($admin->role, ['admin','superAdmin'])) {
            abort(403);
        }

        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()
            ->route('admin.admins.index')
            ->with('success', 'Data admin diperbarui');
    }

    /**
     * AKTIF / NONAKTIF ADMIN
     * HANYA superAdmin
     */
    public function toggleActive(User $admin)
    {
        // superAdmin tidak boleh menonaktifkan dirinya sendiri
        if ($admin->role === 'superAdmin') {
            return back()->with('error', 'Super Admin tidak dapat dinonaktifkan');
        }

        $admin->update([
            'is_active' => !$admin->is_active
        ]);

        return back()->with('success', 'Status admin berhasil diubah');
    }
}
