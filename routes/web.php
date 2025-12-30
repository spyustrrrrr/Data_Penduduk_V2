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
    Route::middleware('can_edit')->group(function () {
        Route::get('residents/create', [ResidentController::class, 'create'])->name('residents.create');
        Route::post('residents', [ResidentController::class, 'store'])->name('residents.store');
        Route::get('residents/{resident}/edit', [ResidentController::class, 'edit'])->name('residents.edit');
        Route::put('residents/{resident}', [ResidentController::class, 'update'])->name('residents.update');
        Route::delete('residents/{resident}', [ResidentController::class, 'destroy'])->name('residents.destroy');

        Route::get('kks/create', [KKController::class, 'create'])->name('kks.create');
        Route::post('kks', [KKController::class, 'store'])->name('kks.store');
        Route::get('kks/{kk}/edit', [KKController::class, 'edit'])->name('kks.edit');
        Route::put('kks/{kk}', [KKController::class, 'update'])->name('kks.update');
        Route::delete('kks/{kk}', [KKController::class, 'destroy'])->name('kks.destroy');
    });

    Route::get('residents', [ResidentController::class, 'index'])->name('residents.index');
    Route::get('residents/{resident}', [ResidentController::class, 'show'])->name('residents.show');
    Route::get('kks', [KKController::class, 'index'])->name('kks.index');
    Route::get('kks/{kk}', [KKController::class, 'show'])->name('kks.show');

    Route::get('api/kk/check/{no_kk}', [KKController::class, 'checkKK'])->name('api.kk.check');

    Route::middleware('super_admin')->group(function () {
        Route::resource('admins', AdminController::class);
        Route::patch('admins/{admin}/toggle-edit', [AdminController::class, 'toggleEdit'])->name('admins.toggle-edit');
    });
});
