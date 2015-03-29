<?php
class ProductHelper{
    public function getProduct($id){
        return Product::find($id);
    }
}
?>