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

Route::get('/', 'MovieController@index')->name('movies.index');
Route::get('/movies/{movie}', 'MovieController@show')->name('movie.show');

Route::get('/actors', 'ActorsController@index')->name('actors.index');
Route::get('/actors/{actor}', 'ActorsController@show')->name('actor.show');
Route::get('/actors/pages/{page}', 'ActorsController@index')->name('actor.index');