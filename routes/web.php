<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/seller/dashboard', 'SellerDashboardController@index')->name('seller');

Route::get('/p', 'ProductsController@create');
Route::post('/p', 'ProductsController@store');
Route::get('/p/all/{category?}', 'ProductsController@getAllPaginatedProducts');
Route::get('/p/{id}', 'ProductsController@get');

Route::get('/cart', 'CartProductController@view');
Route::post('/cart', 'CartController@store');

Route::post('/cart/products', 'CartProductController@store');
Route::get('/cart/products', 'CartProductController@get');
Route::post('/cart/product', 'CartProductController@updateQuantity');

Route::post('/checkout', 'CheckoutController@store');