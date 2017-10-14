<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() use($int) {
    require __DIR__.'/admin/article.php';
});
