<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function index()
    {
        // if (Auth::user()->role == 'Member') {
        //     $blogs = Blog::where('user_id', Auth::user()->id)->get();
        // } else {
        //     $blogs = Blog::all();
        // }
        $items = Item::all();
        $carts = Auth::user()->role == 'Member' ? Cart::where('user_id', Auth::user()->id)->get() : Cart::all();
        $categories = Category::all();
        return view('carts.index', [
            'carts' => $carts,
            'categories' => $categories,
            'items' => $items,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'alamat' => 'required|min:10|max:100',
            'kodepos' => 'required|min:5|max:5',
        ]);

        // File Processing

        // Create Item
        Cart::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,  
            'alamat' => $request->alamat,
            'kodepos' => $request->kodepos,  
            'category_id' => $request->category,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/cart')->with('success_msg', 'Cart berhasil ditambah');
    }

    public function edit($id)
    {
        $cart = Cart::findOrFail($id);
        $categories = Category::all();
        return view('carts.edit', [
            'item' => $item,
            'cart' => $cart,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
            $request->validate([
                'name' => 'required',
                'quantity' => 'required',
                'price' => 'required',
                'alamat' => 'required|min:10|max:100',
                'kodepos' => 'required|min:5|max:5',
            ]);

            // Update Item
            $cart = Cart::findOrFail($id);
            $cart->update([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price' => $request->price,  
                'alamat' => $request->alamat,
                'kodepos' => $request->kodepos,  
                'category_id' => $request->category,
            ]);

            return redirect('/cart')->with('success_msg', 'Item dalam cart berhasil diedit');
    }

    
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect('/cart')->with('success_msg', 'Item dikeluarkan dari cart');
    }
}
