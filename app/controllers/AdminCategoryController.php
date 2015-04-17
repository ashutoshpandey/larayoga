<?php

class AdminCategoryController extends BaseController {

    public function createCategory(){

        return View::make('admin.category.createcategory');
    }

    public function getCategoryTree(){

        $categoryHelper = new CategoryHelper();

        $category_tree = $categoryHelper->getCategoryTree();

        return View::make('admin.category.tree')->with('category_tree', $category_tree);
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
}