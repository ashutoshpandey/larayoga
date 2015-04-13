<?php
    class CartHelper{

        public function insertInCart($row){

            $cart = $this->getCart();

            $cart[] = $row;

            $this->saveCart($cart);

            return $this->getCartCount();
        }

        public function saveCart($cart){

            Session::forget('cart');

            Session::put('cart', $cart);
        }

        public function getCartTotal(){

            $cart = $this->getCart();

            $amount = 0;
            foreach($cart as $item)
                $amount = $amount + $item['price'] * $item['quantity'];

            return $amount;
        }

        public function getCart(){

            $cart = Session::get('cart');

            return isset($cart) ? $cart : null;
        }

        public function getCartCount(){

            $cart = $this->getCart();

            if(isset($cart)){
                if(is_array($cart))
                    return count($cart);
                else
                    return -1;                  // cart should be an array
            }
            else
                return 0;
        }

        protected static function generateRowId($id, $options)
        {
            ksort($options);

            return md5($id . serialize($options));
        }
    }
?>