<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    
    Route::apiResource('/users',UsersController::class);
});

//Autenticación
Route::apiResource('/login', AuthController::class);
