<?php
class CategoryHelper{

    var $categoryHtml;

    public function getCategory($id){
        return Category::find($id);
    }

    public function getCategoryByUrl($url_key){
        return Category::where('url_key', '=', $url_key)->first();
    }

    public function getAllCategories(){
        return Category::where('status', '=', 'active')->get();
    }

    public function getCategoryTree(){
        $categories = $this->getAllCategories();

        if($categories){
            $category_tree = $this->formatTree($categories, -1);
            return $this->makeTree($category_tree);
        }
    }

/****************** category tree generation code *******************/
    function formatTree($tree, $parent){
        $tree2 = array();
        foreach($tree as $item){
            if($item->parent_id == $parent){
                $tree2[] = array('id' => $item->id, 'name' => $item->name, 'childs' => $this->formatTree($tree, $item->id));
            }
        }

        return $tree2;
    }

    function makeTreeItems($a) {
        $out = '';
        foreach($a as $item) {
            $out .= "<li rel='" . $item["id"] . "' name='" . $item["name"] . "'>";
            $out .= $item['name'];
            if(array_key_exists('childs', $item)) {
                $out .= $this->makeTree($item['childs']);
            }
            $out .= "</li>";
        }

        return $out;
    }

    function makeTree($tree_data) {
        $out = "<ul>";
        $out .= $this->makeTreeItems($tree_data);
        $out .= "</ul>";

        return $out;
    }
    /****************** category tree generation code *******************/
}
?>