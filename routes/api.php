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

    Route::get('/whiteboards', [WhiteboardController::class, 'index'])
        ->name('whiteboards.index');

    Route::post('/whiteboards', [WhiteboardController::class, 'store'])
        ->name('whiteboards.store');

    Route::get('/whiteboards/{whiteboard}', [
        WhiteboardController::class,
        'show',
    ])->name('whiteboards.show');

    Route::put('/whiteboards/{whiteboard}', [
        WhiteboardController::class,
        'update',
    ])->middleware('check.whiteboard.owner')
        ->name('whiteboards.update');

    Route::delete('/whiteboards/{whiteboard}', [WhiteboardController::class, 'destroy'])
        ->middleware('check.whiteboard.owner')
        ->name('whiteboards.destroy');

    Route::get('/whiteboards/{whiteboard}/qrcode', [
        WhiteboardController::class,
        'getQrCode',
    ])->name('whiteboards.qrcode');

    Route::get('/whiteboards/{Whiteboard:identifier}/signIn', [
        WhiteboardController::class,
        'signIn',
    ])->name('whiteboards.show');

    Route::post('/whiteboards/{Whiteboard:identifier}/drawing', [
        WhiteboardController::class,
        'drawing',
    ])->name('whiteboards.drawing');
});
