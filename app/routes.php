<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::get('/', function()
//{
//	return View::make('hello');
//});

Route::get('/', 'StaticController@index');
Route::get('/women', 'StaticController@women');
Route::get('/men', 'StaticController@men');

Route::get('/admin', 'AdminController@index');

Route::get('/create-product', 'AdminProductController@createProduct');
Route::get('/manage-products', 'AdminProductController@manageProducts');
Route::get('/import-products', 'AdminProductController@importProducts');

Route::get('/create-category', 'AdminCategoryController@createCategory');
Route::get('/manage-categories', 'AdminCategoryController@manageCategories');
Route::get('/category-products', 'AdminCategoryController@categoryProducts');