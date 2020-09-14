<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $view = "cats.";

    public function index()
    {
        $items = Category::all();
        return view($this->view.'all',compact('items'));
    }

    public function add()
    {
        return view($this->view.'add');
    }

    public function create(Request $request)
    {
        $request->validate([
            "item_name"=>"required",
        ]);

        Category::create([
            "name"=>$request->item_name
        ]);

        return redirect()->route('category.all')
            ->with(['status'=>true,"type"=>"success","msg"=>"Success Adding To DB","msg2"=>""]);

    }

    public function linkedItems($id)
    {
        $cat = Category::findOrFail($id);
        return view($this->view."linked",compact('cat'));
    }

    public function delete ($id)
    {
        /*Category::destroy($id);
        return redirect()->route('product.all')
        ->with(['status'=>true, "type"=>"success", "msg"=>"Success Deleting The category", "msg2"=>""]);*/
    }
}
