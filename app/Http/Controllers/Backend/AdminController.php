<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard(){
        $orders = Order::orderBy('id','desc')->get();
        return view('backend.home.index',compact('orders'));
    }

    public function invoice($id){
        $order = Order::find($id);
        return view('backend.invoice.invoice',compact('order'));


    }
}
