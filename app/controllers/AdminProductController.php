<?php

class AdminProductController extends BaseController
{
    public function __construct(){

        $this->beforeFilter(function(){
            View::share('root', URL::to('/'));
        });
    }

    public function createProduct(){
        return View::make('admin.product.createproduct');
    }

    public function saveProduct()
    {
        $validator = Validator::make(Input::all(), Product::$rules);

        if($validator->passes()){

            $id = Product::saveFormData(Input::all());
        }
        else
            echo "validation failed";
    }

    public function manageProducts(){
        return View::make('admin.product.manageproducts');
    }

    public function importProducts(){
        return View::make('admin.product.importproducts');
    }

    public function addProductToCategory()
    {
        $product_id = Input::get('product_id');
        $category_id = Input::get('category_id');

        if (isset($product_id) && is_int($product_id)) {

            if (isset($category_id) && is_int($category_id)) {

                $categoryProduct = CategoryProduct();

                $categoryProduct->product_id = $product_id;
                $categoryProduct->category_id = $category_id;

                $categoryProduct->save();

                echo "added";
            }
            else
                echo "invalid category";
        }
        else
            echo "invalid product";
    }

    public function removeProductFromCategory()
    {
        $product_id = Input::get('product_id');
        $category_id = Input::get('category_id');

        if (isset($product_id) && is_int($product_id)) {

            if (isset($category_id) && is_int($category_id)) {

                $categoryProduct = CategoryProduct::where('product_id', '=', $product_id)->where('category_id', '=', $category_id)->first();

                if (isset($categoryProduct)) {
                    $categoryProduct->delete();

                    echo "removed";
                }
                else
                    echo "not in category";
            }
            else
                echo "invalid category";
        }
        else
            echo "invalid product";
    }

    public function getProductCategories(){

        $product_id = Input::get('product_id');

        if (isset($product_id) && is_int($product_id)) {

            $categories = CategoryProduct::where('product_id', '=', $product_id)->get();

            return $categories;
        }
        else
            echo "invalid product";
    }

    public function categoryProducts(){
        return View::make('admin.category.categoryproducts');
    }

    public function getCategoryProducts(){

        $category_id = Input::get('category_id');
        $page = Input::get('category_id');
        $records_to_pick = Input::get('count');

        if(isset($page))
            $page = 1;

        if(isset($records_to_pick))
            $records_to_pick = 20;

        $skip_records = ($page-1)*20;

        if(isset($id) && is_int($id)){
            $products = Product::where('category_id', '=', $category_id)->where('status', '=', 'active')->take($records_to_pick)->skip($skip_records)->get();

            return $products;
        }
        else
            return NULL;
    }

    public function editProduct($id){

        if(isset($id)){

            $product = ProductHelper::getProduct($id);

            if($product){
                Session::put('edit_product_id', $id);

                return View::make('admin.product.editproduct')->with('product', $product);
            }
            else
                return Redirect::to('manage-products');
        }
    }

    public function updateProduct()
    {
        $id = Session::get('edit_product_id');

        if ($id) {

            $product = Product::find($id);

            if ($product) {

                Product::updateFormData(Input::except(array('id')));

                echo "updated";
            }
            else
                echo "not found";
        }
        else
            echo "invalid";
    }

    public function removeProduct()
    {
        $id = Input::get('id');

        if (isset($id)) {

            $product = Product::find($id);

            if ($product) {

                $product->status = "removed";
                $product->save();

                $productPics = ProductPicture::where('product_id', '=', $id)->get();

                if ($productPics) {

                    foreach ($productPics as $productPic) {

                        $productPic->status = 'removed';

                        $productPic->save();
                    }
                }

                echo "removed";
            }
            else
                echo "not found";
        }
        else
            echo "invalid";
    }

    public function findProduct($id)
    {
        $product = Product::find($id);

        return $product;
    }

    public function addAssociatedProduct()
    {
        $product_id = Input::get('product_id');
        $associated_product_ids = Input::get('associated_product_ids'); // will be an array

        if (isset($product_id) && is_int($product_id)) {

            if (isset($associated_product_ids) && is_array($associated_product_ids)) {

                foreach ($associated_product_ids as $associated_product_id) {

                    $tempAssociatedProduct = AssociatedProduct::where('product_id', '=', $product_id)
                        ->where('associated_product_id', '=', $associated_product_id)
                        ->first();

                    if (isset($tempAssociatedProduct))
                        $tempAssociatedProduct->delete();
                    else {
                        $associatedProduct = AssociatedProduct();

                        $associatedProduct->product_id = $product_id;
                        $associatedProduct->associated_product_id = $associated_product_id;

                        $associatedProduct->save();
                    }
                }
            }
            else
                echo "no associated";
        }
        else
            echo "invalid product";
    }

    public function removeAssociatedProduct($id)
    {
        if ($id && is_int($id)) {

            $associatedProduct = AssociatedProduct::find($id);

            if ($associatedProduct) {

                $associatedProduct->delete();

                echo "removed";
            }
            else
                echo "not found";
        }
        else
            echo "invalid";
    }

    public function setPreorderProduct()
    {
        $product_id = Input::get('product_id');

        if (isset($product_id) && is_int($product_id)) {

            $date_value = Input::get('date_value');

            $preorderProduct = PreorderProduct();

            $preorderProduct->product_id = $product_id;
            $preorderProduct->date_value = $date_value;

            $preorderProduct->save();
        }
        else
            echo "invalid product";
    }

    public function removePreOrderProduct($id)
    {
        if ($id && is_int($id)) {

            $preorderProduct = PreorderProduct::find($id);

            if ($preorderProduct) {

                $preorderProduct->delete();

                echo "removed";
            }
            else
                echo "not found";
        }
        else
            echo "invalid";
    }

    public function loadProducts(){

        $page = Input::get('page');
        $count = Input::get('count');
        $category_id = Input::get('category_id');

        if(!isset($page))
            $page = 1;

        if(!isset($count))
            $count = 20;

        if(!isset($category_id))
            $category_id = -1;

        $skip = ($page-1)*20;

        if($category_id==-1)
            $products = Product::where('status', '=', 'active')->take($count)->skip($skip)->get();
        else{
            $products = Product::whereHas('categories', function($q) use ($category_id)
            {
                $q->where('category_id', $category_id);
            })->where('status', 'active')
                ->take($count)
                ->skip($skip)
                ->get();
        }

        print_r($products);

        return $products;
    }
}