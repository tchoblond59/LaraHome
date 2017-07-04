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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/dashboard/show/{id}', 'DashboardController@show')->name('dashboard');
Route::get('/dashboard/create', 'DashboardController@create');
Route::post('/dashboard/create', 'DashboardController@store');
Route::get('/dashboard/edit/{id}', 'DashboardController@edit');
Route::post('/dashboard/addwidget/{id}', 'DashboardController@addWidget');

Route::get('/widget/SSRelay/{id}', 'SSRelayController@configureWidget');
Route::get('/widget/SSTemp/{id}', 'SSTempController@configureWidget');

Route::post('/SSRelay/action/create/{id}','SSRelayController@store');
Route::post('/SSRelay/action/toggle','SSRelayController@toggle');
Route::get('/SSRelay/update/{id}','SSRelayController@update');
Route::post('/SSRelay/update/{id}','SSRelayController@upgrade');


Route::get('/real-time/test', 'SSRelayController@realTimeTest');

Route::get('/sensors', 'SensorController@index');
Route::get('/sensor/add', 'SensorController@create');
Route::get('/sensor/mscommands/shortcut/{random}', 'SensorController@triggerShortcut');
Route::post('/sensor/add', 'SensorController@store');
Route::get('/sensor/update/{id}', 'SensorController@update');
Route::post('/sensor/update/{id}', 'SensorController@upgrade');
Route::post('/sensor/delete/{id}', 'SensorController@delete');

Route::get('/config', 'ConfigController@show');
Route::post('/config/scheduled_task/create', 'ConfigController@createScheduledTask');
Route::post('/config//mscommands/shortcut/create', 'ConfigController@CreateMSCommandShortcut');
