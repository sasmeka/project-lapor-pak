<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
// use Illuminate\Http\Request;

class CctvController extends Controller
{
    public function index()
    {
        // DUMMY STREAM (video online buat simulasi CCTV)
        $streamUrl = "https://test-streams.mux.dev/x36xhzz/x36xhzz.m3u8";

        return view('admin.cctv.index', compact('streamUrl'));
    }
}




// class CctvController extends Controller
// {
//     public function index()
//     {
//         $apiKey = config('services.cctv.api_key');

//         //SIMULASI: seolah-olah kita request ke CCTV pakai API Key
//         if ($apiKey == null) {
//             abort(500, 'API KEY CCTV belum diisi');
//         }

//         //SIMULASI RESPONSE DARI SERVER CCTV
//         $streamUrl = "https://test-streams.mux.dev/x36xhzz/x36xhzz.m3u8";

//         return view('admin.cctv.index', compact('streamUrl'));
//     }


// }


