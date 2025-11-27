<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotifikasiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Notification API routes
Route::middleware('auth')->group(function () {
    Route::get('/notifications/unread-count', [NotifikasiController::class, 'getUnreadCount']);
});

// IoT Sensor API routes (protected for admin only)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/sensors/latest', [App\Http\Controllers\iotController::class, 'getLatestData']);
});

// Produk API routes (public for real-time filtering)
Route::get('/produk/filter', [App\Http\Controllers\produkController::class, 'filter'])->name('api.produk.filter');
