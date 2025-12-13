<?php

use App\Http\Controllers\AsetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriAsetController;
use App\Http\Controllers\LokasiAsetController;
use App\Http\Controllers\MutasiAsetController;
use App\Http\Controllers\PemeliharaanAsetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

// Redirect root ke dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Halaman login & register
Route::get('/auth', [AuthController::class, 'index'])->name('login.form');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/auth/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register.submit');

// Dashboard bisa dibuka tanpa login (nanti diarahkan jika perlu)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/*
| PROTECTED ROUTES → HARUS LOGIN
*/

Route::middleware(['auth.custom'])->group(function () {

    // Profile user
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    /*
    | ADMIN ONLY
    */
    Route::middleware(['role:admin'])->group(function () {

        Route::resource('user', UserController::class);
        Route::resource('kategoriAset', KategoriAsetController::class);

    });

    /*
    | ADMIN + USER
    */
    Route::middleware(['role:admin,user'])->group(function () {

        Route::resource('warga', WargaController::class);
        Route::resource('pemeliharaan', PemeliharaanAsetController::class);

    });

    /*
    | SEMUA ROLE (admin, user, petugas)
    */
    Route::resource('aset', AsetController::class);
    Route::get('/aset/{aset}', [AsetController::class, 'show'])->name('aset.show');

    Route::resource('lokasi-aset', LokasiAsetController::class);
    Route::resource('mutasi', MutasiAsetController::class);

    // LOGOUT (POST)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});
