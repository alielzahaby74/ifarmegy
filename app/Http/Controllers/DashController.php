<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DashController extends Controller
{
    protected $view = "dash";

    public function index()
    {
        $cats = Category::all();
        return view($this->view)->with(['cats' => $cats]);
    }
}
