<?php

use App\Http\Controllers\AddressesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollectorsController;
use App\Http\Controllers\GarbageCollectionRequestsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('/roles', RolesController::class)->middleware('role:admin');
    Route::apiResource('/addresses', AddressesController::class)->middleware('role:admin');
    Route::apiResource('/users', UsersController::class)->middleware('role:admin');
    Route::apiResource('/statuses', StatusesController::class)->middleware('role:admin');

    Route::apiResource('/collectors', CollectorsController::class)->middleware('role:admin');
    Route::apiResource('/garbage-collection-requests', GarbageCollectionRequestsController::class);
});

//Autenticación
Route::apiResource('/login', AuthController::class);
