<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CctvController extends Controller
{
    public function index()
    {
        // DUMMY STREAM (video online buat simulasi CCTV)
        $streamUrl = "https://test-streams.mux.dev/x36xhzz/x36xhzz.m3u8";

        return view('admin.cctv.index', compact('streamUrl'));
    }
}
