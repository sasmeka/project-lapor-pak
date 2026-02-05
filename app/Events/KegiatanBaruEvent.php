<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// class KegiatanBaruEvent implements ShouldBroadcast
// {
//     use Dispatchable, SerializesModels;

//     public $kegiatan;

//     public function __construct($kegiatan)
//     {
//         $this->kegiatan = $kegiatan;
//     }

//     public function broadcastOn(): Channel
//     {
//         return new Channel('kegiatan-channel');
//     }

//     public function broadcastAs(): string
//     {
//         return 'kegiatan-baru';
//     }
// }
