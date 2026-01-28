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
        // base query + role
        if (Auth::user()->role === 'superAdmin') {
            $query = Complaint::withTrashed()->with('user');
        } else {
            $query = Complaint::with('user');
        }

        //filter nama user
        if ($request->filled('nama')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->nama . '%');
            });
        }

        // filter dari tanggal laporan
        if ($request->filled('dari_tanggal')) {
            $query->whereDate('tgl_pengaduan', '>=', $request->dari_tanggal);
        }

        //filter sampai tanggal laporan
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('tgl_pengaduan', '<=', $request->sampai_tanggal);
        }

        $laporans = $query
            ->orderBy('created_at', 'desc')
            ->paginate(4)
            ->withQueryString();

        return view('admin.laporan.index', compact('laporans'));
    }

    public function show($id)
    {
        if (Auth::user()->role === 'superAdmin') {
            $laporan = Complaint::withTrashed()->with('user')->findOrFail($id);
        } else {
            $laporan = Complaint::with('user')->findOrFail($id);
        }

        return view('admin.laporan.show', compact('laporan'));
    }


    /**
     * Update status laporan
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:baru,diproses,selesai'
        ]);

        // termasuk yang terhapus (biar aman)
        $laporan = Complaint::withTrashed()->findOrFail($id);

        $laporan->update([
            'status' => $request->status
        ]);

        activityAdmin(
            'Mengubah status laporan ID ' . $laporan->id . ' menjadi ' . $request->status,
            'Complaint',
            $laporan->id
        );


        return redirect()->back()->with('success', 'Status laporan berhasil diupdate.');
    }

    /**
     * Soft delete laporan (admin & superAdmin)
     */
    public function destroy($id)
    {
        $laporan = Complaint::findOrFail($id);

        $laporan->delete(); // soft delete

        activityAdmin(
            'Menghapus laporan ID ' . $laporan->id,
            'Complaint',
            $laporan->id
        );

        return redirect()->back()->with('success', 'Laporan berhasil dihapus.');
    }

    /**
     * Restore laporan (KHUSUS superAdmin)
     */
    public function restore($id)
    {
        if (Auth::user()->role !== 'superAdmin') {
            abort(403);
        }

        $laporan = Complaint::onlyTrashed()->findOrFail($id);
        $laporan->restore();

        activityAdmin(
            'Memulihkan laporan ID ' . $laporan->id,
            'Complaint',
            $laporan->id
        );

        return redirect()->back()->with('success', 'Laporan berhasil dipulihkan.');
    }

    /**
     * Hapus permanen (KHUSUS superAdmin)
     */
    public function forceDelete($id)
    {
        if (Auth::user()->role !== 'superAdmin') {
            abort(403);
        }

        $laporan = Complaint::withTrashed()->findOrFail($id);
        $laporan->forceDelete();

        activityAdmin(
            'Menghapus permanen laporan ID ' . $laporan->id,
            'Complaint',
            $laporan->id
        );

        return redirect()->back()->with('success', 'Laporan berhasil di hapus');
    }
}
