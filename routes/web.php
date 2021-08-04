<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
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

Route::get('/', [CalendarController::class, 'index']);

Route::get('/testRequest', [\App\Http\Controllers\EventController::class, 'testRequestForNotification']);

Route::get('/testNotification', [\App\Http\Controllers\EventController::class, 'testTimeNotification']);

Route::get('/cancelNotification', [\App\Http\Controllers\EventController::class, 'cancelNotification']);

require __DIR__.'/auth.php';

