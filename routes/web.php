<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\KKController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\AdminController;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('charts', [ChartController::class, 'index'])->name('charts.index');

    Route::get('residents/export', [ResidentController::class, 'export'])->name('residents.export');
    Route::resource('residents', ResidentController::class);

    Route::resource('kks', KKController::class);

    // API endpoint untuk cek KK
    Route::get('api/kk/check/{no_kk}', [KKController::class, 'checkKK'])->name('api.kk.check');

    Route::middleware('super_admin')->group(function () {
        Route::resource('admins', AdminController::class);
        Route::patch('admins/{admin}/toggle-edit', [AdminController::class, 'toggleEdit'])->name('admins.toggle-edit');
    });
});
