<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;



Route::prefix('auth')->group(function() {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/verify/{id}', [AuthController::class, 'verify']);
    Route::post('/reset-verification-code', [AuthController::class, 'reset_Code']);
    Route::post('/reset-password', [AuthController::class, 'reset_Password']);
    Route::post('/new-password/{id}', [AuthController::class, 'new_Password']);
    Route::post('/login', [AuthController::class, 'login']);  
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/refresh', [AuthController::class, 'refreshToken']);
    Route::post('/logout', [AuthController::class, 'logout']);

});

Route::apiResource('/categorias', CategoriaController::class);
// Route::apiResource('/categorias/{id}', CategoriaController::class);
Route::apiResource('/blog', BlogController::class);
Route::apiResource('/blog/{identifier}', BlogController::class);

