<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaderPosyanduController;
use App\Http\Controllers\JadwalPosyanduController;
use App\Http\Controllers\LayananPosyanduController;
use App\Http\Controllers\CatatanImunisasiController;

/*
|--------------------------------------------------------------------------
| ROOT & DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/auth', [AuthController::class, 'index'])
    ->name('login.form');

Route::post('/auth/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::get('/auth/register', [AuthController::class, 'showRegister'])
    ->name('auth.register');

Route::post('/auth/register', [AuthController::class, 'register'])
    ->name('auth.register.submit');

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (LOGIN REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth.custom'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])
        ->name('profile.update');

    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])
        ->name('profile.updatePassword');

    /*
    |--------------------------------------------------------------------------
    | USER MODULE (ADMIN ONLY)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('user', UserController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | WARGA MODULE (ADMIN & USER)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin,user'])->group(function () {
        Route::resource('warga', WargaController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | POSYANDU & KADER MODULE
    | ROLE: ADMIN & PETUGAS
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin,petugas'])->group(function () {

        // POSYANDU
        Route::resource('posyandu', PosyanduController::class);

        // KADER POSYANDU ✅ FIX
        Route::resource('kader-posyandu', KaderPosyanduController::class);

        Route::resource('jadwal-posyandu', JadwalPosyanduController::class);

        Route::resource('layanan-posyandu', LayananPosyanduController::class);

        Route::resource('catatan-imunisasi', CatatanImunisasiController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
