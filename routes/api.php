<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\apiAuthController;
use App\Http\Controllers\Api\ProducApitController;

Route::post('/register', [apiAuthController::class, 'register']);
Route::post('/login', [apiAuthController::class, 'login']);

Route::group(["middleware" => ["auth:sanctum"]], function () {
    Route::apiResource('clients-requests', ProducApitController::class)->middleware('lang');
    Route::get('/profile', [apiAuthController::class, 'profile']);
    Route::get('/logout', [apiAuthController::class, 'logout']);
    Route::get('/refresh-token', [apiAuthController::class, 'refreshToken']);
});
