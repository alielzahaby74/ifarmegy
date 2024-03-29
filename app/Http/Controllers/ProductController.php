<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Order;
use App\Order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Melihovv\ShoppingCart\Facades\ShoppingCart as Cart;

class ProductController extends Controller
{
    protected  $view = "products.";

    public function home()
    {
        $categories = Category::all();
        $items = Product::limit(4)->inRandomOrder()->get();
        return view('home', ['categories' => $categories, 'items' => $items]);
    }

    public function all()
    {
        $items = Product::all();
        $categories = Category::all();
//        dd(compact(['items','']));
        return view($this->view.'all',['items' => $items, 'categories' => $categories]);
//        return view($this->view.'all',["items"=>$items]);
    }

    public function getCatList($id)
    {
        $items = Product::all();
        return view($this->view.'category', ['id' => $id, 'items' => $items]);
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
            "cat_id"=>"required",
            "item_unit"=>"required",
            "item_step"=>"required",
            "item_photo"=>"required|mimes:jpg,jpeg,png",
            
        ]);

        $file  = Storage::disk('public')->putFileAs("product/", $request->file('item_photo'), time().".".$request->file('item_photo')->getClientOriginalName());
        //$url = Storage::disk('public')->url($file);
        $url = "storage/$file";
        //dd($url, $file);
        // Storing into db
        $not_available = 0;
        if($request->has('not_available'))
        {
            $not_available = 1;
        }
        Product::create([
            "name"=>$request->item_name,
            "price"=>$request->item_price,
            "unit"=>$request->item_unit,
            "step"=>$request->item_step,
            "photo"=>$url,
            "category_id"=>$request->cat_id,
            "not_available" => $not_available,
        ]);

        // done storing
        // redirecting to all items page with a SUCCESS MSG

        return redirect()->route('dash')
            ->with(['status'=>true,"type"=>"success","msg"=>"Success Adding To DB","msg2"=>""]);

    }

    public function editPage(Request $request, $id)
    {
        $item = Product::findOrFail($id);
        return view($this->view . 'edit',compact('item'));
    }
    public function update(Request  $request,$id)
    {
        $request->validate([
            "item_name"=>"required",
            "item_price"=>"required",
            "cat_id"=>"required",
            
        ]);

        $product = Product::find($id);

        $product->name = $request->item_name;
        $product->price = $request->item_price;
        $product->category_id = $request->cat_id;

        $not_available = 0;
        if($request->has('not_available'))
        {
            $not_available = 1;
        }
        $product->not_available = $not_available;
        if($request->has('item_photo'))
        {
            $file  = Storage::disk('public')->putFileAs("product/", $request->file('item_photo'), time().".".$request->file('item_photo')->getClientOriginalName());
            $url = "storage/$file";
            $product->photo = $url;
        }
            $product->save();
        return redirect()->route('dash')
            ->with(['status'=>true,"type"=>"success","msg"=>"Success Editing the Item","msg2"=>""]);
    }

    public function delete($id)
    {
        Product::destroy($id);
        return redirect()->route('dash')
        ->with(['status'=>true,"type"=>"success","msg"=>"Success Deleting The Item","msg2"=>""]);
    }

    /*public function addQty(Request $request, $step)
    {
        $request->qty += $step;
        return redirect()->back();
    }*/
}
