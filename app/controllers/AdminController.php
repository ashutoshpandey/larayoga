<?php

class AdminController extends BaseController
{
    public function index()
    {
        return View::make('admin.index');
/*
        $admin = Session::read('admin');

        if(isset($admin))
            return View::make('admin.index');
        else
            return redirect('/');*/
    }
}