<?php

Route::get('/', [
    'as' => 'home.index',
    'uses' => 'HomeController@index',
]);
Route::get('/{id}', [
    'as' => 'home.read',
    'uses' => 'HomeController@read',
]);

Route::get('/{id}/generate', [
    'as' => 'home.generate',
    'uses' => 'HomeController@generate',
]);

