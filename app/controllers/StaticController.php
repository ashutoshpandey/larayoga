<?php

class StaticController extends BaseController
{

    public function index($url_key)
    {
        $productHelper = new ProductHelper();

        $product = $productHelper->getProductByUrl($url_key);
        if ($product){
            return View::make('data.product')->with('product', $product);
        }
        else {
            $categoryHelper = new CategoryHelper();

            $category = $categoryHelper->getCategoryByUrl($url_key);

            if ($category){
                return View::make('data.category')->with('category', $category);
            }
            else
                return View::make('static.page_not_found');
        }
    }
}