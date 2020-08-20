<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected  $view = "products.";

    public function all()
    {
        $items = Product::all();
//        dd(compact(['items','']));
        return view($this->view.'all',compact('items'));
//        return view($this->view.'all',["items"=>$items]);
    }

    public function addPage()
    {
        return view($this->view.'add');
    }

    public function create(Request $request)
    {
        // to check that the user has entered all the required inputs
        $request->validate([
            //"input_name"=>"rule"
            "item_name"=>"required",
            "item_price"=>"required",
        ]);

        // Storing into db
        Product::create([
            "name"=>$request->item_name,
            "price"=>$request->item_price
        ]);

        // done storing
        // redirecting to all items page with a SUCCESS MSG

        return redirect()->route('product.all')
            ->with(['status'=>true,"type"=>"success","msg"=>"Success Adding To DB","msg2"=>""]);

    }

}
