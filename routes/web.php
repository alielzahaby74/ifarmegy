<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
Route::view('/',"home");

Route::middleware('auth')->prefix('dash')->group(function () {
    Route::view('/',"dash")->name('dash');

    Route::prefix('/categories')->group(function () {
        ROute::get('/',"CategoryController@index")->name('category.all');
        ROute::get('/cat/{id}',"CategoryController@linkedItems")->name('category.products');
        ROute::get('/add',"CategoryController@add")->name('category.add');
        ROute::post('/add',"CategoryController@create")->name('category.create');
    });

    Route::prefix('product')->group(function (){
        // /product/*
        Route::get('/add',"ProductController@addPage")->name('product.add');
        Route::post('/add',"ProductController@create")->name('product.create');

        Route::get('/update/{id}',"ProductController@editPage")->name('product.edit');
        Route::post('/update/{id}',"ProductController@update")->name('product.update');
        Route::get('/delete/{id}',"ProductController@delete")->name('product.delete');

        Route::get('/all',"ProductController@all")->name('product.all');
        
        Route::post('/cart/add', "ProductController@addToCart",)->name('cart.add');
    });



});
Auth::routes();
