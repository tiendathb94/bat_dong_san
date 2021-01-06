<?php

Route::group(['guard' => 'web',  'prefix' => 'admin', 'middleware' => ['auth','permission']], function () {
    Route::get('danh-sach', 'Web\AdminController@index')->defaults('_config', [
        'view' => 'default.pages.admin.show_list_user'
    ])->name('admin.index');
});
