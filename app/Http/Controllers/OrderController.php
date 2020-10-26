<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_item;
use App\User;

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
        $order = Order::where('id', $id);
        $user = User::where('id', $order->user_id);
        $user->num_of_buys++;
        $user->total_cost_of_buy += $order->total_cost;
        $user->save();
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

    public function sendOrder(Request $request)
    {
        
        if(!session()->has('cart'))
            abort(403);
        $user = auth()->user();
        $total_cost = 0;
        $pay_method = "";
        if($request->payment_method == 'visa')
            $pay_method = "visa";
        else
            $pay_method = "cash";
        $order = Order::create([
            'title' => 'New Order',
            'description' => '',
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_address' => $user->address,
            'phone_number' => $user->phone_number,
            'payment_method' => $pay_method,
        ]);
        
        foreach(session('cart') as $item)
        {
            if(!$item['not_available'])
            {

                $total_cost += $item['total'];
                Order_item::create([
                'user_id' => $user->id,
                'order_id'=> $order->id,
                'item_id' => $item['id'],
                'qty' => $item['qty'],
                'item_name' => $item['name'],
                'item_price' => $item['item_price'],
                'item_total' => $item['total']
                ]);
            }
            else
            {
                $request->session()->forget('cart');
                Order::destroy($order->id);
                return redirect()->route('home');
            }
        }
        $order->total_cost = $total_cost;
        $order->save();
        $request->session()->forget('cart');
        return redirect()->route('home')
        ->with(['status'=>true,"type"=>"success","msg"=>"your order has been sent!","msg2"=>"", 'user' => $user]);
    }
}
