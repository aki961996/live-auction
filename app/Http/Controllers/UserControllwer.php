<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserControllwer extends Controller
{
   public function index(){
     $admin = User::role('admin')->orderBy('id')->first();
  
    $users = User::where('id', '!=', optional($admin)->id)->get();
    

    return view("user.user", compact('users'));
   }
   public function show(Request $request, $id){
      
    $user_data = User::role('user')->orderBy('id')->get();
  
    
      return view('user.show',compact('user_data'));
   }
   public function edit(Request $request, $id){
    $user = User::find($id);
    return view('user.edit',compact('user'));
   }
   public function destroy(){
    return "destroy";
    
   }


}
