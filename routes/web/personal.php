<?php

Route::group(['guard' => 'web', 'as' => 'pages.user.', 'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'user/tin-tuc', 'middleware' => ['permission']], function () {
        Route::get('posted', 'Web\UserController@news')->defaults('_config', [
            'view' => 'default.pages.users.news'
        ])->name('news');

        Route::get('pending-review', 'Web\UserController@approveNews')->defaults('_config', [
            'view' => 'default.pages.users.approve_news'
        ])->name('approve_news');
    });

    Route::get('trang-ca-nhan', 'Web\UserController@index')->defaults('_config', [
        'view' => 'default.pages.users.index'
    ])->name('index');

    Route::get('change-password', 'Web\UserController@changePassword')->defaults('_config', [
        'view' => 'default.pages.users.change_password'
    ])->name('change_password');
});
