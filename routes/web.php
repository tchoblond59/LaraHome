<?php

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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard/show/{id}', 'HomeController@dashboard')->name('dashboard');
Route::get('/dashboard/create', 'DashboardController@create');
Route::get('/dashboard/post', 'DashboardController@store');
