<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\ToursController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function () {
    Route::apiResource('tours', ToursController::class);
    Route::apiResource('bookings', BookingsController::class);
    Route::apiResource('users', UsersController::class);


});

// Route::post('login', 'App\Http\Controllers\AuthController@login');
// Route::post('register', 'App\Http\Controllers\AuthController@register');
// Route::post('logout', 'App\Http\Controllers\AuthController@logout');
