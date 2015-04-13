<?php

class CartController extends BaseController
{

    public function addToCart()
    {

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

        $count = $cartHelper->insertInCart($newRow);

        if ($count > 0)
            echo json_encode(array('message' => 'added', 'count' => $count));
        else
            echo json_encode(array('message' => 'error', 'count' => 0));
    }

    public function applyPromoCode()
    {

        $cartHelper = new CartHelper();

        $cart_amount = $cartHelper->getCartTotal();

        $promo_code_used = Input::get('promo_code_used');
        $promoCode = PromoCode::where('code_value', '=', $promo_code_used)->first();
        if (isset($promoCode)) {
            $minimum_amount = $promoCode->minimum_amount;
            $start_date = $promoCode->start_date;
            $end_date = $promoCode->end_date;

            $start_date_value = date('Y-m-d', strtotime($start_date));
            $end_date_value = date('Y-m-d', strtotime($end_date));

            $date = date('Y-m-d');

            $isPromoDateValid = $date >= $start_date_value && $date <= $end_date_value;

            if ($cart_amount >= $minimum_amount && $isPromoDateValid) {

                $newRow = array(
                    'promo_code' => $promo_code_used
                );

                $cartHelper = new CartHelper();

                $count = $cartHelper->insertInCart($newRow);

                if ($count > 0)
                    echo json_encode(array('message' => 'added'));
                else
                    echo json_encode(array('message' => 'error'));
            } else if (!$isPromoDateValid)
                echo json_encode(array('message' => 'expired'));
            else if ($cart_amount < $minimum_amount)
                echo json_encode(array('message' => 'insufficient amount'));
        } else {
            echo json_encode(array('message' => 'invalid'));
        }
    }

    public function applyRewardPoints()
    {
        $customer_id = Session::get('customer_id');

        if (isset($customer_id)) {
            $cartHelper = new CartHelper();
            $customerHelper = new CustomerHelper();

            $cart_amount = $cartHelper->getCartTotal();

            $oneRewardPointCost = 0;
            $rewardPoint = RewardPoint::first();
            if (isset($rewardPoint))
                $oneRewardPointCost = $rewardPoint->point_value;


            $reward_points = Input::get('reward_points');

            if ($oneRewardPointCost > 0) {

                $current_reward_points = $customerHelper->getRewardPoints($customer_id);

                if ($current_reward_points <= $reward_points) {

                    $newRow = array(
                        'reward_points' => $reward_points
                    );

                    $cartHelper = new CartHelper();

                    $count = $cartHelper->insertInCart($newRow);

                    if ($count > 0)
                        echo json_encode(array('message' => 'added'));
                    else
                        echo json_encode(array('message' => 'error'));
                }
                else
                    echo json_encode(array('message' => 'insufficient'));
            }
            else {
                echo json_encode(array('message' => 'reward points value not set'));
            }
        }
        else
            echo json_encode(array('message' => 'invalid customer'));           // logically should never be executed
    }

    public function removeFromCart($rowId)
    {

        $cart = CartHelper::getCart();

        if ($cart != null) {

            $newCart = array();
            $found = false;

            foreach ($cart as $item) {

                if ($item['rowId'] === $rowId)
                    $found = true;
                else
                    $newCart[] = $item;
            }

            if ($found) {

                $cartHelper = new CartHelper();

                $cartHelper->saveCart($newCart);

                echo 'removed';
            } else
                echo 'not found';
        } else
            echo 'invalid';
    }

    public function getCart()
    {

        $cartHelper = new CartHelper();

        $cart = $cartHelper->getCart();

        if ($cart != null)
            echo json_encode(array('count' => count($cart), 'rows' => $cart));
        else
            echo json_encode(array('count' => 0));
    }

    public function getCartCount()
    {

        $cartHelper = new CartHelper();

        return $cartHelper->getCartCount();
    }
}