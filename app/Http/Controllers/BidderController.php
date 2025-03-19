<?php

namespace App\Http\Controllers;

use App\Models\Bidder;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BidderController extends Controller
{
    public function dashboard(){
        $products = Product::paginate(5);
         return view('dashboard', compact('products'));
    }
    public function placeBidder(Request $request, $productId)
    {
        $decryptedProductId = decrypt($productId);
       
        // Validate the bid amount
        $request->validate([
            'amount' => 'required|numeric|min:' . Product::findOrFail($decryptedProductId)->price,  
        ]);
    
        // Get the product using the ID
        $product = Product::findOrFail($productId);
        dd($product);
    
        // Save the bid (assuming you have a Bid model)
        $bid = new Bidder();
        $bid->product_id = $product->id;
        $bid->user_id = Auth::id();
        $bid->amount = $request->amount;
        $bid->save();
    
        // Optionally, trigger events or notify users (e.g., via broadcasting)
        
        return redirect()->route('product.placeBidder', encrypt($product->id))->with('success', 'Bid placed successfully');
    }
    
}
