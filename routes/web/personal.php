<?php

Route::group(['guard' => 'web', 'as' => 'pages.user.', 'prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::get('news', 'Web\UserController@index')->defaults('_config', [
        'view' => 'default.pages.users.news'
    ])->name('news');
});
