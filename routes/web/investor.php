<?php

Route::group(['guard' => 'web', 'middleware' => ['auth', 'permission']], function () {
    Route::get('/investor/create', 'Web\InvestorController@create')
        ->defaults('_config', ['view' => 'default.pages.investor.create'])
        ->name('pages.investor.create');

    Route::get('/investor/update/{investorId}', 'Web\InvestorController@update')
        ->defaults('_config', ['view' => 'default.pages.investor.update'])
        ->name('pages.investor.update');
});
