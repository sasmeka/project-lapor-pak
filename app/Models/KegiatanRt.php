<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanRt extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_rt';

    protected $fillable = [
        'nama_kegiatan',
        'tempat_kegiatan',
        'tgl_kegiatan',
        'jam_kegiatan',
        'deskripsi',
        'status'
    ];
}
