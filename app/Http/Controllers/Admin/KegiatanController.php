<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KegiatanRt;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = KegiatanRt::query();

        // filter dari tanggal dibuat
        if ($request->filled('dari_tanggal')) {
            $query->whereDate(
                'created_at',
                '>=',
                Carbon::parse($request->dari_tanggal)
            );
        }

        // filter sampai tanggal dibuat
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate(
                'created_at',
                '<=',
                Carbon::parse($request->sampai_tanggal)
            );
        }

        $kegiatans = $query
            ->orderBy('created_at', 'asc')
            ->paginate(6)
            ->withQueryString();

        return view('admin.kegiatan.index', compact('kegiatans'));
    }


    public function userIndex(Request $request)
    {
        $query = KegiatanRt::query();

        //filter dari tanggal 
        if ($request->filled('dari_tanggal')) {
            $query->whereDate(
                'tgl_kegiatan',
                '>=',
                Carbon::parse($request->dari_tanggal)
            );
        }

        //filter sampai tanggal 
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate(
                'tgl_kegiatan',
                '<=',
                Carbon::parse($request->sampai_tanggal)
            );
        }

        $kegiatans = $query->orderBy('tgl_kegiatan', 'asc')->paginate(6)->withQueryString();
        return view('kegiatan.index', compact('kegiatans'));
    }


    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'tempat_kegiatan' => 'required',
            'tgl_kegiatan' => 'required|date',
            'deskripsi' => 'required',
        ]);

        KegiatanRt::create($request->all());

        return redirect()->route('admin.kegiatan.index');
    }

    public function edit(KegiatanRt $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, KegiatanRt $kegiatan)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'tempat_kegiatan' => 'required',
            'tgl_kegiatan' => 'required|date',
            'deskripsi' => 'required',
        ]);

        $kegiatan->update($request->all());

        return redirect()->route('admin.kegiatan.index');
    }

    public function updateStatus(Request $request, $id)
    {
        $kegiatan = KegiatanRt::findOrFail($id);

        // Jika status sudah final
        if (in_array($kegiatan->status, ['Selesai', 'Batal'])) {
            return back()->with('error', "Status {$kegiatan->status} tidak dapat diubah");
        }

        $request->validate([
            'status' => 'required|in:Akan Datang,Selesai,Batal'
        ]);

        $kegiatan->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status kegiatan berhasil diperbarui');
    }


    public function destroy(KegiatanRt $kegiatan)
    {
        $kegiatan->delete();
        return back();
    }
}
