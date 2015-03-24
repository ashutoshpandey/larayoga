<?php

class StaticController extends BaseController
{

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

    public function ourStory()
    {
        return View::make('ourstory');
    }

    public function fabricStory()
    {
        return View::make('fabricstory');
    }

    public function gift()
    {
        return View::make('gift');
    }

    public function smogiBucks()
    {
        return View::make('smogibucks');
    }

    public function trackOrder()
    {
        return View::make('trackorder');
    }

    public function namaskar()
    {
        return View::make('namaskar');
    }

    public function help()
    {
        return View::make('help');
    }

}