<?php

$int = '\d+';

Auth::routes();

Route::get('rss', [
    'as' => 'rss',
    'uses' => 'RssController@index',
]);
require __DIR__.'/activate.php';
require __DIR__.'/home.php';

Route::group(['middleware' => ['auth']], function() use($int) {
    require __DIR__.'/admin.php';
});
