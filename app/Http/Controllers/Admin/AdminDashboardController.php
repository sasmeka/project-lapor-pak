<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Complaint;
use App\Models\ActivityLog;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::where('role', 'user')->count();

        $baru = Complaint::where('status', 'baru')->count();
        $diproses = Complaint::where('status', 'diproses')->count();
        $selesai = Complaint::where('status', 'selesai')->count();

        //Pagination activity (6 per halaman)
        $activities = ActivityLog::with('user')
            ->latest('activity_time')
            ->paginate(6);

        return view('admin.dashboard', compact(
            'totalUser',
            'baru',
            'diproses',
            'selesai',
            'activities'
        ));
    }

}
