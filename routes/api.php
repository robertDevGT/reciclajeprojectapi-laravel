<?php

use App\Http\Controllers\AddressesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('/roles', RolesController::class)->middleware('role:admin');
    Route::apiResource('/addresses', AddressesController::class)->middleware('role:admin');
    Route::apiResource('/users', UsersController::class)->middleware('role:admin');
});

//Autenticación
Route::apiResource('/login', AuthController::class);
