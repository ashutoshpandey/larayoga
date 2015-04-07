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

Route::get('/product', 'ProductController@product');
Route::get('/category', 'CategoryController@category');


/*********************** admin urls ************************/

Route::get('/admin', 'AdminController@index');

/*********************** admin product urls ************************/

Route::get('/create-product', 'AdminProductController@createProduct');
Route::post('/save-product', 'AdminProductController@saveProduct');
Route::get('/edit-product/{id}', 'AdminProductController@editProduct');
Route::post('/update-product', 'AdminProductController@updateProduct');
Route::get('/remove-product', 'AdminProductController@removeProduct');
Route::get('/manage-products', 'AdminProductController@manageProducts');
Route::get('/import-products', 'AdminProductController@importProducts');
Route::get('/category-products', 'AdminProductController@categoryProducts');
Route::get('/find-product', 'AdminProductController@findProduct');
Route::get('/load-all-products', 'AdminProductController@loadAllProducts');

/*********************** admin category urls ************************/

Route::get('/create-category', 'AdminCategoryController@createCategory');
Route::post('/save-category', 'AdminCategoryController@saveCategory');
Route::post('/update-category', 'AdminCategoryController@updateCategory');
Route::get('/remove-category', 'AdminCategoryController@removeCategory');
Route::get('/manage-categories', 'AdminCategoryController@manageCategories');
Route::get('/import-categories', 'AdminCategoryController@importCategories');
Route::get('/load-categories', 'AdminCategoryController@loadCategories');
Route::get('/find-category', 'AdminCategoryController@findCategory');


/*********************** customer urls ************************/

Route::get('/create-customer', 'CustomerController@createCustomer');

/*********************** cart urls ************************/

Route::get('/add-to-cart', 'CartController@addToCustomer');
Route::get('/remove-from-cart', 'CartController@removeFromCustomer');
Route::get('/get-cart-count', 'CartController@getCartCount');
Route::get('/get-cart', 'CartController@getCart');


/*********************** cart urls ************************/

Route::get('/create-order', 'OrderController@createCustomer');

/*********************** authentication urls ************************/

Route::get('/is-valid-customer', 'AuthenticationController@isValidCustomer');
Route::get('/is-duplicate-customer', 'AuthenticationController@isDuplicateCustomer');
Route::get('/logout', 'AuthenticationController@logout');



/***************** yogasmoga urls ****************/
Route::get('/women', 'StaticController@women');
Route::get('/men', 'StaticController@men');
Route::get('/our-story', 'StaticController@ourStory');
Route::get('/fabric-story', 'StaticController@fabricStory');
Route::get('/gift', 'StaticController@gift');
Route::get('/smogi-bucks', 'StaticController@smogiBucks');
Route::get('/track-order', 'StaticController@trackOrder');
Route::get('/namaskar', 'StaticController@namaskar');


/***************** dynamic route at the bottom ****************/
Route::get('/{data}', 'StaticController@index');
