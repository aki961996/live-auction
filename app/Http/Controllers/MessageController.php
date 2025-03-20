<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function dashboard(){
        
        return view('message.index');
    }
    public function sendMessage(Request $request)
    {

        try {
            $msg = Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $request->receiver_id,
                'message' => $request->message,
            ]);
            if ($msg) {
                //broadcast(new MessageSent)
             MessageSent::dispatch($msg);
                return response()->json([
                    'status' => true,
                    'message' => 'Message sent successfully'
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => 'Something Went Wrong: ' . $e->getMessage(),
            ], 201);
        }
    }
}
