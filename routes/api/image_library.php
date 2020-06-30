<?php

Route::group(['guard' => 'api', 'middleware' => ['auth:api']], function () {
    Route::post('/image-library/uploads', 'Api\ImageLibraryController@uploadImages')->name('api.image_library.uploadImages');
    Route::post('/image-library/deletes', 'Api\ImageLibraryController@deleteLibraries')->name('api.image_library.deleteLibraries');
});
