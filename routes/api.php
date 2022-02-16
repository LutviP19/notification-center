<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProcessController;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

/* ------------------------ For Password Grant Token ------------------------ */
Route::post('login-grant',  [UserController::class, 'loginGrant']);
Route::post('refresh',      [UserController::class, 'refreshToken']);

Route::middleware('auth:api')->group(function () {
    Route::get('logout',    [UserController::class, 'logout']);
    Route::get('profile',      [UserController::class, 'getUser']);

    Route::get('users/{user}', [UserController::class, 'show']);

    // Process
    Route::prefix('process')->group(function () {
        Route::post('save', [ProcessController::class, 'save']);
        Route::post('auto', [ProcessController::class, 'auto']);
    });
});

Route::get('unauthorized', function () {
    return response()->json([
        'error' => 'Unauthorized.'
    ], 401);
})->name('unauthorized');

/* -------------------------------- Fallback -------------------------------- */
Route::any('{segment}', function () {
    return response()->json([
        'error' => 'Invalid url.'
    ]);
})->where('segment', '.*');
