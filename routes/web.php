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

Route::get('/login', 'AuthenticateController@index')->name('auth.index');

Route::post('/login', 'AuthenticateController@login')->name('auth.login');
Route::get('/logout', 'AuthenticateController@logout')->name('auth.logout');

Route::get('/register', function () {
    return view('auth.register');
})->name('auth.register');

Route::resource('user', 'UserController');

Route::view('/home', 'layouts.app')->name('home');
