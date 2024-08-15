<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



Route::prefix('auth')->group(function() {
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/verify/{id}/{verification_code}', [AuthController::class, 'verify']);
    Route::post('/reset-verification-code', [AuthController::class, 'reset_Code']);
    Route::post('/login', [AuthController::class, 'login']);  
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);

});

