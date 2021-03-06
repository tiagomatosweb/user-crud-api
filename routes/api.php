<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function() {
    Route::prefix('users')->group(function() {
        Route::get('', [UserController::class, 'index']);
        Route::post('', [UserController::class, 'store']);
        Route::put('{user}', [UserController::class, 'update']);
        Route::get('{user}', [UserController::class, 'show']);
        Route::delete('{user}', [UserController::class, 'destroy']);
    });
});
