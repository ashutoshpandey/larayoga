<?php

class CategoryController extends BaseController {

    public function categories(){

    }

    public function category(){
        $id = Input::get('id');

        echo "id = " . $id;
    }
}