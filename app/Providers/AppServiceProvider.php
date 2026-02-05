<?php

namespace App\Providers;

use App\Models\Complaint;
use App\Models\KegiatanRt;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('*', function ($view) {

        if (Auth::check()) {

            // BADGE KEGIATAN BARU
            $newKegiatanCount = KegiatanRt::whereDoesntHave('reads', function ($q) {
                $q->where('user_id', Auth::id());
            })->count();

            // BADGE UPDATE STATUS PENGADUAN
            $newComplaintUpdates = Complaint::where('user_id', Auth::id())
                ->where('status_seen', false)
                ->count();

            $view->with([
                'newKegiatanCount' => $newKegiatanCount,
                'newComplaintUpdates' => $newComplaintUpdates
            ]);
        }
    });
    }
}
