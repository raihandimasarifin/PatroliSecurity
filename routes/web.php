<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScannerController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\ProfileController;


Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/', [AuthController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/scanner', [ScannerController::class, 'scanner'])->name('scanner');
    Route::get('export-trackings', [TrackingController::class, 'exportToExcel'])->name('tracking.export');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::prefix('room')->group(function () {
        Route::get('/', [RoomController::class, 'index'])->name('rooms.index');
        Route::get('/create', [RoomController::class, 'create_room'])->name('room.create');
        Route::get('/export-pdf', [RoomController::class, 'exportPdf'])->name('rooms.export-pdf');
        Route::get('/{id}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/{id}', [RoomController::class, 'update'])->name('rooms.update');
        Route::post('/', [RoomController::class, 'store'])->name('rooms.store');
        Route::delete('/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    Route::prefix('tracking')->group(function () {
        Route::get('/', [TrackingController::class, 'index'])->name('tracking.index');
        Route::get('/scan', [TrackingController::class, 'scan'])->name('scan');
        Route::get('/check-room', [TrackingController::class, 'checkRoom']);
        Route::get('/create', [TrackingController::class, 'create'])->name('tracking.create');
        Route::post('/store', [TrackingController::class, 'store'])->name('tracking.store');
        Route::delete('/{id}', [TrackingController::class, 'destroy'])->name('trackings.destroy');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::get('/home', function () {
    return view('dashboard');
})->name('home')->middleware('auth');
