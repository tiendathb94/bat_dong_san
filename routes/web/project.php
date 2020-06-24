<?php

Route::group(['guard' => 'web', 'middleware' => ['auth']], function () {
    Route::get('/project/create', 'Web\ProjectController@create')->defaults('_config', [
        'view' => 'default.pages.project.create'
    ])->name('pages.project.create');
});
