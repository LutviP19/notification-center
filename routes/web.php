<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\TestController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'providers' => Controller::providers]);
})->middleware(['auth'])->name('dashboard');

Route::prefix('auth')->group(function () {
    Route::get('google', [GoogleController::class, 'redirectToGoogle']);
    Route::get('google/callback', [GoogleController::class, 'handleGoogleCallback']);
});

require __DIR__ . '/auth.php';

/* Testing Broadcast */
Route::get('form', [TestController::class, 'form']);
Route::get('enkripsi', [TestController::class, 'enkripsi']);

Route::post('hit', [TestController::class, 'hit']);

Route::get('test', function () {
    event(new App\Events\NotificationEvent('Monika'));
    /*event(new App\Events\CekNomerEvent('0812-1236-7896'));
    event(new App\Events\ProsesData('0812-1236-7896'));

    $developers=[1];
    $deployment=['invoice_id' => 1, 'amount' => 888888,];
    Notification::sendNow($developers, new ProsesDataSelesai($deployment));
    return "Event has been sent!";*/
});