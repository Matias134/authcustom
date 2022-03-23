<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
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
Route::controller(MainController::class)->group(function(){
    Route::get('/login', 'login')->name('main.login')->middleware('authcheck');
    Route::get('/register', 'register')->name('main.register')->middleware('authcheck');
    Route::get('/', 'welcome')->name('main.welcome')->middleware('authcheck');
});

Route::controller(UserController::class)->group(function(){
    Route::post('/login', 'login')->name('user.login');
    Route::post('/register', 'store')->name('user.store');
    Route::post('/getUser', 'getUser')->name('user.getUser');
    Route::get('/logout', 'logout')->name('user.logout');
});
