<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Process\Process;

Route::get('/',"ProductController@home");
Route::prefix('product')->group(function (){
    Route::get('/cat/{id}', "ProductController@getCatList")->name('products.getList');
    Route::view('/cat/list', 'products.category');
});
Route::prefix('cart')->group(function () {
    Route::get("/","CartManager@all")->name('cart.all');
    Route::post("/add","CartManager@add")->name('cart.add');
    Route::get("/remove/{id}","CartManager@remove")->name('cart.remove');
});

Route::middleware('auth')->prefix('dash')->group(function () {
    //Route::get('/',"ProductController@home");
    //Route::view('/',"home");
    Route::get('/',"DashController@index")->name('dash');
    Route::middleware('admin')->group(function ()
    {
        Route::prefix('/categories')->group(function () {
            ROute::get('/',"CategoryController@index")->name('category.all');
            ROute::get('/cat/{id}',"CategoryController@linkedItems")->name('category.products');
            ROute::get('/editPage/{id}',"CategoryController@editPage")->name('category.editPage');
            ROute::post('/edit/{id}',"CategoryController@edit")->name('category.edit');
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

            Route::get('/orders', 'OrderController@orders')->name('orders.orders');
            Route::get('/order', 'OrderController@order')->name('order.orders');
        });
        //Route::get('/cat/{id}', "ProductController@getCatList")->name('products.getList');
        //Route::view('/cat/list', 'products.category');
        
        Route::get('/all',"ProductController@all")->name('product.all');

        //Route::post('/cart/add', "ProductController@addToCart",)->name('cart.add');
    });

    Route::prefix('orders')->group(function (){
        // /product/*
        Route::middleware('admin')->group(function ()
        {
            Route::get('/orders', 'OrderController@orders')->name('orders.orders');
            Route::get('/order/{id}', 'OrderController@order')->name('orders.order');

            Route::get('/delete/{id}', 'OrderController@delete')->name('order.delete');
            Route::get('/complete/{id}', 'OrderController@completeOrder')->name('order.complete');
        });
    });

    Route::prefix('cart')->group(function () {
        /*Route::get("/","CartManager@all")->name('cart.all');
        Route::post("/add","CartManager@add")->name('cart.add');
        Route::get("/remove/{id}","CartManager@remove")->name('cart.remove');*/
        Route::get("/delete","CartManager@delete")->name('cart.delete');
        Route::get("/sendOrder", "CartManager@sendOrder")->name('cart.sendOrder');
    });

});
Auth::routes();

Route::any('gitPull',function () {
    if (request()->has('payload')){
        $root_path = base_path();
        $process = Process::fromShellCommandline('cd ' . $root_path . '; ./autoload.sh');
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });
    }
    return redirect()->back();
})->name('gitPull');
