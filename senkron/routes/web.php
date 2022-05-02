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

Route::any('/acp', 'VueController');
Route::any('/acp/{any}', 'VueController')->where('any', '.*');


Route::get('/language/{language}', 'HomeController@language')->name('language');
Route::get('/product/{product}', 'HomeController@product')->name('product');
Route::get('/page/{page}', 'HomeController@page')->name('page');
Route::get('/', 'HomeController@home')->name('home');
Route::get('/contact_us', 'HomeController@contact_us')->name('contact_us');
Route::get('/products', 'HomeController@products')->name('products');
Route::post('/contact', 'HomeController@contact')->name('contact');
//Route::get('/resize_all_images', 'HomeController@resize_all_images')->name('resize_all_images');

