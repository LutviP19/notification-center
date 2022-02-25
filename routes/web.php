<?php

use App\Helpers;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\KlasemenController;
use App\Http\Controllers\KotakKatikController;
use App\Http\Controllers\PohonFaktorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'providers' => Helpers::providers]);
})->middleware(['auth'])->name('dashboard');

Route::prefix('auth')->group(function () {
    Route::get('google', [GoogleController::class, 'redirectToGoogle']);
    Route::get('google/callback', [GoogleController::class, 'handleGoogleCallback']);
});

require __DIR__ . '/auth.php';

// Process
/*Route::prefix('process')->group(function () {
    Route::post('save', [ProcessController::class, 'save']);
    Route::post('auto', [ProcessController::class, 'auto']);
});*/

/* Testing Broadcast */
Route::get('form', [TestController::class, 'form']);
Route::get('auto', [TestController::class, 'auto']);
Route::get('enkripsi', [TestController::class, 'enkripsi']);
Route::get('crypto', [TestController::class, 'crypto']);

Route::post('hit', [TestController::class, 'hit']);

/*============*/
Route::get('klasmen', [KlasemenController::class, 'index']);
Route::get('kk', [KotakKatikController::class, 'index']);
Route::get('pp', [PohonFaktorController::class, 'index']);

Route::get('test', function () {
    //event(new App\Events\TestEvent());
    //event(new App\Events\NotificationEvent('Monika'));
    event(new App\Events\StatusLiked('Linked Someone'));

    $userdata = new App\Models\Userdata();
    $userdata->user_id = 1;
    $userdata->phone_number = '0812999900099';
    $userdata->provider = 'telkomsel';
    $userdata->number_type = 'ganjil';

    event(new App\Events\ProcessUserdataEvent($userdata));
    event(new App\Events\ProcessAutoUserdataEvent([collect($userdata)]));

    echo "ok";
});