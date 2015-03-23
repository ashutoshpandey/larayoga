<?php

class StaticController extends BaseController {

	public function index()
	{
		return View::make('index');
	}

    public function men()
    {
        return View::make('men');
    }

    public function women()
    {
        return View::make('women');
    }

}