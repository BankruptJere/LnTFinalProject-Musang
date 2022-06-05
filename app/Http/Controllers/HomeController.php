<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {       
        $categories = Category::all();
        $items = Item::all();
            return view('home', [
                'item' => $items,
                'items' => $items,
                'categories'=> $categories
            ]);
    }

    public function admin()
    {
        return view('admin');
    }

    public function member()
    {
        return view('member');
    }
}
