<?php

Route::group(['guard' => 'web', 'as' => 'pages.user.', 'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'user', 'middleware' => ['permission']], function () {
        Route::get('news', 'Web\UserController@news')->defaults('_config', [
            'view' => 'default.pages.users.news'
        ])->name('news');
        Route::get('approve-news', 'Web\UserController@approveNews')->defaults('_config', [
            'view' => 'default.pages.users.approve_news'
        ])->name('approve_news');
    });

    Route::get('trang-ca-nhan', 'Web\UserController@index')->defaults('_config', [
        'view' => 'default.pages.users.index'
    ])->name('index');
});
