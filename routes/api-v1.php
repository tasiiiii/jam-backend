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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [\App\Http\Controllers\API\v1\Auth\Login\Controller::class, 'run']);
    Route::get('me', [\App\Http\Controllers\API\v1\Auth\Me\Controller::class, 'run']);
});

Route::group(['prefix' => 'users'], function () {
    Route::post('', [\App\Http\Controllers\API\v1\User\Create\Controller::class, 'run']);
});

Route::group(['prefix' => 'teams'], function () {
    Route::post('', [\App\Http\Controllers\API\v1\Team\Create\Controller::class, 'run']);
    Route::get('', [\App\Http\Controllers\API\v1\Team\Show\Controller::class, 'run']);
    Route::get('{id}', [\App\Http\Controllers\API\v1\Team\ShowOne\Controller::class, 'run'])
        ->where('id', '[0-9]+');
    Route::put('{id}', [\App\Http\Controllers\API\v1\Team\Update\Controller::class, 'run'])
        ->where('id', '[0-9]+');
    Route::put('{teamId}/users/{userId}', [\App\Http\Controllers\API\v1\Team\User\AddToTeam\Controller::class, 'run'])
        ->where('teamId', '[0-9]+')
        ->where('userId', '[0-9]+');
});

Route::group(['prefix' => 'projects'], function () {
    Route::post('', [\App\Http\Controllers\API\v1\Project\Create\Controller::class, 'run']);
    Route::group(['prefix' => '{projectId}/boards'], function () {
        Route::post('', [\App\Http\Controllers\API\v1\Project\Board\Create\Controller::class, 'run']);
        Route::get('', [\App\Http\Controllers\API\v1\Project\Board\Show\Controller::class, 'run']);
        Route::get('{boardId}', [\App\Http\Controllers\API\v1\Project\Board\ShowOne\Controller::class, 'run'])
            ->where('boardId', '[0-9]+');
        Route::post('{boardId}/columns', [\App\Http\Controllers\API\v1\Project\Board\BoardColumn\Create\Controller::class, 'run'])
            ->where('boardId', '[0-9]+');
        Route::post('{boardId}/tasks', [\App\Http\Controllers\API\v1\Project\Board\Task\Create\Controller::class, 'run'])
            ->where('boardId', '[0-9]+');
    });
});
