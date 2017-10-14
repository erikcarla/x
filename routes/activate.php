<?php

Route::group(['namespace' => 'Auth'], function() use($int) {
    Route::get('activate/{token}', [
        'as' => 'activate',
        'uses' => 'ActivateController@index',
    ]);
    Route::post('activate', [
        'as' => 'activate.store',
        'uses' => 'ActivateController@store',
    ]);
});
