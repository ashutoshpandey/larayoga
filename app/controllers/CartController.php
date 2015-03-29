<?php

class CartController extends BaseController {

    public function addToCart(){

        $product_id = Input::get('product_id');
        $price = Input::get('price');
        $quantity = Input::get('quantity');
        $options = Input::get('options');

        $rowId = $this->generateRowId($product_id, $options);

        $newRow = array(
            'rowId' => $rowId,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $price,
            'options' => $options
        );

        $cartHelper = new CartHelper();

        $cartHelper->insertInCart($newRow);
    }

    public function removeFromCart($rowId){

        $cart = CartHelper::getCart();

        if($cart!=null){

            $newCart = array();
            $found = false;

            foreach($cart as $item){

                if($item['rowId']===$rowId)
                    $found = true;
                else
                    $newCart[] = $item;
            }

            if($found){

                $cartHelper = new CartHelper();

                $cartHelper->saveCart($newCart);

                echo 'removed';
            }
            else
                echo 'not found';
        }
        else
            echo 'invalid';
    }

    public function getCartCount(){

        $cartHelper = new CartHelper();

        return $cartHelper->getCartCount();
    }
}