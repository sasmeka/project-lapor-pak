<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CctvController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::get('/', [LandingController::class, 'landing']);

/*
|--------------------------------------------------------------------------
| ADMIN & SUPER ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:admin,superAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // LAPORAN
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
    Route::patch('/laporan/{id}/status', [LaporanController::class, 'updateStatus'])->name('laporan.updateStatus');

    // SUPER ADMIN ONLY (laporan)
    Route::post('/laporan/{id}/restore', [LaporanController::class, 'restore'])->name('laporan.restore');
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
    Route::delete('/laporan/{id}/force-delete', [LaporanController::class, 'forceDelete'])->name('laporan.forcedelete');

    // USER
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::patch('/user/{user}/toggle', [UserController::class, 'toggle'])->name('user.toggle');

    // KEGIATAN
    Route::resource('kegiatan', KegiatanController::class);
    Route::patch('/kegiatan/{kegiatan}/status', [KegiatanController::class, 'updateStatus'])->name('kegiatan.updateStatus');

    // CCTV
    Route::get('/cctv', [CctvController::class, 'index'])->name('cctv.index');

    // PROFILE
    Route::get('/profile', fn() => view('admin.profile.index'))->name('profile');


    /*
    |--------------------------------------------------------------------------
    | SUPER ADMIN ONLY (KELOLA ADMIN)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:superAdmin'])->group(function () {

        Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');

        Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');

        Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');

        Route::get('/admins/{admin}/edit', [AdminController::class, 'edit'])->name('admins.edit');

        Route::put('/admins/{admin}', [AdminController::class, 'update'])->name('admins.update');

        Route::patch('/admins/{admin}/toggle', [AdminController::class, 'toggleActive'])->name('admins.toggle');

        Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy');

    });

});


/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:user'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/kegiatan-rt', [KegiatanController::class, 'userIndex'])->name('kegiatan.user');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // PENGADUAN
    Route::prefix('pengaduan')->name('pengaduan.')->group(function () {

        Route::get('/', [PengaduanController::class, 'index'])->name('index');

        Route::get('/create', [PengaduanController::class, 'create'])->name('create');

        Route::post('/', [PengaduanController::class, 'store'])->name('store');

        Route::get('/{pengaduan}/edit', [PengaduanController::class, 'edit'])->name('edit');

        Route::put('/{pengaduan}', [PengaduanController::class, 'update'])->name('update');

        Route::get('/{pengaduan}', [PengaduanController::class, 'show'])->name('show');

        Route::delete('/{id}', [PengaduanController::class, 'destroy'])->name('destroy');

    });

});

require __DIR__.'/auth.php';