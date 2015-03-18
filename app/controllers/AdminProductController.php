<?php

class AdminProductController extends BaseController
{

    public function createProduct()
    {
        $id = Product::saveFormData(Input::except(array('_token')));

        if (Input::get('picture_count')) {

            $count = Input::get('picture_count');

            if ($count > 0) {

                for ($i = 1; $i <= $count; $i++) {
                    if (Input::hasFile('file' . $i) && Input::file('file' . $i)->isValid()) {
                        $pic = Input::file('file' . $i)->getClientOriginalName();
                        $destinationPath = public_path() . "/products/";

                        $saved_file = date('Ymdhis') . "_" . $pic;

                        Input::file('file' . $i)->move($destinationPath, $saved_file);

                        $productPic = ProductPicture();

                        $productPic->product_id = $id;
                        $productPic->filename = $pic;
                        $productPic->saved_filename = $saved_file;
                        $productPic->data = Input::get('data' . $i);

                        $productPic->save();
                    }
                }
            }
        }
    }

    public function updateProduct()
    {
        $id = Input::get('id');

        if ($id && is_int($id)) {

            $product = Product::find($id);

            if ($product) {

                Product::updateFormData(Input::except(array('id')));

                echo "updated";
            }
            else
                echo "not found";
        }
        else
            echo "invalid";
    }

    public function removeProduct()
    {
        $id = Input::get('id');

        if ($id && is_int($id)) {

            $product = Product::find($id);

            if ($product) {

                $product->status = "removed";
                $product->save();

                $productPics = ProductPicture::where('product_id', '=', $id)->get();

                if($productPics){

                    foreach($productPics as $productPic){

                        $productPic->status = 'removed';

                        $productPic->save();
                    }
                }

                echo "removed";
            }
            else
                echo "not found";
        }
        else
            echo "invalid";
    }

    public function findProduct($id){

        $product = Product::find($id);

        return $product;
    }
}