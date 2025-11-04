<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\KKController;
use App\Http\Controllers\DashboardController; // TAMBAHKAN INI

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // UBAH BAGIAN INI
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('residents/export', [ResidentController::class, 'export'])->name('residents.export');
    Route::resource('residents', ResidentController::class);

    Route::resource('kks', KKController::class);
});