<?php

class OrderController extends BaseController {

    public function createOrder(){

        $cartHelper = new CartHelper();

        $cart = $cartHelper->getCart();

        if($cart!=null){

            $amount = 0;

            $oneRewardPointCost = 0;
            $rewardPoint = RewardPoint::first();
            if(isset($rewardPoint))
                $oneRewardPointCost = $rewardPoint->point_value;

            $rewardPointsUsed = Input::get('reward_points');

            if(isset($rewardPointsUsed)){
                $rewardPointDeduction = $rewardPointsUsed * $oneRewardPointCost;
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
            }
            else{
                $promo_code_used = '';
                $promo_discount_deduction = 0;
            }

            $order = new Order();

            $order->customer_id = Session::get('customer');

            $order->amount = $amount;

            $order->reward_points_used = $rewardPointsUsed;
            $order->reward_point_deduction = $rewardPointDeduction;

            $order->promo_code = $promo_code_used;
            $order->promo_discount_deduction = $promo_discount_deduction;

            $order->create_at = date('Y-m-d h:i:s');
            $order->updated_at = date('Y-m-d h:i:s');

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