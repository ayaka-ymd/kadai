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
Route::get('show', 'ProductController@show')->name('show');
Route::get('searchproduct', 'ProductController@search')->name('searchproduct');
Route::get('/newregister', 'ProductController@newregister')->name('newregister');
Route::post('/newproduct', 'ProductController@newproduct')->name('newproduct');
Route::get('/detail/{id}', 'ProductController@detail')->name('detail');
Route::get('/edit/{id}', 'ProductController@edit')->name('edit');
Route::post('/destroy{id}', 'ProductController@destroy')->name('destroy');
Route::get('/storage/images', 'ProductController@images')->name('images');