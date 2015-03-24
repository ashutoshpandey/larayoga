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

Route::get('/our-story', 'StaticController@ourStory');
Route::get('/fabric-story', 'StaticController@fabricStory');
Route::get('/gift', 'StaticController@gift');
Route::get('/smogi-bucks', 'StaticController@smogiBucks');
Route::get('/track-order', 'StaticController@trackOrder');
Route::get('/namaskar', 'StaticController@namaskar');



/*********************** admin urls ************************/

Route::get('/admin', 'AdminController@index');

Route::get('/create-product', 'AdminProductController@createProduct');
Route::post('/save-product', 'AdminProductController@saveProduct');
Route::post('/update-product', 'AdminProductController@updateProduct');
Route::get('/remove-product', 'AdminProductController@removeProduct');
Route::get('/manage-products', 'AdminProductController@manageProducts');
Route::get('/import-products', 'AdminProductController@importProducts');
Route::get('/category-products', 'AdminProductController@categoryProducts');
Route::get('/find-product', 'AdminProductController@findProduct');

Route::get('/create-category', 'AdminCategoryController@createCategory');
Route::post('/save-category', 'AdminCategoryController@saveCategory');
Route::post('/update-category', 'AdminCategoryController@updateCategory');
Route::get('/remove-category', 'AdminCategoryController@removeCategory');
Route::get('/manage-categorys', 'AdminCategoryController@manageCategorys');
Route::get('/import-categorys', 'AdminCategoryController@importCategorys');
Route::get('/load-categories', 'AdminCategoryController@loadCategories');
Route::get('/find-category', 'AdminCategoryController@findCategory');


