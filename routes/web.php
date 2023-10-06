<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::controller(ProductController::class)->group(function(){

    Route::get('/', 'index')->name('all.product');
    Route::get('/create-product', 'create')->name('create.product');

    Route::post('store-product', 'store')->name('store.product');

});
