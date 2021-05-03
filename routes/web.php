<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/* Product Routes */
Route::get('/', 'ProductController@index')->name('products.index');
Route::get('/boutique/{slug}', 'ProductController@show')->name('products.show');
Route::get("/search", "ProductController@search")->name("products.search");

Route::group(["middleware" => ["auth"]], function() {

    /* Cart Routes list*/ 
    Route::post("cart/add", "CartController@store")->name("cart.store");
    Route::get("cart", "CartController@index")->name("cart.index");
    Route::delete("cart/{rowId}", "CartController@destroy")->name("cart.destroy");
    Route::post("cart/{rowId}", "CartController@update")->name("cart.update");
    // user orders route
    Route::get("orders",function(){return view("users.orders");})->name('user.orders');

    // Checkout route 
    Route::get("checkout", "CheckoutController@indeX")->name("checkout.index");
    Route::post("checkout", "CheckoutController@store")->name("checkout.store");
    Route::get("/success", "CheckoutController@success")->name("checkout.success");

});

Auth::routes();
