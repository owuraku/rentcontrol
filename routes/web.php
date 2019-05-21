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

Route::get('/','HomeController@index');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//route for properties
Route::get('/property/me','PropertyController@myProperties')->name('property.me');
Route::get('/property/add', 'PropertyController@addProperty')->name('property.add.form');
Route::post('/property/add','PropertyController@addProperty')->name('property.add');
Route::get('/property/{type}', 'HomeController@getAllProperties')->name('property.all');
Route::get('/property/show/{property}', 'HomeController@show')->name('property.get');
Route::post('/property/rate/pay', 'PropertyController@payRate')->name('property.pay.rate');
Route::post('/property/own/pay', 'PropertyController@payForOwnership')->name('property.pay.own');
Route::put('/property/{property}')->name('property.edit');
Route::delete('/property/{property}')->name('property.delete');
