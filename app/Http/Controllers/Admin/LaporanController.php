<?php

namespace App\Http\Controllers\Admin;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();

        // superAdmin bisa lihat termasuk yang terhapus
        $query = $user->role === 'superAdmin'
            ? Complaint::withTrashed()->with('user')
            : Complaint::with('user');

        if ($request->filled('nama')) {
            $query->whereHas('user', fn($q) =>
                $q->where('name', 'like', '%' . $request->nama . '%')
            );
        }

        if ($request->filled('dari_tanggal')) {
            $query->whereDate('tgl_pengaduan', '>=', $request->dari_tanggal);
        }

        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('tgl_pengaduan', '<=', $request->sampai_tanggal);
        }

        $laporans = $query->latest()->paginate(4)->withQueryString();

        return view('admin.laporan.index', compact('laporans'));
    }

    public function show($id)
    {
        $user = Auth::user();

        $laporan = $user->role === 'superAdmin'
            ? Complaint::withTrashed()->with('user')->findOrFail($id)
            : Complaint::with('user')->findOrFail($id);

        return view('admin.laporan.show', compact('laporan'));
    }

    /**
     * ADMIN & SUPERADMIN
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:baru,diproses,selesai'
        ]);

        $laporan = Complaint::withTrashed()->findOrFail($id);
        $laporan->update(['status' => $request->status]);

        activityAdmin(
            'Mengubah status laporan ID ' . $laporan->id . ' menjadi ' . $request->status,
            'Complaint',
            $laporan->id
        );

        return back()->with('success', 'Status laporan berhasil diupdate.');
    }

    /**
     * ADMIN & SUPERADMIN (soft delete)
     */
    public function destroy($id)
    {
        $laporan = Complaint::findOrFail($id);
        $laporan->delete();

        activityAdmin('Menghapus laporan ID ' . $laporan->id, 'Complaint', $laporan->id);

        return back()->with('success', 'Laporan berhasil dihapus.');
    }

    /**
     * SUPER ADMIN ONLY
     */
    public function restore($id)
    {
        if (Auth::user()->role !== 'superAdmin') abort(403);

        $laporan = Complaint::onlyTrashed()->findOrFail($id);
        $laporan->restore();

        activityAdmin('Memulihkan laporan ID ' . $laporan->id, 'Complaint', $laporan->id);

        return back()->with('success', 'Laporan berhasil dipulihkan.');
    }

    /**
     * SUPER ADMIN ONLY
     */
    public function forceDelete($id)
    {
        if (Auth::user()->role !== 'superAdmin') abort(403);

        $laporan = Complaint::withTrashed()->findOrFail($id);
        $laporan->forceDelete();

        activityAdmin('Menghapus permanen laporan ID ' . $laporan->id, 'Complaint', $laporan->id);

        return back()->with('success', 'Laporan berhasil dihapus permanen.');
    }
}
