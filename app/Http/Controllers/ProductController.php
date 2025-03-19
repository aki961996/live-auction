<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(5);
        return view("product.index", compact('products'));
    }
    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',

            'quantity' => 'required',

            'image' => 'required'
        ]);

        $product = Product::create([
            'title' => $request->title,

            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'user_id' => Auth::id(),

        ]);

        if ($request->hasFile('image')) {
            $extension = request('image')->extension();
            $fileName = 'img' . time() . '.' . $extension;
            request('image')->storeAs('product', $fileName);
            $product->image = $fileName;
        }

        $product->save();
        Alert::success('message', 'Product Addedd Successfully');
        return redirect()->route('product.dashboard');
    }

    public function show(Request $request, $id)
    {
        try {
            $decryptedId = decrypt($id);
            // $product_data = Product::findOrFail($decryptedId);
            $product_data = Product::with('user')->findOrFail($decryptedId);

            if (!$product_data) {
                return abort(404, "Product not found.");
            }

            return view('product.show', compact('product_data'));
        } catch (\Exception $e) {
            return abort(400, "Error: " . $e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $decryptedId = decrypt($id);
            $product_data = Product::findOrFail($decryptedId);

            if (!$product_data) {
                return abort(404, "User not found ");
            }

            return view('product.edit', compact('product_data'));
        } catch (\Exception $e) {
            return abort(400, "Error: " . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $decryptedId = decrypt($id);
        $product = Product::find($decryptedId);


        $product->title = $request->title;
        $product->description = $request->description;

        $product->price = $request->price;
        $product->quantity = $request->quantity;


        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Delete old image
            Storage::delete('private/product/' . $product->image);
            $extension = request('image')->extension();
            $fileName = 'img' . time() . '.' . $extension;
            request('image')->storeAs('product', $fileName);
            $product->image = $fileName;
        }
        $product->save();
        Alert::success('message', 'Product Addedd Successfully');
        return redirect()->route('product.dashboard');
    }

    public function destroy($id)
    {
        try {
            $decryptedId = decrypt($id);
    
            $product = Product::findOrFail($decryptedId);
            $product->delete(); 
    
            Alert::success('Success', 'Product deleted successfully');
            return redirect()->route('product.dashboard');
        } catch (\Exception $e) {
            return redirect()->route('product.dashboard')->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }
    
}
