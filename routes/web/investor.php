<?php

Route::group(['guard' => 'web', 'middleware' => ['auth', 'permission']], function () {
    Route::get('/investor/create', 'Web\InvestorController@create')->defaults('_config', [
        'view' => 'default.pages.investor.create'
    ])->name('pages.investor.create');
});
