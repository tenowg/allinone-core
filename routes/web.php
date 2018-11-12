<?php

use App\User;
use App\Notifications\TestNote;
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

Route::prefix('eve')->group(function() {
    Route::get('login', 'AuthController@evelogin');
    Route::get('callback', 'AuthController@evecallback');
});
