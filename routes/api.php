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
