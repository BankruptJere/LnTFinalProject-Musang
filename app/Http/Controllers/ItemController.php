<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        // if (Auth::user()->role == 'Member') {
        //     $blogs = Blog::where('user_id', Auth::user()->id)->get();
        // } else {
        //     $blogs = Blog::all();
        // }
        $items = Item::all();
        $categories = Category::all();
        return view('items.index', [
            'items' => $items,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'thumbnail' => 'required',
            'item_name' => 'required|min:5|max:80',
            'item_price' => 'required',
            'item_amount' => 'required',
            'category' => 'required',
        ]);

        // File Processing
        $files = $request->file('thumbnail');
        $fullFileName = $files->getClientOriginalName();
        $fileName = pathinfo($fullFileName)['filename'];
        $extension = $files->getClientOriginalExtension();
        $thumbnail = $fileName . '-' . date('YmdHis') . '-' . Str::random(10) . '.' . $extension;
        $files->storeAs('public/items/', $thumbnail);

        // Create Item
        Item::create([
            'thumbnail' => $thumbnail,
            'item_name' => $request->item_name,
            'item_price' => $request->item_price,
            'item_amount' => $request->item_amount,  
            'category_id' => $request->category,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/item')->with('success_msg', 'Item berhasil ditambah');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('items.edit', [
            'item' => $item,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Jika tidak ada gambar
        if ($request->file('thumbnail') == null) {
            $request->validate([
                'item_name' => 'required|min:5|max:80',
                'item_price' => 'required',
                'item_amount' => 'required',
                'category' => 'required',
            ]);

            // Update Item
            $item = Item::findOrFail($id);
            $item->update([
                'item_name' => $request->item_name,
                'item_price' => $request->item_price,
                'item_amount' => $request->item_amount,  
                'category_id' => $request->category,
            ]);

            return redirect('/item')->with('success_msg', 'Item berhasil diubah');
        } else {
            // Validasi
            $request->validate([
                'thumbnail' => 'required',
                'item_name' => 'required|min:5|max:80',
                'item_price' => 'required',
                'item_amount' => 'required',
                'category' => 'required',
            ]);

            // File Processing
            $files = $request->file('thumbnail');
            $fullFileName = $files->getClientOriginalName();
            $fileName = pathinfo($fullFileName)['filename'];
            $extension = $files->getClientOriginalExtension();
            $thumbnail = $fileName . '-' . date('YmdHis') . '-' . Str::random(10) . '.' . $extension;
            $files->storeAs('public/items/', $thumbnail);

            // Update Item
            $item = Item::findOrFail($id);
            if (Storage::exists('public/items/' . $item->thumbnail)) {
                Storage::delete('public/items/' . $item->thumbnail);
            }

            $item->update([
                'thumbnail' => $thumbnail,
                'item_name' => $request->item_name,
                'item_price' => $request->item_price,
                'item_amount' => $request->item_amount,  
                'category_id' => $request->category,
            ]);

            return redirect('/item')->with('success_msg', 'Item berhasil diubah');
        }
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        if (Storage::exists('public/items/' . $item->thumbnail)) {
            Storage::delete('public/items/' . $item->thumbnail);
        }
        $item->delete();

        return redirect('/item')->with('success_msg', 'Item berhasil dihapus');
    }
}
