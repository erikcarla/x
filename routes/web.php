<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

$int = '\d+';

Route::group(['middleware' => ['auth']], function() use($int) {
    Route::get('home', [
        'as' => 'home.get',
        'uses' => 'HomeController@index',
    ]);
    require __DIR__.'/task.php';
});
