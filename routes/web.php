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

Route::get('/','Home@index');
Route::get('listing','Listing@index');
Route::get('listing/people/{id}','Listing@people_listing');
Route::get('listing/film/{id}','Listing@film_listing');

Route::post('home/save/people','Home@savePeoples');
Route::post('home/save/films','Home@saveFilms');



