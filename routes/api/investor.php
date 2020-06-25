<?php

Route::group(['guard' => 'api', 'middleware' => ['auth:api']], function () {
    Route::get('/investor/autocomplete-field-search', 'Api\InvestorController@autocompleteFieldSearchInvestors')->name('api.project.autocompleteFieldSearchInvestors');
});
