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

Route::post('/register', 'AuthenticateController@store')->name('auth.store');

Route::middleware('auth')->group(function () {
    /** Users routes  */
    Route::get('/user/choose', 'UserController@choose')->name('user.choose');
    Route::get('/user/{id}', 'UserController@show')->name('user.show');
    Route::get('/user/{id}/edit', 'UserController@edit')->name('user.edit');
    Route::put('/user/{id}', 'UserController@update')->name('user.update');
    
    /** Companies routes  */
    Route::get('/company/create', 'CompanyController@create')->name('company.create');
    Route::post('/company', 'CompanyController@store')->name('company.store');
    Route::get('/company/{id}', 'CompanyController@show')->name('company.show');
    
    Route::middleware('checkRole:Admin')->group(function () {
        /** Users routes  */
        Route::get('/user', 'UserController@index')->name('user.index');
        Route::post('/user', 'UserController@store')->name('user.store');
        Route::get('/user/create', 'UserController@create')->name('user.create');
        Route::delete('/user/{id}', 'UserController@destroy')->name('user.destroy');
        Route::post('/user/{id}/inactivate', 'UserController@inactivate')->name('user.inactivate');

        /** Companies routes  */
        Route::get('/company', 'CompanyController@index')->name('company.index');
        Route::post('/company/{id}/inactivate', 'CompanyController@inactivate')->name('company.inactivate');
        Route::delete('/company/{id}', 'CompanyController@destroy')->name('company.destroy');
    });
});

Route::get('/findCityByName/{uf}/{city}', 'FindCityByName');
Route::get('/filterCitiesByUf/{uf}', 'FilterCitiesByUf');