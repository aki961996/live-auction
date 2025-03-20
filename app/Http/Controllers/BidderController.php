<?php

namespace App\Http\Controllers;

use App\Models\Bidder;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BidderController extends Controller
{
    public function dashboard()
    {
        $products = Product::paginate(5);
        return view('dashboard', compact('products'));
    }
    public function showBidderForm($productId)
    {
        $decryptedProductId = decrypt($productId);

        $product = Product::findOrFail($decryptedProductId);
        return view('bidder.place_bidder', compact('product'));
    }

    public function placeBidder(Request $request, $productId)
    {
        $decryptedProductId = decrypt($productId);
        $request->validate([
            'amount' => 'required|numeric|min:' . Product::findOrFail($decryptedProductId)->price,
        ]);
        // Get the product using the decrypted ID
        $product = Product::findOrFail($decryptedProductId);
        // Save the bid
        $bid = new Bidder();
        $bid->product_id = $product->id;
        $bid->user_id = Auth::id();
        $bid->amount = $request->amount;
        $bid->save();
        // Trigger an event to notify others (e.g., via Pusher)
        // broadcast(new BidPlaced($bid)); // Broadcasting the event

        Alert::success('message', 'Bid placed Successfully');
        return redirect()->route('product.placeBidder', encrypt($product->id));
        // return redirect()->route('product.placeBidder', encrypt($product->id))
        //     ->with('success', 'Bid placed successfully');
    }
}
