<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::where('user_id', Auth::id());

        // FILTER TANGGAL DIBUAT (AMAN)
        if ($request->filled('from')) {
            $query->whereDate('tgl_pengaduan', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('tgl_pengaduan', '<=', $request->to);
        }

        $pengaduan = $query->orderBy('tgl_pengaduan', 'desc')->paginate(4)->withQueryString();

        return view('pengaduan.index', compact('pengaduan'));
    }


    public function create()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'category'       => 'required|string|max:100',
            'tgl_pengaduan'  => 'required|date',
            'location'       => 'required|string|max:255',
        ], [
            'required' => ':attribute wajib diisi.',
            'date'     => ':attribute harus berupa tanggal.',
        ]);

        // SIMPAN KE DATABASE
        Complaint::create([
            'user_id'        => Auth::id(),
            'title'          => $request->title,
            'description'    => $request->description,
            'category'       => $request->category,
            'tgl_pengaduan'  => $request->tgl_pengaduan,
            'location'       => $request->location,
            'status'         => 'baru',
        ]);

        // REDIRECT
        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dikirim.');
    }

    public function edit(Complaint $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403);
        }

        return view('pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, Complaint $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'category'      => 'required|string|max:100',
            'tgl_pengaduan' => 'required|date',
            'location'      => 'required|string|max:255',
            'description'   => 'required|string',
        ]);

        // update sesuai kolom DB
        $pengaduan->update($data);

        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengaduan = Complaint::findOrFail($id);

        // Optional: pastikan hanya pemilik yang bisa hapus
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403);
        }

        $pengaduan->delete();

        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }

}
