<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Order;
use App\Order_item;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use App\User;

class CartManager extends Controller
{
    protected $view = "cart.";

    public function all()
    {
        return view($this->view .'all');
    }
    public function add(Request $request)
    {
        $request->validate([
            "item_id"=>"required",
            "qty"=>"required",
        ]);
        $isNew = false;
        if (session()->has('cart')):
        $curArr = array_filter(session('cart'),function ($i) use ($request) {
            return $i['id'] == $request->item_id;
        });
        $isNew = count($curArr);
        endif;
        $item = Product::find($request->item_id);
        if ($isNew>0):
            $cart = array_map(function ($i) use($request,$item) {
                if ($i['id']==$request->item_id){
                    $i['qty'] = $i['qty']+$request->qty;
                    $i['total'] = $item->price*$i['qty'];
                }
                return $i;
            },session('cart'));
            session()->put("cart",$cart);
            $curArr = array_filter(session('cart'),function ($i) use ($request) {
                return $i['id'] == $request->item_id;
            });
            $curArr = reset($curArr);
            //dump($curArr);
            return $curArr + ['isNew' => $isNew];
            //return $curArr[0]+['isNew'=>$isNew];
        else:
            $cart_item_obj = [
                "id" => $item->id,
                "name"=>$item->name,
                "item_price"=>$item->price,
                "qty"=> (float) $request->qty,
                "photo"=>asset($item->photo),
                "total"=>$item->price*$request->qty
            ];
            session()->push('cart', $cart_item_obj);
            return $cart_item_obj+['isNew'=>0];
        endif;
    }
    public function remove(Request $request, $id)
    {

        $Cart = null;
        if(session()->has('cart'))
        {
            $cart = array_filter(session('cart'), function ($i) use ($id){
                return $i['id'] != $id;
            });
        }
        if(count($cart) > 0)
            session()->put('cart', $cart);
        else
            $request->session()->forget('cart');
        //return redirect()->back();
    }

    public function delete(Request $request)
    {
        if(session()->has('cart'))
        {
            $request->session()->forget('cart');
        }
        return redirect()->back();
    }

    public function sendOrder(Request $request)
    {
        $user = auth()->user();
        /*
        $user->num_of_buys++;
        $user->save();
        */ 
        $order = Order::create([
            'title' => 'New Order',
            'description' => '',
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_address' => $user->address,
            'phone_number' => $user->phone_number
        ]);
        foreach(session('cart') as $item)
        {
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
        $request->session()->forget('cart');
        return redirect()->route('dash')
        ->with(['status'=>true,"type"=>"success","msg"=>"your order has been sent!","msg2"=>"", 'user' => $user]);
    }
}
