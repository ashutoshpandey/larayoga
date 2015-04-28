<?php

class AdminProductController extends BaseController
{
    public function __construct()
    {

        $this->beforeFilter(function () {
            View::share('root', URL::to('/'));
        });
    }

    public function createProduct()
    {
        return View::make('admin.product.create');
    }

    public function saveProduct()
    {
        $input = Input::except('btncreateproduct');

        $validator = Validator::make($input, Product::$rules);

        if ($validator->passes()) {

            $sku = Input::get('sku');

            $product = Product::where('sku', '=', $sku)->first();

            if (isset($product)) {
            }
            else {
                $name = Input::get('name');
                $quantity = Input::get('quantity');
                $price = Input::get('price');
                $special_price = Input::get('special_price');
                $pre_order = Input::get('pre_order');
                $url_key = Input::get('url_key');
                $description = Input::get('description');
                $page_title = Input::get('page_title');
                $custom_json_data = Input::get('custom_json_data');
                $header_data = Input::get('header_data');
                $status = Input::get('status');

                $status = $status == "yes" ? "active" : "inactive";

                $product = Product::create(
                    array(
                        'name' => $name,
                        'sku' => $sku,
                        'quantity' => $quantity,
                        'price' => $price,
                        'special_price' => $special_price,
                        'pre_order' => $pre_order,
                        'url_key' => $url_key,
                        'description' => $description,
                        'page_title' => $page_title,
                        'custom_json_data' => $custom_json_data,
                        'header_data' => $header_data,
                        'status' => $status,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                        'update_type' => 'created'
                    )
                );

                $category_id = Input::get('category_id');

                $categoryPassed = isset($category_id);

                if ($categoryPassed) {

                    $category = Category::find($category_id);

                    if (isset($category))
                        $this->associateProductToCategory($product->id, $category_id);
                }

                echo 'saved';
            }
        } else
            echo "validation failed";
    }

    public function manageProducts()
    {
        return View::make('admin.product.manage');
    }

    public function importProducts()
    {
        return View::make('admin.product.import');
    }

    public function similarProducts()
    {
        return View::make('admin.product.similar');
    }

    public function associateProducts()
    {
        return View::make('admin.product.associate');
    }

    public function associateForProduct($id)
    {
        $product = Product::find($id);

        if(isset($product)){

            Session::put('associate_parent_product_id', $id);

            return View::make('admin.product.associateforproduct')->with('product_id', $id)->with('product_name', $product->name)->with('found', true);
        }
        else
            return View::make('admin.product.associateforproduct')->with('found', false);
    }

    public function loadAssociatedProducts()
    {
        $page = Input::get('page');
        $count = Input::get('count');
        $product_id = Session::get('associate_parent_product_id');

        if (!isset($status))
            $status = 'active';

        if (!isset($page))
            $page = 1;

        if (!isset($count))
            $count = 20;

        $skip = ($page - 1) * 20;

        if(isset($product_id)){
            $product = Product::where('id', '=', $product_id)->first();

            if (isset($product)){
                  $products = Product::where('status', '=', 'active')->take($count)->skip($skip)->get();

//                $products = Product::whereHas('categories', function ($q) use ($category_id, $status) {
//                    $q->where('category_id', $category_id);
//                })->where('status', $status)
//                    ->take($count)
//                    ->skip($skip)
//                    ->get();
            }
            return $products;
        }
        else
            return null;
    }

    public function packageProducts()
    {
        return View::make('admin.product.package');
    }

    public function uploadProducts()
    {

        $file_uploaded = false;

        if (Input::file('file')->isValid()) {
            $destinationPath = 'public/product_uploads/'; // upload path
            $file_name = Input::file('file')->getClientOriginalName();
            $extension = Input::file('file')->getClientOriginalExtension(); // getting image extension
            $file_saved_name = intval(microtime(true)) . '.' . $extension; // renameing image

            $file_path = $destinationPath . $file_saved_name;

            Input::file('file')->move($destinationPath, $file_saved_name); // uploading file to given path

            $file_uploaded = true;
        }

        if ($file_uploaded) {
            $objPHPExcel = PHPExcel_IOFactory::load($file_path);

            $rows = $objPHPExcel->getActiveSheet()->toArray(null, null, true, true);

            // get column names
            $xlsFields = isset($rows[1]) ? $rows[1] : array();

            if (!empty($xlsFields)) unset($rows[1]);

            // remove key from key/value pair
            foreach ($xlsFields as $field)
                $fields[] = strtolower($field);

            $productHelper = new ProductHelper();

            // start reading rows
            $productCount = 0;

            foreach ($rows as $row) {

                $row_values = array();

                // remove key from key/value pair
                foreach ($row as $key => $value)
                    $row_values[] = $value;

                $productArray = $productHelper->getProductArray($row_values, $fields);

                unset($row_values);

                $sku = $productArray['sku'];

                $product = Product::where('sku', '=', $sku)->first();

                if (isset($product)) {
                }
                else {

                    $added_product = Product::create($productArray);

                    if (isset($added_product)){
                        $productCount++;

                        unset($added_product);
                    }
                }

                unset($product);
                unset($productArray);
                unset($sku);
                unset($row);
            }

            if ($productCount > 0)
                echo "Product added = " . $productCount;
            else
                echo "No products uploaded";
        } else
            echo "Invalid excel file";
    }

    public function addProductToCategory()
    {
        $product_id = Input::get('product_id');
        $category_id = Input::get('category_id');

        echo $this->associateProductToCategory($product_id, $category_id);
    }

    public function associateProductToCategory($product_id, $category_id)
    {

        if (isset($product_id)) {

            if (isset($category_id)) {

                $categoryProduct = new CategoryProduct();

                $categoryProduct->product_id = $product_id;
                $categoryProduct->category_id = $category_id;
                $categoryProduct->update_type = 'created';

                $categoryProduct->save();

                return "added";
            } else
                return "invalid category";
        } else
            return "invalid product";
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
                } else
                    echo "not in category";
            } else
                echo "invalid category";
        } else
            echo "invalid product";
    }

    public function getProductCategories()
    {

        $product_id = Input::get('product_id');

        if (isset($product_id) && is_int($product_id)) {

            $categories = CategoryProduct::where('product_id', '=', $product_id)->get();

            return $categories;
        } else
            echo "invalid product";
    }

    public function editProduct($id)
    {

        if (isset($id)) {

            $productHelper = new ProductHelper();

            $product = $productHelper->getProduct($id);

            if ($product) {
                Session::put('edit_product_id', $id);

                return View::make('admin.product.edit')->with('product', $product);
            } else
                return Redirect::to('manage-products');
        }
    }

    public function updateProduct()
    {
        $id = Session::get('edit_product_id');

        if ($id) {

            $product = Product::find($id);

            if ($product) {

                $name = Input::get('name');
                $sku = Input::get('sku');
                $quantity = Input::get('quantity');
                $price = Input::get('price');
                $special_price = Input::get('special_price');
                $pre_order = Input::get('pre_order');
                $url_key = Input::get('url_key');
                $description = Input::get('description');
                $page_title = Input::get('page_title');
                $custom_json_data = Input::get('custom_json_data');
                $header_data = Input::get('header_data');
                $status = Input::get('status');

                $status = $status == "yes" ? "active" : "inactive";

                $product->name = $name;
                $product->sku = $sku;
                $product->quantity = $quantity;
                $product->price = $price;
                $product->special_price = $special_price;
                $product->pre_order = $pre_order;
                $product->url_key = $url_key;
                $product->description = $description;
                $product->page_title = $page_title;
                $product->custom_json_data = $custom_json_data;
                $product->header_data = $header_data;
                $product->status = $status;
                $product->updated_at = date('Y-m-d h:i:s');
                $product->update_type = 'updated';

                $product->save();

                echo "updated";
            } else
                echo "not found";
        } else
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
            } else
                echo "not found";
        } else
            echo "invalid";
    }

    public function findProduct($id)
    {
        $product = Product::find($id);

        return $product;
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
        } else
            echo "invalid product";
    }

    public function removePreOrderProduct($id)
    {
        if ($id && is_int($id)) {

            $preorderProduct = PreorderProduct::find($id);

            if ($preorderProduct) {

                $preorderProduct->delete();

                echo "removed";
            } else
                echo "not found";
        } else
            echo "invalid";
    }

    public function loadProducts()
    {
        $page = Input::get('page');
        $count = Input::get('count');
        $category_id = Input::get('category_id');
        $status = Input::get('status');

        if (!isset($status))
            $status = 'active';

        if (!isset($page))
            $page = 1;

        if (!isset($count))
            $count = 20;

        if (!isset($category_id))
            $category_id = -1;

        $skip = ($page - 1) * 20;

        if ($category_id == -1)
            $products = Product::where('status', '=', 'active')->take($count)->skip($skip)->get();
        else {
            $products = Product::whereHas('categories', function ($q) use ($category_id, $status) {
                $q->where('category_id', $category_id);
            })->where('status', $status)
                ->take($count)
                ->skip($skip)
                ->get();
        }

        return $products;
    }

    public function addProductAssocation()
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
            } else
                echo "no associated";
        } else
            echo "invalid product";
    }

    public function updateProductAssocation()
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
            } else
                echo "no associated";
        } else
            echo "invalid product";
    }

    public function similarForProduct($id)
    {
        $product = Product::find($id);

        if(isset($product)){

            Session::put('similar_parent_product_id', $id);

            return View::make('admin.product.similarforproduct')->with('product_id', $id)->with('product_name', $product->name)->with('found', true);
        }
        else
            return View::make('admin.product.similarforproduct')->with('found', false);
    }

    public function loadSimilarProducts()
    {
        $page = Input::get('page');
        $count = Input::get('count');
        $product_id = Session::get('similar_parent_product_id');

        if (!isset($status))
            $status = 'active';

        if (!isset($page))
            $page = 1;

        if (!isset($count))
            $count = 20;

        $skip = ($page - 1) * 20;

        if(isset($product_id)){
            $product = Product::where('id', '=', $product_id)->first();

            if (isset($product)){
                $products = Product::where('status', '=', 'active')->take($count)->skip($skip)->get();

//                $products = Product::whereHas('categories', function ($q) use ($category_id, $status) {
//                    $q->where('category_id', $category_id);
//                })->where('status', $status)
//                    ->take($count)
//                    ->skip($skip)
//                    ->get();
            }
            return $products;
        }
        else
            return null;
    }

    public function addSimilarProducts()
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
            } else
                echo "no associated";
        } else
            echo "invalid product";
    }

    public function updateSimilarProducts()
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
            } else
                echo "no associated";
        } else
            echo "invalid product";
    }
}