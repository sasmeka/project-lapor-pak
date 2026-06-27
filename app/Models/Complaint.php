<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Complaint extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'tgl_pengaduan',
        'location',
        'status',
        'foto',
        'status_seen',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getWaNumberAttribute()
    {
        $phone = $this->user->phone; // sesuaikan nama field nomor HP

        // Hilangkan karakter selain angka
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Ubah 08xxxx menjadi 628xxxx
        if (substr($phone, 0, 1) == '0') {
            $phone = '62' . substr($phone, 1);
        }

        return $phone;
    }

    public function whatsappMessage()
    {
        $message  = "Halo kak {$this->user->name},\n\n";
        $message .= "Kami ingin memberitahukan bahwa status laporan Anda telah diperbarui.\n\n";

        $message .= "Detail Laporan\n";
        $message .= "Judul : {$this->title}\n";
        $message .= "Kategori : {$this->category}\n";
        $message .= "Lokasi : {$this->location}\n";
        $message .= "Tanggal : " . Carbon::parse($this->tgl_pengaduan)->format('d-m-Y') . "\n";
        $message .= "Status : *" . ucfirst($this->status) . "*\n\n";

        if ($this->status == 'baru') {
            $message .= "Laporan Anda telah kami terima dan sedang menunggu proses.";
        } elseif ($this->status == 'diproses') {
            $message .= "Laporan Anda sedang ditindaklanjuti oleh petugas terkait.";
        } elseif ($this->status == 'selesai') {
            $message .= "Laporan Anda telah selesai ditangani. Terima kasih atas laporan yang telah Anda kirimkan.";
        }

        $message .= "\n\nTerima kasih telah menggunakan layanan kami.";

        return $message;
    }
}
