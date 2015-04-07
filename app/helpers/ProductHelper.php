<?php
class ProductHelper{

    public function getProduct($id){
        return Product::find($id);
    }

    public function getProductByUrl($url_key){
        return Product::where('url_key', '=', $url_key)->first();
    }
}
?>