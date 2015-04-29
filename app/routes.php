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

Route::get('/', 'HomeController@index');
Route::get('/product', 'ProductController@product');
Route::get('/category', 'CategoryController@category');


/*********************** admin urls ************************/

Route::get('/admin', 'AdminController@index');
Route::get('/admin-logout', 'AdminController@logout');

/*********************** admin product urls ************************/

Route::get('/create-product', 'AdminProductController@createProduct');
Route::post('/save-product', 'AdminProductController@saveProduct');
Route::get('/edit-product/{id}', 'AdminProductController@editProduct');
Route::post('/update-product', 'AdminProductController@updateProduct');
Route::get('/remove-product', 'AdminProductController@removeProduct');
Route::get('/manage-products', 'AdminProductController@manageProducts');
Route::get('/import-products', 'AdminProductController@importProducts');
Route::post('/upload-products', 'AdminProductController@uploadProducts');
Route::get('/find-product', 'AdminProductController@findProduct');
Route::get('/load-products', 'AdminProductController@loadProducts');

Route::get('/associate-products', 'AdminProductController@associateProducts');
Route::get('/associate-for-product/{id}', 'AdminProductController@associateForProduct');
Route::post('/add-product-association', 'AdminProductController@addProductAssociation');
Route::post('/update-product-association', 'AdminProductController@updateProductAssociation');
Route::get('/load-associated-products', 'AdminProductController@loadAssociatedProducts');
Route::get('/load-products-for-associated-products', 'AdminProductController@loadProductsForAssociatedProducts');

Route::get('/similar-products', 'AdminProductController@similarProducts');
Route::post('/add-similar-products', 'AdminProductController@addSimilarProducts');
Route::get('/load-similar-products', 'AdminProductController@loadSimilarProducts');
Route::get('/load-products-for-similar-products', 'AdminProductController@loadProductsForSimilarProducts');
Route::get('/similar-for-product/{id}', 'AdminProductController@similarForProduct');
Route::post('/update-similar-products', 'AdminProductController@updateSimilarProducts');
Route::get('/package-products', 'AdminProductController@packageProducts');

/*********************** admin category urls ************************/

Route::get('/create-category', 'AdminCategoryController@createCategory');
Route::post('/save-category', 'AdminCategoryController@saveCategory');
Route::get('/edit-category/{id}', 'AdminCategoryController@editCategory');
Route::post('/update-category', 'AdminCategoryController@updateCategory');
Route::get('/remove-category', 'AdminCategoryController@removeCategory');
Route::get('/manage-categories', 'AdminCategoryController@manageCategories');
Route::post('/update-category-grid-order', 'AdminCategoryController@updateCategoryGridOrder');
Route::post('/update-product-grid-order', 'AdminCategoryController@updateProductGridOrder');
Route::post('/update-products-in-category', 'AdminCategoryController@updateProductsInCategory');
Route::get('/category-products', 'AdminCategoryController@categoryProducts');
Route::get('/get-category-products', 'AdminCategoryController@getCategoryProducts');
Route::get('/import-categories', 'AdminCategoryController@importCategories');
Route::get('/load-categories', 'AdminCategoryController@loadCategories');
Route::get('/find-category', 'AdminCategoryController@findCategory');
Route::get('/admin-category-tree', 'AdminCategoryController@getCategoryTree');

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
