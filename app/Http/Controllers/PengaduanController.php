<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image; 
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::where('user_id', Auth::id());

        $userId = Auth::id();

        if ($request->filled('from')) {
            $query->whereDate('tgl_pengaduan', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('tgl_pengaduan', '<=', $request->to);
        }

         //TAMBAHKAN INI (mark notif as read)
        Complaint::where('user_id', $userId)
            ->where('status_seen', false)
            ->update(['status_seen' => true]);

        $pengaduan = $query->orderBy('created_at', 'desc')
                           ->paginate(4)
                           ->withQueryString();

        return view('pengaduan.index', compact('pengaduan'));
    }

    public function create()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'tgl_pengaduan' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = 'baru';

        if ($request->hasFile('foto')) {

        $file = $request->file('foto');

        $filename = uniqid().'.jpg';

        $path = storage_path('app/public/complaints/'.$filename);

        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        // CARA BARU INTERVENTION V3
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);

        $image->scaleDown(width: 1280);

        $image->toJpeg(quality: 70)->save($path);

        $data['foto'] = 'complaints/'.$filename;
    }


        Complaint::create($data);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Laporan berhasil dikirim!');
    }

    public function show(Complaint $pengaduan)
    {
        if ($pengaduan->user_id !== Auth::id()) {
            abort(403);
        }

        if (!$pengaduan->status_seen) {
            $pengaduan->update(['status_seen' => true]);
        }

        return view('pengaduan.show', compact('pengaduan'));
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
            'foto'          => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($pengaduan->foto && Storage::exists('public/' . $pengaduan->foto)) {
                Storage::delete('public/' . $pengaduan->foto);
            }

            $imageFile = $request->file('foto');
            $filename  = time() . '.jpg';

            $manager = new ImageManager(new Driver());
            $img = $manager->read($imageFile->getRealPath());

            $img->scale(width: 1200);

            $quality = 80;
            $encoded = $img->toJpeg($quality);

            while (strlen($encoded) > 200 * 1024 && $quality > 20) {
                $quality -= 5;
                $encoded = $img->toJpeg($quality);
            }

            Storage::put('public/laporan/' . $filename, $encoded);

            $data['foto'] = 'laporan/' . $filename;
        }

        $pengaduan->update($data);

        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengaduan = Complaint::findOrFail($id);

        if ($pengaduan->user_id !== Auth::id()) {
            abort(403);
        }

        $pengaduan->delete();

        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}
