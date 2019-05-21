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

// frontend
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/getCart', 'HomeController@getCart')->name('getCart');
Route::post('/removeFromCart', 'HomeController@removeFromCart')->name('removeFromCart');
// Route::post('/addToCart', 'HomeController@addToCart')->name('addToCart');
Route::match(['get', 'post'], '/addToCart', 'HomeController@addToCart')->name('addToCart');

// backend 
// laravel default auth feature 
Auth::routes();
Route::get('/add', 'ProductsController@create')->name('newProd');
Route::post('/addProduct', 'ProductsController@store')->name('addProduct');
Route::get('/deleteProduct/{id}', 'ProductsController@destroy')->name('deleteProduct');
Route::post('/editProduct', 'ProductsController@update')->name('editProduct');
Route::get('/getProduct/{id}', 'ProductsController@edit')->name('getProduct');
Route::get('/listProducts', 'ProductsController@index')->name('listProducts');
// Route::get('login', 'HomeController@login')->name('login');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
// Route::get('/register', 'HomeController@signup')->name('register');

// avoid direct access to this route using auth middleware
Route::get('/dashboard', 'ProductsController@index');
