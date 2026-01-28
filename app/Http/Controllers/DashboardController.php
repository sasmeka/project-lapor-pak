<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalLaporan = Complaint::where('user_id', $userId)->count();

        $diproses = Complaint::where('user_id', $userId)
                        ->where('status', 'diproses')
                        ->count();

        $selesai = Complaint::where('user_id', $userId)
                        ->where('status', 'selesai')
                        ->count();

        $aktivitasTerbaru = Complaint::where('user_id', $userId)
                        ->latest()
                        ->take(5)
                        ->get();

        return view('dashboard.index', compact(
            'totalLaporan',
            'diproses',
            'selesai',
            'aktivitasTerbaru'
        ));
    }
    
}
