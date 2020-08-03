<?php

// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    //add admin prefix and middleware for admin area
    Route::group(['prefix' => 'admin', 'middleware' => 'IsAdmin'], function () {
        Route::resource('/portfolio', 'Tir\Portfolio\Http\Controllers\AdminPortfolioController');
        Route::resource('/portfolioCategory', 'Tir\Portfolio\Http\Controllers\AdminPortfolioCategoryController');
    });

});