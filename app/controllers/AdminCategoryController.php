<?php

class AdminCategoryController extends BaseController {

    public function addCategory(){
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

    public function listCategories($id='', $page=1, $records=20){

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

    public function listCategoriesProducts($id, $page=1, $records=20){

        $skip_records = ($page-1)*20;

        if(isset($id) && is_int($id)){
            $products = Product::where('category_id', '=', $id)->where('status', '=', 'active')->take($records)->skip($skip_records)->get();

            return $products;
        }
        else
            return NULL;
    }
}