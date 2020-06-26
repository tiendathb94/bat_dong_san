<?php

Route::group(['guard' => 'web', 'middleware' => ['auth']], function () {
    Route::get('trang-ca-nhan', 'Web\UserController@index')->defaults('_config', [
        'view' => 'default.pages.users.index'
    ])->name('pages.users.index');
});
