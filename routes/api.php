<?php

use App\Http\Controllers\ProcessController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::middleware(['auth', 'throttle:6,1'])->group(function () {
// Process
Route::prefix('process')->group(function () {
    Route::post('save', [ProcessController::class, 'save']);
    Route::post('auto', [ProcessController::class, 'auto']);
});
//});