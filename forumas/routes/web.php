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
Route::get('/kategorijos', 'CategoriesController@index')->name('kategorijos.index');


Route::get('/temos/create/{id}', 'ThemesController@create')->name('temos.create')->middleware('auth');
Route::post('/temos/store', 'ThemesController@store')->name('temos.store');
Route::get('/temos/{id}', 'ThemesController@show')->name('temos.show');
Route::post('/temos/{id}/destroy', 'ThemesController@destroy')->name('temos.destroy');

Route::get('/komentarai/{id}', 'CommentsController@show')->name('komentarai.show');
Route::get('/komentarai/create/{id}', 'CommentsController@show')->name('komentarai.create');
Route::post('/komentarai/store', 'CommentsController@store')->name('komentarai.store');
Route::post('/komentarai/{id}/destroy', 'CommentsController@destroy')->name('komentarai.destroy');

Route::get('/profilis/{id}/edit', 'UsersController@edit')->name('profilis.edit')->middleware('auth');
Route::post('/profilis/{id}/update', 'UsersController@update')->name('profilis.update');

Route::get('komentarai/like/{id}', ['as' => 'komentarai.like', 'uses' => 'LikeController@likePost']);
