<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
            return $curArr[0] + ['isNew' => $isNew];
            //return $curArr[0]+['isNew'=>$isNew];
        else:
            $cart_item_obj = [
                "id" => $item->id,
                "name"=>$item->name,
                "item_price"=>$item->price,
                "qty"=> (int) $request->qty,
                "photo"=>asset($item->photo),
                "total"=>$item->price*$request->qty
            ];
            session()->push('cart',$cart_item_obj);
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
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        if(session()->has('cart'))
        {
            $request->session()->forget('cart');
        }
        return redirect()->back();
    }

    public function sendMail(Request $request)
    {
        $user = auth()->user();

        $user->num_of_buys++;
        $user->save();
        
        $details = [
            'title' => 'New Order',
            'body' => 'test',
            'user' => $user,
            'cart' => session()->get('cart'),
        ];
        \Mail::to('hesham11592@gmail.com')->send(new \App\Mail\ifruitMail($details));
        $request->session()->forget('cart');
        return redirect()->route('product.all')
        ->with(['status'=>true,"type"=>"success","msg"=>"your order has been sent!","msg2"=>"", 'user' => $user]);
    }
}
