<?php

Route::group(['guard' => 'web',  'prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('danh-sach', 'Web\AdminController@index')->defaults('_config', [
        'view' => 'default.pages.admin.show_list_user'
    ])->name('admin.index');
});
