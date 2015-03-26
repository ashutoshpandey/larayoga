<?php

class OrderController extends BaseController {

    public function createOrder(){

        Order::saveFormData(Input::except(array('_token')));

        return 'created';
    }

    public function findOrder($id){

        $id = Input::get('id');

        if ($id) {

            $order = Order::find($id);

            if ($order)
                return $order;
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