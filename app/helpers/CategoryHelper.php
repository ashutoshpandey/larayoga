<?php
class CategoryHelper{

    public function getCategory($id){
        return Category::find($id);
    }

    public function getCategoryByUrl($url_key){
        return Category::where('url_key', '=', $url_key)->first();
    }
}
?>