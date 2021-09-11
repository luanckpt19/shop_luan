<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','App\Http\Controllers\HomeController@index')->name('home');
Route::get('/category/{slug}/{id}',[
    'as' => 'category.product',
    'uses' => 'App\Http\Controllers\CategoryController@index'
]);

 //Add to cart
Route::get('add-to-cart/{id}','App\Http\Controllers\ProductController@addToCart')->name('addToCart');
//showw
Route::get('show-cart','App\Http\Controllers\ProductController@showCart')->name('showCart');

Route::get('products/update-cart','App\Http\Controllers\ProductController@updateCart')->name('updateCart');
//delete

Route::get('products/delete-cart','App\Http\Controllers\ProductController@deleteCart')->name('deleteCart');


Route::get('products/payment','App\Http\Controllers\ProductController@payment')->name('payment');

Route::post('/payment/checkout', "App\Http\Controllers\PaymentController@checkout");

