<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
   
    public function addtocart(Request $request){
  
        $cart = Cart::create([
           'product_id' => $request->product_id,
           'price' => $request->price,
           'qty'=>$request->qty ? $request->qty:1,
           'ip_address'=>$request->ip(),
        ]);
        return redirect()->back()->with('success','Product Has Been Added To Cart');

    }

   
}
