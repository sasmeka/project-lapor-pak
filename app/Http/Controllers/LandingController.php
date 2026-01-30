<?php

namespace App\Http\Controllers;

use App\Models\KegiatanRt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function landing()
    {
        $kegiatans = KegiatanRt::orderBy('tgl_kegiatan', 'desc')->take(10)->get();
        return view('welcome', compact('kegiatans'));
    }
}
