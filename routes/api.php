<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\WebhookController;
use App\Http\Controllers\API\ShipmentController;
use App\Http\Controllers\API\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::get('user/index', [UserController::class, 'index']);
Route::post('/webhook/biteship', [WebhookController::class, 'biteship'])->name('webhook.biteship');

Route::get('user/show', [UserController::class, 'show'])->middleware('auth:sanctum');
Route::put('user/update', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::post('/shipment/store', [ShipmentController::class, 'store'])->middleware('auth:sanctum')->name('shipment.store');