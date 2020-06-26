<?php

Route::group(['guard' => 'web', 'middleware' => ['auth', 'permission']], function () {
    Route::get('/project/create', 'Web\ProjectController@create')->defaults('_config', [
        'view' => 'default.pages.project.create'
    ])->name('pages.project.create');

    Route::get('/project/posted', 'Web\ProjectController@managePostedProject')->defaults('_config', [
        'view' => 'default.pages.project.show_posted'
    ])->name('pages.project.show_posted');
});
