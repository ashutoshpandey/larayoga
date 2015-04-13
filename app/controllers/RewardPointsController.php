<?php

class RewardPointsController extends BaseController {

    public function addOrderRewardPoint()
    {
        $order_id = Input::get('id');

        if (isset($order_id) && is_int($order_id)) {

            $rewardPointSetting = RewardPointSetting::first();

            if($rewardPointSetting){

                $rewardPoints = $rewardPointSetting->order_points;

                $orderPoint = new OrderPoint();

                $orderPoint->order_id = $order_id;
                $orderPoint->rewardPoints = $rewardPoints;

                $orderPoint->save();

                echo "done";
            }
            else
                echo "settings missing";
        }
        else
            echo "invalid product";
    }

    public function addReferrerRewardPoint()
    {
        $referrer_id = Input::get('referrer_id');
        $referred_id = Input::get('referred_id');

        if (isset($product_id) && is_int($product_id)) {

            $rewardPointSetting = RewardPointSetting::first();

            if($rewardPointSetting){

                $rewardPoints = $rewardPointSetting->referrer_points;

                $referrerRegistration = new ReferrerRegistration();

                $referrerRegistration->referrer_id = $referrer_id;
                $referrerRegistration->referrered_id = $referred_id;
                $referrerRegistration->rewardPoints = $rewardPoints;

                $referrerRegistration->save();

                echo "done";
            }
            else
                echo "settings missing";
        }
        else
            echo "invalid product";
    }

    public function getRewardPoints($customer_id)
    {
        if (isset($customer_id)) {

            $customer = Customer::where('customer_id', '=', $customer_id)->first();

            if ($customer) {

                $current_reward_points = $customer->reward_points;

                $reward_points_earned = $this->getRewardPointsEarned($customer_id);
                $reward_points_spent = $this->getRewardPointsSpent($customer_id);

                if($current_reward_points != $reward_points_earned - $reward_points_spent || $reward_points_spent > $reward_points_earned){
                    return -1; //error, reward points calculation mismatch
                }
                else
                    echo $current_reward_points;
            }
            else
                echo -1;
        }
        else
            echo -1;
    }

    public function getRewardPointsEarned($customer_id)
    {
        if ($customer_id) {

            $rewardPoints = RewardPointEarned::where('customer_id', '=', $customer_id)->get();

            if ($rewardPoints) {

                $total = 0;
                foreach($rewardPoints as $rewardPoint)
                    $total += $rewardPoint->points;
            }
            else
                return 0;
        }
        else
            return -1;
    }

    public function getRewardPointsSpent($customer_id)
    {
        if ($customer_id) {

            $rewardPoints = RewardPointSpent::where('customer_id', '=', $customer_id)->get();

            if ($rewardPoints) {

                $total = 0;
                foreach($rewardPoints as $rewardPoint)
                    $total += $rewardPoint->points;
            }
            else
                return 0;
        }
        else
            return -1;
    }

    public function listRewardPoints($id, $page=1, $records=20)
    {
        if ($id && is_int($id)) {

            $skip_records = ($page-1)*20;

            $rewardPoints = RewardPoint::all()->take($records)->skip($skip_records);

            if ($rewardPoints) {

                echo json_encode($rewardPoints);
            }
            else
                echo -1;
        }
        else
            echo -1;
    }
}