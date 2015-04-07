<?php

class ProductController extends BaseController {

    public function product(){
        $id = Input::get('id');

        echo "id = " . $id;
    }

    public function getProductsFromCategory(){

    }
}