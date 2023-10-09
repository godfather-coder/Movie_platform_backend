<?php

use App\Http\Controllers\Auth\Authentication;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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
Route::post('/login', [Authentication::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [Authentication::class, 'logout']);
    //genre
    Route::middleware(['admin'])->group(function () {
        Route::apiResource('/genre', GenreController::class)->only(['store']);
        Route::middleware(['locale'])->group(function () {
            Route::apiResource('/genre', GenreController::class)->except(['store']);
        });
    });
    //end Genre

    //users
    Route::get('/me', [ProfileController::class, 'getUserData']);
    Route::post('/me', [ProfileController::class, 'storeUserData']);
    Route::apiResource('/user', UserController::class);
    Route::post('/user_genre', [UserController::class, 'genre']);
    //end User

    //movie
    Route::apiResource('/movie', MovieController::class);
    //end movie

});