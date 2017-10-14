<?php

Route::get('article', [
    'as' => 'admin.article.index',
    'uses' => 'ArticlesController@index',
]);

Route::get('article/create', [
    'as' => 'admin.article.create',
    'uses' => 'ArticlesController@create',
]);

Route::post('article', [
    'as' => 'admin.article.store',
    'uses' => 'ArticlesController@store',
]);

Route::post('article/{id}/destroy', [
    'as' => 'admin.article.destroy',
    'uses' => 'ArticlesController@destroy',
])->where(['id' => $int]);

Route::post('article/{id}/publish_unpublish', [
    'as' => 'admin.article.publish_unpublish',
    'uses' => 'ArticlesController@publishUnpublish',
])->where(['id' => $int]);

