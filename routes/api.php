<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [\Src\Authentication\Infrastructure\LoginController::class, '__invoke']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', [\Src\Authentication\Infrastructure\LogoutController::class, '__invoke']);
        Route::get('user', function (Request $request) {
            return $request->user();
        });
    });

});

Route::group(['prefix' => 'users', 'middleware' => ['auth:sanctum']], function () {

    Route::get('', [\Src\Users\Infrastructure\GetAllUsersController::class, '__invoke']);
    Route::get('/{id}', [\Src\Users\Infrastructure\GetUserByIdController::class, '__invoke']);
    Route::post('', [\Src\Users\Infrastructure\CreateUserController::class, '__invoke']);
    Route::patch('/{id}', [\Src\Users\Infrastructure\UpdateUserController::class, '__invoke']);

});

Route::group(['prefix' => 'apps', 'middleware' => ['auth:sanctum']], function () {

    Route::get('', [\Src\Applications\Infrastructure\GetAllApplicationsController::class, '__invoke']);
    Route::get('/{id}', [\Src\Applications\Infrastructure\GetApplicationByIdController::class, '__invoke']);
    Route::post('', [\Src\Applications\Infrastructure\CreateApplicationController::class, '__invoke']);
    Route::patch('/{id}', [\Src\Applications\Infrastructure\UpdateApplicationController::class, '__invoke']);

});

