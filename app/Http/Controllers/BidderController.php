<?php

namespace App\Http\Controllers;

use App\Events\BidderPlacedEvent;
use App\Models\Bidder;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Event;

class BidderController extends Controller
{
    public function dashboard()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(5);


        if ($products) {
            foreach ($products as $product) {
                $createdAt   = $product['created_at'];
                $totalCountdown = 5 * 60;


                $elapsedSeconds = $createdAt->diffInSeconds(now());


                $remainingSeconds = max(0, $totalCountdown - $elapsedSeconds);


                $remainingMinutes = floor($remainingSeconds / 60);
                $remainingSeconds = $remainingSeconds % 60;

                $timeLeft = sprintf('%02d:%02d', $remainingMinutes, $remainingSeconds);
                $product['bid_time_left'] = $timeLeft;
            }
        }

        $bidded_data = Bidder::with(['user', 'product'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('dashboard', compact('products', 'bidded_data'));
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
        $product = Product::findOrFail($decryptedProductId);

        $request->validate([
            'amount' => 'required|numeric|min:' . $product->price,
        ]);

        $bidderData = [
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'amount' => $request->amount,
        ];
        $bid = Bidder::create($bidderData);
        // Trigger an event
        event(new BidderPlacedEvent($bid));
        //  return "Event done...";
        return redirect()->back();
        // return redirect()->back()->with('success', 'Bid placed successfully');
    }
}
