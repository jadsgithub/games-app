<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// LOGIN
Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/login', 'login')->name('login');             
});

Route::middleware('auth:sanctum')->group(function () {

    // USERS
    Route::prefix('/users')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/show/{uuid}', 'show')->name('users.show');
            Route::get('/', 'index')->name('users.index');
            Route::post('/store', 'store')->name('users.store');
            Route::put('/update/{uuid}', 'update')->name('users.update');
            Route::delete('/destroy/{uuid}', 'destroy')->name('users.destroy')->middleware('role:admin');               
        });
    });

    // TEAMS
    Route::prefix('/teams')->group(function () {
        Route::controller(TeamController::class)->group(function () {
            Route::get('/register-teams-automatically', 'insertTeamsAutomatically')->name('teams.register-teams-automatically');
            Route::get('/show/{uuid}', 'show')->name('teams.show');
            Route::get('/', 'index')->name('teams.index');
            Route::post('/store', 'store')->name('teams.store');
            Route::put('/update/{uuid}', 'update')->name('teams.update');
            Route::delete('/destroy/{uuid}', 'destroy')->name('teams.destroy')->middleware('role:admin');               
        });
    });

    // LOGOUT
    Route::controller(AuthenticationController::class)->group(function () {
        Route::get('/logout', 'logout')->name('logout');             
    });
    
});
