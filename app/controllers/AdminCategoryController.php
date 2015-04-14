<?php

class AdminCategoryController extends BaseController {

    public function createCategory(){

        $categoryHelper = new CategoryHelper();

        $category_tree = $categoryHelper->getCategoryTree();

        return View::make('admin.category.createcategory')->with('category_tree', $category_tree);
    }

    public function manageCategories(){
        return View::make('admin.category.managecategories');
    }

    public function categoryProducts(){
        return View::make('admin.category.categoryproducts');
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
            if (Input::file('image')->isValid()) {
                $destinationPath = 'public/images/categories'; // upload path
                $image_name = Input::file('image')->getClientOriginalName();
                $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                $image_saved_name = microtime(true) . $extension; // renameing image

                Input::file('image')->move($destinationPath, $image_saved_name); // uploading file to given path

                $category = new Category;

                $category->name = $name;
                $category->url_key = $url_key;
                $category->description = $description;
                $category->parent_id = $parent_id;
                $category->image_name = $image_name;
                $category->image_saved_name = $image_saved_name;

                $category->status = "active";
                $category->created_at = date("Y-m-d h:i:s");
                $category->updated_at = date("Y-m-d h:i:s");

                $category->save();

                echo "done";
            }
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

    public function updateCategory(){
        $id = Input::get('id');

        $category = Category::find($id);

        if(is_null($category))
            return "invalid";
        else{
            $name = Input::get('name');
            $url_key = Input::get('url_key');
            $description = Input::get('description');

            $category->name = $name;
            $category->url_key = $url_key;
            $category->description = $description;

            $category->updated_at = date("Y-m-d h:i:s");

            $category->save();

            return "done";
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

            $category->updated_at = date("Y-m-d h:i:s");

            $category->save();

            return "done";
        }
    }

    public function loadCategories($id='', $page=1, $records=20){

        $skip_records = ($page-1)*20;

        if(strlen($id)==0){
            $categories = Category::where('parent_id', '=', -1)->where('status', '=', 'active')->take($records)->skip($skip_records)->get();

            return $categories;
        }
        else if(isset($id) && is_int($id)){
            $categories = Category::where('parent_id', '=', $id)->where('status', '=', 'active')->take($records)->skip($skip_records)->get();

            return $categories;
        }
    }
}