<?php

Route::post('task', [
    'as' => 'task.store',
    'uses' => 'HomeController@store',
]);
Route::delete('task/{id}', [
    'as' => 'task.destroy',
    'uses' => 'HomeController@destroy',
])->where(['id' => $int]);
