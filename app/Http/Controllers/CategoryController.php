<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function editPage($id)
    {
        $cat = Category::findOrFail($id);
        return view($this->view . 'editPage', ['cat' => $cat]);
    }

    public function create(Request $request)
    {
        $request->validate([
            "item_name"=>"required",
            "item_photo"=>"required",
        ]);
        
        $file  = Storage::disk('public')->putFileAs("product/", $request->file('item_photo'), time().".".$request->file('item_photo')->getClientOriginalName());
        $url = "storage/$file";

        Category::create([
            "name"=>$request->item_name,
            "photo" => $url,
        ]);

        return redirect()->route('category.all')
            ->with(['status'=>true,"type"=>"success","msg"=>"Success Adding To DB","msg2"=>""]);

    }

    public function linkedItems($id)
    {
        $cat = Category::findOrFail($id);
        return view($this->view."linked",compact('cat'));
    }

    public function edit($id, Request $request)
    {
        $cat = Category::findOrFail($id);

        if($request->has('item_name'))
        {
            $cat->name = $request->item_name;
        }
        if($request->has('item_photo'))
        {
            $file  = Storage::disk('public')->putFileAs("product/", $request->file('item_photo'), time().".".$request->file('item_photo')->getClientOriginalName());
            $url = "storage/$file";
            $cat->photo = $url;
        }
        $cat->save();
        return redirect()->route('category.all')
        ->with(['status'=>true,"type"=>"success","msg"=>"Success Editing item","msg2"=>""]);
    }
    public function delete ($id)
    {
        Category::destroy($id);
        return redirect()->route('category.all')
        ->with(['status'=>true, "type"=>"success", "msg"=>"Success Deleting The category", "msg2"=>""]);
    }
}
