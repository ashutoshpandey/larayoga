<?php

class OrderController extends BaseController {

    public function createOrder(){

        $cartHelper = new CartHelper();

        $cart = $cartHelper->getCart();

        if($cart!=null){

            $amount = 0;
            foreach($cart as $item)
                $amount = $amount + $item['price'] * $item['quantity'];

            $net_amount = $amount;

            $oneRewardPointCost = 0;
            $rewardPoint = RewardPoint::first();
            if(isset($rewardPoint))
                $oneRewardPointCost = $rewardPoint->point_value;

            $rewardPointsUsed = Input::get('reward_points');

            if(isset($rewardPointsUsed)){
                $rewardPointDeduction = $rewardPointsUsed * $oneRewardPointCost;

                $net_amount = $amount - $rewardPointDeduction;
            }
            else{
                $rewardPointDeduction = 0;
                $rewardPointsUsed = 0;
            }

            $promo_code_used = Input::get('promo_code_used');
            $promoCode = PromoCode::where('code_name', '=', $promo_code_used)->first();
            if(isset($promoCode)){
                $promo_code_value = $promoCode->code_value;
                $minimum_amount = $promoCode->minimum_amount;
                $start_date = $promoCode->start_date;
                $end_date = $promoCode->end_date;

                $start_date_value = date('Y-m-d', strtotime($start_date));
                $end_date_value = date('Y-m-d', strtotime($end_date));

                $date = date('Y-m-d');

                $isPromoDateValid = $date >= $start_date_value && $date <= $end_date_value;

                if($net_amount >= $minimum_amount && $isPromoDateValid){
                    $promo_discount_deduction = $net_amount * $promo_code_value / 100;
                    $net_amount = $net_amount - $promo_discount_deduction;
                }
            }
            else{
                $promo_code_used = '';
                $promo_discount_deduction = 0;
            }

            $order = new Order();

            $order->customer_id = Session::get('customer');

            $order->amount = $amount;
            $order->net_amount = $net_amount;

            $order->reward_points_used = $rewardPointsUsed;
            $order->reward_point_deduction = $rewardPointDeduction;

            $order->promo_code = $promo_code_used;
            $order->promo_discount_deduction = $promo_discount_deduction;

            $order->create_at = date('Y-m-d h:i:s');
            $order->updated_at = date('Y-m-d h:i:s');

            echo json_encode(array('message' => 'created'));
        }
        else
            echo json_encode(array('message' => 'empty cart'));
    }

    public function findOrder($id){

        $id = Input::get('id');

        if ($id) {

            $order = Order::find($id);

            if ($order)
                echo json_encode($order);
            else
                return null;
        }
        else
            return null;
    }

    public function orderItems($id){

        $order_items = Order::where('order_id', '=', $id)->get();

        return $order_items;
    }

    public function updateOrder(){

        $id = Input::get('id');
        $status = Input::get('status');

        if ($id) {

            $order = Order::find($id);

            if ($order) {

                $order->status = $status;
                $order->updated_at = date('Y-m-d h:i:s');

                $order->save();

                echo 'updated';
            }
            else
                echo "not found";
        }
        else
            echo "invalid";

    }
}