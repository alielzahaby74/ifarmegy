<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
Route::view('/',"home");

Route::middleware('auth')->prefix('dash')->group(function () {

    Route::view('/',"home");
    Route::view('/',"dash")->name('dash');
    Route::middleware('admin')->group(function ()
    {
        Route::prefix('/categories')->group(function () {
            ROute::get('/',"CategoryController@index")->name('category.all');
            ROute::get('/cat/{id}',"CategoryController@linkedItems")->name('category.products');
            ROute::get('/delete/{id}',"CategoryController@delete")->name('category.delete');
            ROute::get('/add',"CategoryController@add")->name('category.add');
            ROute::post('/add',"CategoryController@create")->name('category.create');
        });
    });
    Route::prefix('product')->group(function (){
        // /product/*
        Route::middleware('admin')->group(function ()
        {
            Route::get('/add',"ProductController@addPage")->name('product.add');
            Route::post('/add',"ProductController@create")->name('product.create');

            Route::get('/update/{id}',"ProductController@editPage")->name('product.edit');
            Route::post('/update/{id}',"ProductController@update")->name('product.update');
            Route::get('/delete/{id}',"ProductController@delete")->name('product.delete');
        });

        Route::get('/all',"ProductController@all")->name('product.all');

        //Route::post('/cart/add', "ProductController@addToCart",)->name('cart.add');
    });

    Route::prefix('cart')->group(function () {
        Route::get("/","CartManager@all")->name('cart.all');
        Route::post("/add","CartManager@add")->name('cart.add');
        Route::get("/remove/{id?}","CartManager@remove")->name('cart.remove');
        Route::get("/delete","CartManager@delete")->name('cart.delete');
        Route::get("/sendMail", "CartManager@sendMail")->name('cart.sendMail');
    });

});
Auth::routes();
