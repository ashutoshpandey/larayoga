<?php

class AuthenticationController extends BaseController {

    public function isValidUser(){
        $email = Input::get('email');
        $password = Input::get('password');

        $User = User::where('email', '=', $email)
            ->where('password','=',$password)->first();

        if(is_null($User))
            return "invalid";
        else{
            Session::put('User_id', $User->id);

            return "correct";
        }
    }

    public function isDuplicateUser($email)
    {
        $user = User::where('email', '=', $email)->first();

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