<?php

class AuthenticationController extends BaseController {

    public function isValidCustomer(){
        $email = Input::get('email');
        $password = Input::get('password');

        $customer = Customer::where('email', '=', $email)
            ->where('password','=',$password)->first();

        if(is_null($customer))
            return "invalid";
        else{
            Session::put('customer', $customer->id);

            return "correct";
        }
    }

    public function isDuplicateCustomer($email)
    {
        $user = Customer::where('email', '=', $email)->first();

        return is_null($user) ? "no" : "yes";
    }

    public function isValidAdmin(){
        $username = Input::get('username');
        $password = Input::get('password');

        $admin = Admin::where('username', '=', $username)
            ->where('password','=',$password)->first();

        if(is_null($admin))
            return "invalid";
        else{
            Session::put('admin_id', $admin->id);

            return "correct";
        }
    }

    public function logout(){

        Session::flush();

        Auth::logout();

        return Redirect::to('index');
    }

    public function logoutAdmin(){

        Session::flush();

        Auth::logout();

        return Redirect::to('admin');
    }
}