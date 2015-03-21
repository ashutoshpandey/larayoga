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

    public function getRewardPoints($id)
    {
        if ($id && is_int($id)) {

            $rewardPoint = RewardPoint::where('customer_id', '=', $id)->first();

            if ($rewardPoint) {

                echo json_encode($rewardPoint);
            }
            else
                echo -1;
        }
        else
            echo -1;
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