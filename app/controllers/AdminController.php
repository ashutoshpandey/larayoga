<?php

class AdminController extends BaseController
{
    public function adminSection()
    {
        return View::make('admin.admin-section');
    }

    public function logout(){
        Session::flush();

        return Redirect::to('/');
    }
}