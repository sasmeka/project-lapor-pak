<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total user (kecuali admin kalau mau, opsional)
        $totalUser = User::where('role', 'user')->count();

        // Statistik laporan (TIDAK termasuk yang sudah soft delete)
        $baru = Complaint::where('status', 'baru')->count();
        $diproses = Complaint::where('status', 'diproses')->count();
        $selesai = Complaint::where('status', 'selesai')->count();

        // Aktivitas admin (opsional – bisa kamu kembangin nanti)
        $activities = [];

        return view('admin.dashboard', compact(
            'totalUser',
            'baru',
            'diproses',
            'selesai',
            'activities'
        ));
    }
}
