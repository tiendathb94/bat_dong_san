<?php

Route::group(['guard' => 'web', 'middleware' => 'auth'], function () {
    Route::get('/project/create', 'Web\ProjectController@create')->defaults('_config', [
        'view' => 'default.pages.project.create'
    ])->name('pages.project.create');
    Route::get('trang-ca-nhan', 'Web\UserController@index')->defaults('_config', [
        'view' => 'default.pages.users.index'
    ])->name('pages.users.index');
    Route::delete('news/{id}', 'Web\NewsController@destroy')->name('pages.news.destroy');
});
