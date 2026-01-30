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
// use App\Http\Controllers\Admin\AdminController;

Route::get('/', [LandingController::class, 'landing']);

Route::middleware(['auth', 'role:admin,superAdmin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');
    Route::patch('admin/laporan/{id}/status', [LaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
    Route::post('/admin/laporan/{id}/restore', [LaporanController::class, 'restore'])->name('laporan.restore');
    Route::delete('/admin/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
    Route::get('admin/laporan/{id}', [LaporanController::class, 'show'])->name('admin.laporan.show');

     // DELETE (SOFT DELETE)
    Route::delete('admin/laporan/{id}/force-delete', [LaporanController::class, 'forceDelete'])->name('laporan.forcedelete');

    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::patch('/admin/user/{user}/toggle', [UserController::class, 'toggle'])->name('admin.user.toggle');

    Route::get('/admin/kegiatan', [KegiatanController::class, 'index'])->name('admin.kegiatan.index');
    Route::get('/admin/kegiatan/create', [KegiatanController::class, 'create'])->name('admin.kegiatan.create');
    Route::post('/admin/kegiatan', [KegiatanController::class, 'store'])->name('admin.kegiatan.store');
    Route::get('/admin/kegiatan/{kegiatan}/edit', [KegiatanController::class, 'edit'])->name('admin.kegiatan.edit');
    Route::put('/admin/kegiatan/{kegiatan}', [KegiatanController::class, 'update'])->name('admin.kegiatan.update');
    Route::patch('/admin/kegiatan/{kegiatan}/status', [KegiatanController::class, 'updateStatus'])->name('admin.kegiatan.updateStatus');
    Route::delete('/admin/kegiatan/{kegiatan}', [KegiatanController::class, 'destroy'])->name('admin.kegiatan.destroy');

    Route::get('/admin/profile', function () {
        return view('admin.profile.index');
    })->name('admin.profile');

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
