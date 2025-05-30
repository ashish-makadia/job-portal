<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::apiResource('jobs', JobController::class)->only(['index', 'show']);
Route::apiResource('applications', ApplicationController::class)->only(['index', 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::apiResource('jobs', JobController::class)->except(['index', 'show']);

    Route::apiResource('users', UserController::class);

    Route::apiResource('applications', ApplicationController::class)->except(['index', 'show']);
});
