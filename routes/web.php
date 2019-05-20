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

Route::get('/error/{code}', function($code){
    return view('errors.'.$code);
});

    Route::get('/', 'HomeController@index')->name('home');
    //Route::get('/api/{api_id}', 'HomeController@api');
    Route::post('/api/{api_id}', 'HomeController@api');
    Route::get('/dashboard/show/{id}', 'DashboardController@show')->name('dashboard');

    Route::get('/dashboard/create', 'DashboardController@create');
    Route::post('/dashboard/create', 'DashboardController@store');
    Route::get('/dashboard/edit/{id}', 'DashboardController@edit');
    Route::post('/dashboard/addwidget/{id}', 'DashboardController@addWidget');
    Route::post('/dashboard/deletewidget/{id}', 'DashboardController@deleteWidget');
    Route::post('/dashboard/addScenario/{id}', 'DashboardController@addScenario');
    Route::post('/dashboard/deleteScenario/{id}', 'DashboardController@deleteScenario');


    Route::get('/widget/SSTemp/{id}', 'SSTempController@configureWidget');

    Route::get('/sensors', 'SensorController@index');
    Route::get('/sensor/add', 'SensorController@create');
    Route::get('/sensor/mscommands/shortcut/{random}', 'SensorController@triggerShortcut');
    Route::post('/sensor/add', 'SensorController@store');
    Route::get('/sensor/update/{id}', 'SensorController@update');
    Route::post('/sensor/update/{id}', 'SensorController@upgrade');
    Route::post('/sensor/delete/{id}', 'SensorController@delete');

    Route::get('/commands', 'CommandController@index');
    Route::post('/command/play/{id}', 'CommandController@play');
    Route::post('/command/delete/{id}', 'CommandController@delete');
    Route::post('/command/enable/{id}', 'CommandController@enable');
    Route::post('/command/shortcut/create', 'CommandController@createShortcut');
    Route::get('/command/shortcut/{id}', 'CommandController@playShortcut');
    Route::get('/command/edit/{id}', 'CommandController@edit');
    Route::post('/command/update/{id}', 'CommandController@update');

    Route::get('/scenarios', 'ScenarioController@index');
    Route::get('/scenario/update/{id}', 'ScenarioController@edit');
    Route::post('/scenario/create', 'ScenarioController@create');
    Route::post('/scenario/command/add/{id}', 'ScenarioController@addCommand');
    Route::post('/scenario/command/delete/{id}', 'ScenarioController@deleteCommand');
    Route::post('/scenario/delete/{id}', 'ScenarioController@delete');
    Route::post('/scenario/play/{id}', 'ScenarioController@play');
    Route::post('/scenario/enable/{id}', 'ScenarioController@enable');
    Route::post('/scenario/shortcut/create/{id}', 'ScenarioController@createShortcut');
    Route::post('/scenario/cron/edit/{id}', 'ScenarioController@cron');
    Route::get('/scenario/shortcut/play/{random}', 'ScenarioController@playShortcut');

    Route::get('/widget/edit/{id}', 'WidgetController@edit');
    Route::post('/widget/update/{id}', 'WidgetController@update');

Route::middleware(['auth'])->group(function () {
    Route::get('/message', 'MessageController@index');
});
    Route::get('/spotify', 'SpotifyController@index')->name('spotify');
    Route::get('/spotify/ok', 'SpotifyController@spotifyok')->name('spotify_ok');
    Route::get('/spotify/test', 'SpotifyController@test');
    Route::get('/spotify/config', 'SpotifyController@config')->name('spotify_config');
    Route::post('/spotify/updateDefaultDevice', 'SpotifyController@updateDefaultDevice');
    Route::post('/spotify/updateDefaultTrack', 'SpotifyController@updateDefaultTrack');
    Route::post('/spotify/search/track', 'SpotifyController@searchTrack');
    Route::post('/spotify/search/playlist', 'SpotifyController@searchPlaylist');
    Route::post('/spotify/command/create', 'SpotifyController@createAction');

Route::middleware(['role:admin,update sensor'])->group(function () {
    Route::get('/role', 'RoleController@index');
    Route::get('/role/create', 'RoleController@create');
    Route::post('/role/store', 'RoleController@store');
    Route::post('/role/delete/{id}', 'RoleController@delete');
    Route::get('/role/edit/{id}', 'RoleController@edit');
    Route::post('/role/update/{id}', 'RoleController@update');
    Route::post('/role/addPermission/{id}', 'RoleController@addPermission');
    Route::post('/role/deletePermission/{id}', 'RoleController@deletePermission');

    Route::get('/permission', 'PermissionController@index');
    Route::get('/permission/create', 'PermissionController@create');
    Route::post('/permission/store', 'PermissionController@store');
    Route::post('/permission/delete/{id}', 'PermissionController@delete');
    Route::get('/permission/edit/{id}', 'PermissionController@edit');
    Route::post('/permission/update/{id}', 'PermissionController@update');

    Route::get('/plugins', 'PluginController@index');
    Route::get('/plugins/update', 'PluginController@update');
    Route::post('/plugins/install', 'PluginController@install');
    Route::post('/plugins/enable', 'PluginController@enable');
    Route::post('/plugins/disable', 'PluginController@disable');
    Route::get('/plugins/export', 'PluginController@export');
});
Route::middleware([])->group(function () {
    Route::get('/user', 'UserController@index');
    Route::get('/user/create', 'UserController@create');
    Route::post('/user/create', 'UserController@store');
    Route::get('/user/edit/{id}', 'UserController@edit');
    Route::post('/user/update/{id}', 'UserController@update');
    Route::post('/user/delete/{id}', 'UserController@delete');
    Route::post('/user/addRole/{id}', 'UserController@addRole');
    Route::post('/user/deleteRole/{id}', 'UserController@deleteRole');
});
Route::get('test', 'HomeController@test');