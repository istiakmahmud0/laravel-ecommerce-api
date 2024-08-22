<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * Authentication
 */
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
route::post('forget-password', [AuthController::class, 'forgetPassword']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('reset-password', [AuthController::class, 'passwordReset']);
    Route::post('logout', [AuthController::class, 'logout']);
});
