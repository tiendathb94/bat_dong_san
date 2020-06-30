<?php

Route::group(['guard' => 'api', 'middleware' => ['auth:api']], function () {
    Route::get('/investor/autocomplete-field-search', 'Api\InvestorController@autocompleteFieldSearchInvestors')
        ->name('api.project.autocompleteFieldSearchInvestors');

    Route::post('/investor/create', 'Api\InvestorController@create')->name('api.investor.create');
    Route::post('/investor/update/{investorId}', 'Api\InvestorController@update')->name('api.investor.update');
});
