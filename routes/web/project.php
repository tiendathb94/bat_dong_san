<?php

Route::group(['guard' => 'web', 'middleware' => ['auth', 'permission']], function () {
    Route::get('/project/create', 'Web\ProjectController@create')->defaults('_config', [
        'view' => 'default.pages.project.create'
    ])->name('pages.project.create');
});
