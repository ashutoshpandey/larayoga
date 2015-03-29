<?php
class CustomerController{

    public function createCustomer(){
        $validator = Validator::make(Input::all(), Customer::$rules);

        if($validator->passes()){

        }
    }
}