<?php

use App\Http\Controllers\Admin_AkunController;
use App\Http\Controllers\Admin_DashboardController;
use App\Http\Controllers\Admin_PengaduanController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User_AkunControler;
use App\Http\Controllers\User_DashboardController;
use App\Http\Controllers\User_PengaduanController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// login dan registrasi
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/', function () {return view('welcome'); });
Route::get('/registrasi', [LoginController::class, 'create'])->name('index.registrasi');
Route::post('/registrasi/store', [LoginController::class, 'store'])->name('registrasi.store');
Route::post('/reset-password/manual', [LoginController::class, 'resetPasswordManual'])
    ->name('password.manual.update');

 

// role untuk admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // dashboard
    Route::get('/dashboard', [Admin_DashboardController::class, 'index'])->name('dashboard.admin');
    
    // akun
    Route::get('/identitas/akun', [Admin_AkunController::class, 'index'])->name('akun.admin');
    Route::put('/identitas/update/{id}', [Admin_AkunController::class, 'update'])->name('update.admin');
    
    // akun pengguna
    Route::get('/admin/pengguna', [Admin_AkunController::class, 'pengguna'])->name('pengguna.index');
    Route::post('/admin/pengguna/store', [Admin_AkunController::class, 'store'])->name('pengguna.store');
    Route::post('/admin/pengguna/reset-password/{id}', [Admin_AkunController::class, 'resetPassword'])->name('pengguna.resetPassword');
    Route::delete('/admin/pengguna/{id}', [Admin_AkunController::class, 'destroy'])->name('pengguna.destroy');
    
    // pengaduan
    Route::get('/pengaduan', [Admin_PengaduanController::class, 'index'])->name('index.pengaduan');
    Route::post('/pengaduan/store', [Admin_PengaduanController::class, 'store'])->name('store.pengaduan');
    Route::put('/pengaduan/update/{id_laporan}', [Admin_PengaduanController::class, 'update'])->name('update.pengaduan');
    Route::put('/pengaduan/update-status/{id_laporan}', [Admin_PengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');
    Route::delete('/pengaduan/destroy/{id_laporan}', [Admin_PengaduanController::class, 'destroy'])->name('destroy.pengaduan');

    // export
    Route::get('/laporan/pengaduan/{id_pengaduan}', [ExportController::class, 'cetakLaporan'])->name('laporan.export');

});


// role untuk user
Route::middleware(['auth', 'isUser'])->group(function () {
    // dashboard
    Route::get('/dashboard/user', [User_DashboardController::class, 'index'])->name('dashboard.user');

    // akun
    Route::get('/identitas/user/akun', [User_AkunControler::class, 'index'])->name('akun.user');
    Route::put('/identitas/user/update/{id}', [User_AkunControler::class, 'update'])->name('update.user');

    // pengaduan
    Route::get('/pengaduan/user', [User_PengaduanController::class, 'index'])->name('userpengaduan.index');
    Route::post('/pengaduan/user/store', [User_PengaduanController::class, 'store'])->name('userpengaduan.store');
    Route::put('/pengaduan/user/update/{id}', [User_PengaduanController::class, 'update'])->name('userpengaduan.update');
    Route::delete('/pengaduan/user/delete/{id}', [User_PengaduanController::class, 'destroy'])->name('userpengaduan.destroy');


});


require __DIR__.'/auth.php';
