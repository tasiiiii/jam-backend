<?php

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

Route::get('ping', [\App\Http\Controllers\API\v1\Ping\Controller::class, 'run']);

Route::group(['prefix' => 'users'], function () {
    Route::post('', [\App\Http\Controllers\API\v1\User\Create\Controller::class, 'run']);
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [\App\Http\Controllers\API\v1\Auth\Login\Controller::class, 'run']);
    Route::get('me', [\App\Http\Controllers\API\v1\Auth\Me\Controller::class, 'run']);
});
