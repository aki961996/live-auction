<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;


class AdminController extends Controller
{
 public function index(){
    $admins = User::role('admin')->get(); // Fetch users with 'admin' role


return view('admin.index', compact('admins'));
      
 }
}
