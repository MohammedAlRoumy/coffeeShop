<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $contact = ContactUs::all();
        $products = Product::all();
        $orders = Order::all();
        $users = User::all();
        return view('dashboard.index',compact('contact','products','users','orders'));
    }
}
