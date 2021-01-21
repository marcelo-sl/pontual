<?php

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

Route::middleware('guest')->group(function() {
    Route::get('/login', 'AuthenticateController@index')->name('auth.index');

    Route::post('/login', 'AuthenticateController@login')->name('auth.login');
    Route::view('/reset/password', 'auth.resetPassword')->name('auth.resetPass');
    Route::post('/reset/password', 'AuthenticateController@resetPassword')->name('auth.resetLink');
    
    Route::get('/register', function () {
        return view('auth.register');
    })->name('auth.register');
    
});

Route::get('/logout', 'AuthenticateController@logout')->name('auth.logout');

Route::middleware('auth')->group(function() {
    Route::get('/user/choose', 'UserController@choose')->name('user.choose');
    Route::resource('user', 'UserController');
    Route::post('/user/{id}/inactivate', 'UserController@inactivate')->name('user.inactivate');
    
});

Route::view('/home', 'layouts.app')->name('home');
