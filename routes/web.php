<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShipmentController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Users
    Route::resource('users', UserController::class);
    Route::get('/shipment/order', [ShipmentController::class, 'index'])->name('shipment.index');
    Route::post('/shipment/order', [ShipmentController::class, 'store'])->name('shipment.store');
    Route::put('/shipment/order', [ShipmentController::class, 'update'])->name('shipment.update');
});

require __DIR__.'/auth.php';
