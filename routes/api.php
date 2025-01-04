<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WhiteboardController;
use Illuminate\Support\Facades\Route;

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
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('whiteboards', WhiteboardController::class);
    Route::get('/whiteboards/{whiteboard}/qrcode', [
        WhiteboardController::class,
        'getQrCode',
    ])->name('whiteboards.qrcode');

    Route::get('/whiteboards/{Whiteboard:identifier}/signIn', [
        WhiteboardController::class,
        'signIn',
    ])->name('whiteboards.show');
});
