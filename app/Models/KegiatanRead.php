<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanRead extends Model
{
    protected $table = 'kegiatan_reads';

    protected $fillable = [
        'user_id',
        'kegiatan_id',
    ];


    // Data ini milik satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Data ini untuk satu kegiatan
    public function kegiatan()
    {
        return $this->belongsTo(KegiatanRt::class, 'kegiatan_id');
    }
}
