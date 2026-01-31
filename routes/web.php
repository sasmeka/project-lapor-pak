<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', [LandingController::class, 'landing']);

Route::middleware(['auth','role:admin,superAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // LAPORAN
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
    Route::patch('/laporan/{id}/status', [LaporanController::class, 'updateStatus'])->name('laporan.updateStatus');

    // SUPER ADMIN ONLY
    Route::post('/laporan/{id}/restore', [LaporanController::class, 'restore'])->name('laporan.restore');
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
    Route::delete('/laporan/{id}/force-delete', [LaporanController::class, 'forceDelete'])->name('laporan.forcedelete');

    // USER
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::patch('/user/{user}/toggle', [UserController::class, 'toggle'])->name('user.toggle');

    // KEGIATAN
    Route::resource('kegiatan', KegiatanController::class);
    Route::patch('/kegiatan/{kegiatan}/status', [KegiatanController::class, 'updateStatus'])->name('kegiatan.updateStatus');

    // KELOLA ADMIN → SUPER ADMIN ONLY
    Route::resource('admins', AdminController::class)->except(['show','destroy']);
    Route::patch('/admins/{admin}/toggle', [AdminController::class, 'toggleActive'])->name('admins.toggle');

    Route::get('/profile', fn() => view('admin.profile.index'))->name('profile');
});



// Route::middleware(['auth', 'role:superAdmin'])->prefix('admin')->name('admin.')->group(function () {

//     Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
//     Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
//     Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');

//     Route::get('/admins/{admin}/edit', [AdminController::class, 'edit'])->name('admins.edit');
//     Route::put('/admins/{admin}', [AdminController::class, 'update'])->name('admins.update');

//     // toggle aktif / nonaktif (TIDAK ADA DELETE)
//     Route::patch('/admins/{admin}/toggle', [AdminController::class, 'toggleActive'])
//         ->name('admins.toggle');
// });


Route::middleware('auth', 'role:user')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/kegiatan-rt', [KegiatanController::class, 'userIndex'])->name('kegiatan.user');



    Route::prefix('pengaduan')->name('pengaduan.')->group(function () {

        // List pengaduan
        Route::get('/', [PengaduanController::class, 'index'])->name('index');

        // Form create pengaduan
        Route::get('/create', [PengaduanController::class, 'create'])->name('create');

        // Simpan pengaduan
        Route::post('/', [PengaduanController::class, 'store'])->name('store');

        Route::get('/{pengaduan}/edit', [PengaduanController::class, 'edit'])->name('edit');
        Route::put('/{pengaduan}', [PengaduanController::class, 'update'])->name('update');

        Route::get('/{pengaduan}', [PengaduanController::class, 'show'])->name('show');


        Route::delete('/{id}', [PengaduanController::class, 'destroy'])->name('destroy');
    });
});



require __DIR__.'/auth.php';
