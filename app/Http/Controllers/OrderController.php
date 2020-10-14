<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_item;

class OrderController extends Controller
{
    protected $view = "orders.";

    public function orders()
    {
        $orders = Order::all();

        return view($this->view . "orders", ['orders' => $orders]);
    }

    public function order($id)
    {
        $orders = Order::all();
        $order = Order_item::all()->where('order_id', $id);
        $total_cost = 0;
        foreach($order as $items)
        {
            $total_cost += $items->item_total;
        }
        return view($this->view . "order", ['order' => $order, 'total_cost' => $total_cost]);
    }

    public function completeOrder($id)
    {
        Order::destroy($id);
        return redirect()->route('orders.orders')
        ->with(['status'=>true,"type"=>"success","msg"=>"Order Completed!","msg2"=>""]);
    }
    public function delete($id)
    {
        Order::destroy($id);
        return redirect()->route('orders.orders')
        ->with(['status'=>true,"type"=>"success","msg"=>"Success Deleting The Order","msg2"=>""]);
    }
}
