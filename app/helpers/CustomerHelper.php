<?php
class CustomerHelper
{

    public function getRewardPoints($customer_id)
    {
        $rewardPoint = RewardPoint::where('customer_id', '=', $customer_id)->first();

        if ($rewardPoint) {

            echo json_encode($rewardPoint);
        }
        else
            echo -1;
    }
}
?>