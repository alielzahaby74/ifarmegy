<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    public function orders()
    {
        $orders = Order::all();
        return view($this->view . "orders", ['orders' => $orders]);
    }
}
