<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Builder;

class UserControllwer extends Controller
{
   public function index()
   {

      // $posts = User::query()
      // ->when(fn(Builder $query) => $query->latest())
      // ->get();
      // dd($posts);
      $admin = User::role('admin')->orderBy('id')->first();

      $users = User::where('id', '!=', optional($admin)->id)->get();
      return view("user.user", compact('users'));
   }

   public function create()
   {
      return view('user.create');
   }

   public function store(Request $request)
   {

      $request->validate([
         'name' => 'required|string|max:255',
         'email' => 'required|email|unique:users,email',
         'password' => 'required|min:6',
      ]);

      // Create new user
      User::create([
         'name' => $request->name,
         'email' => $request->email,
         'password' => bcrypt($request->password), // Encrypt password
      ]);

      return redirect()->route('user.dashboard')->with('success', 'User created successfully.');
   }
   public function show(Request $request, $id)
   {

      try {
         $decryptedId = decrypt($id);


         $userBidderData = User::findOrFail($decryptedId);


         if (!$userBidderData) {
            return abort(404, "User not found or does not have 'bidder' role.");
         }

         return view('user.show', compact('userBidderData'));
      } catch (\Exception $e) {
         return abort(400, "Error: " . $e->getMessage());
      }
   }
   public function edit(Request $request, $id)
   {

      try {
         $decryptedId = decrypt($id);
         $userBidderData = User::findOrFail($decryptedId);

         if (!$userBidderData) {
            return abort(404, "User not found ");
         }

         return view('user.edit', compact('userBidderData'));
      } catch (\Exception $e) {
         return abort(400, "Error: " . $e->getMessage());
      }
   }

   public function update(Request $request, $id)
   {

      try {
         $decryptedId = decrypt($id);
         $user = User::findOrFail($decryptedId);

         // Validate the request
         $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
         ]);

         // Update user details
         $user->update([
            'name' => $request->name,
            'email' => $request->email,
         ]);

         return redirect()->route('user.dashboard')->with('success', 'User bidder updated successfully.');
      } catch (\Exception $e) {
         return redirect()->route('user.dashboard')->with('error', 'Error updating user.');
      }
   }


   public function destroy(Request $request, $id)
   {
      try {
         $decryptedId = decrypt($id);
         $user = User::findOrFail($decryptedId);

         $user->delete(); // Delete the user

         return redirect()->route('user.dashboard')->with('success', 'User bidder deleted successfully.');
      } catch (\Exception $e) {
         return redirect()->route('user.dashboard')->with('error', 'Error deleting user.');
      }
   }
}
