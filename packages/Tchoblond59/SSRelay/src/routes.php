<?php
    Route::group(['middleware' => ['web']], function () {
    Route::get('/sstestplugin', 'Tchoblond59\SSTestPlugin\SSTestPluginController@index');
});