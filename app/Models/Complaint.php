<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
