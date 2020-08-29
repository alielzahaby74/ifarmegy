<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartManager extends Controller
{
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
            return $curArr[0]+['isNew'=>$isNew];
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
}
