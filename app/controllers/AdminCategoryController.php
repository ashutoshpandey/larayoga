<?php

class AdminCategoryController extends BaseController {

    public function createCategory(){

        return View::make('admin.category.create');
    }

    public function getCategoryTree(){

        $categoryHelper = new CategoryHelper();

        $category_tree = $categoryHelper->getCategoryTree();

        return View::make('admin.category.tree')->with('category_tree', $category_tree);
    }

    public function manageCategories(){
        return View::make('admin.category.manage');
    }

    public function saveCategory(){
        $name = Input::get('name');
        $url_key = Input::get('url_key');
        $description = Input::get('description');

        $parent_id = Input::get('parent_id');
        if(!$parent_id)
            $parent_id = -1;

        $existingCategory = Category::where('name', '=', $name)
                                    ->where('parent_id', '=', $parent_id)
                                    ->where('status', '=', 'active')
                                    ->first();

        if($existingCategory){
            echo "exists";
        }
        else{
            $category = new Category;

            $category->image_name = Constants::$CATEGORY_DEFAULT_IMAGE;
            $category->image_saved_name = Constants::$CATEGORY_DEFAULT_IMAGE;

            if (Input::file('image')->isValid()) {
                $destinationPath = 'public/images/categories'; // upload path
                $image_name = Input::file('image')->getClientOriginalName();
                $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                $image_saved_name = microtime(true) . $extension; // renameing image

                Input::file('image')->move($destinationPath, $image_saved_name); // uploading file to given path

                $category->image_name = $image_name;
                $category->image_saved_name = $image_saved_name;
            }

            $category->name = $name;
            $category->url_key = $url_key;
            $category->description = $description;
            $category->parent_id = $parent_id;

            $category->status = "active";
            $category->created_at = date("Y-m-d h:i:s");
            $category->updated_at = date("Y-m-d h:i:s");

            $category->save();

            echo "done";
        }
    }

    public function findCategory(){
        $id = Input::get('id');

        $category = Category::find($id);

        if($category)
            return $category;
        else
            return null;
    }

    public function editCategory($id){

        $category = Category::find($id);

        if($category)
            return View::make('admin.category.edit')->with('category', $category)->with('found', true);
        else
            return View::make('admin.category.edit')->with('found', false);
    }

    public function updateCategory(){
        $id = Input::get('id');

        $category = Category::find($id);

        if(is_null($category))
            return "invalid";
        else{
            if (Input::file('image')->isValid()) {
                $destinationPath = 'public/images/categories'; // upload path
                $image_name = Input::file('image')->getClientOriginalName();
                $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                $image_saved_name = intval(microtime(true)) . '.' . $extension; // renameing image

                Input::file('image')->move($destinationPath, $image_saved_name); // uploading file to given path

                $category->image_name = $image_name;
                $category->image_saved_name = $image_saved_name;
            }

            $name = Input::get('name');
            $url_key = Input::get('url_key');
            $description = Input::get('description');

            $category->name = $name;
            $category->url_key = $url_key;
            $category->description = $description;

            $category->updated_at = date("Y-m-d h:i:s");

            $category->save();

            return "done:" . $image_saved_name;
        }
    }

    public function disableCategory(){
        $id = Input::get('id');

        $category = Category::find($id);

        if(is_null($category))
            return "invalid";
        else{
            $category->status = "disabled";

            $category->updated_at = date("Y-m-d h:i:s");

            $category->save();

            return "done";
        }
    }

    public function removeCategory(){
        $id = Input::get('id');

        $category = Category::find($id);

        if(is_null($category))
            return "invalid";
        else{
            $category->status = "removed";
            $category->updated_type = "Category removed";

            $category->updated_at = date("Y-m-d h:i:s");

            $category->save();

            return "removed";
        }
    }

    public function loadCategories(){

        $parent_id = Input::get('parent_id');
        $page = Input::get('page');
        $records_to_pick = Input::get('count');

        if(!isset($records))
            $records = 20;

        $skip_records = ($page-1)*$records;

        if(strlen($parent_id)==0){
            $categories = Category::where('parent_id', '=', -1)->where('status', '=', 'active')->take($records_to_pick)->skip($skip_records)->get();

            return $categories;
        }
        else if(isset($parent_id)){
            $categories = Category::where('parent_id', '=', $parent_id)->where('status', '=', 'active')->take($records_to_pick)->skip($skip_records)->get();

            return $categories;
        }
    }

    public function updateCategoryGridOrder(){

        $category_sort_data = Input::get('category_sort_data');

        $ar_category_sort_data = explode(',', $category_sort_data);

        foreach($ar_category_sort_data as $data){
            $ar_data = explode(':', $data);

            $id = $ar_data[0];
            $sort_order = $ar_data[1];

            $category = Category::find($id);
            if($category){
                $category->sort_order = $sort_order;
                $category->updated_at = date("Y-m-d h:i:s");
                $category->update_type = "Sort order updated";

                $category->save();
            }
        }

        echo "updated";
    }

    public function updateProductGridOrder(){

        $product_sort_data = Input::get('product_sort_data');

        $ar_product_sort_data = explode(',', $product_sort_data);

        foreach($ar_product_sort_data as $data){
            $ar_data = explode(':', $data);

            $id = $ar_data[0];
            $sort_order = $ar_data[1];

            $product = Product::find($id);
            if($product){
                $product->sort_order = $sort_order;
                $product->updated_at = date("Y-m-d h:i:s");
                $product->update_type = "Sort order updated";

                $product->save();
            }
        }

        echo "updated";
    }

    public function updateProductsInCategory(){

        $product_ids = Input::get('product_ids');
        $category_id = Input::get('category_id');

        if(isset($category_id)){

            if(isset($product_ids)){

                $ar_product_ids = explode(',', $product_ids);

                foreach($ar_product_ids as $data){
                    $ar_data = explode(':', $data);

                    $id = $ar_data[0];
                    $status = $ar_data[1];

                    $product = Product::find($id);

                    if($product){
                        $categoryProduct = CategoryProduct::where('category_id', '=', $category_id)->where('product_id', '=', $product->id)->first();
                        if($categoryProduct){

                            if($status==='remove')
                                $categoryProduct->delete();
                            else{
                                // we can't be here with value 'add'
                            }
                        }
                        else if($status==='add'){
                            $categoryProduct = new CategoryProduct();

                            $categoryProduct->product_id = $product->id;
                            $categoryProduct->category_id = $category_id;
                            $categoryProduct->updated_at = date("Y-m-d h:i:s");
                            $categoryProduct->update_type = "Product added in category";

                            $categoryProduct->save();
                        }
                    }
                    else{
                        echo "Invalid product";
                        break;
                    }
                }

                echo "updated";
            }
            else
                echo "No products passed";
        }
        else
            echo "Category not selected";
    }

    public function categoryProducts(){
        return View::make('admin.category.products');
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
}