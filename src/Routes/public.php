<?php

// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    //add admin prefix and middleware for admin area
        Route::get('/portfolio/{slug}', 'Tir\Portfolio\Http\Controllers\PublicPortfolioController@portfolioDetails')->name('portfolio.details');
        Route::get('/category/{slug}', 'Tir\Portfolio\Http\Controllers\PublicPortfolioController@category')->name('portfolio.category');

});