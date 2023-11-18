<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

class FrontendController extends Controller
{
    public function index(){
        $categories = Category::orderBy('id','desc')->get();
        $products = Product::orderBy('created_at','desc')->get();
        return view('frontend.home.index',compact('categories','products'));
    }

    public function productdetails($id , $slug){
        $categories = Category::orderBy('id','desc')->get();

        $product = Product::find($id);

        return view('frontend.home.details',compact('product','categories'));
    }

    public function categoryProducts($slug){
        $categories = Category::orderBy('id','desc')->get();

         $categoryproducts = Category::with('products')->where('slug',$slug)->first();

        return view('frontend.home.category',compact('categories','categoryproducts'));

    }
    public function checkout(){
        $categories = Category::orderBy('id','desc')->get();

       $prducts = Cart::with('products')->orderBy('id','desc')->get();
       $productsname = Product::all();

        return view('frontend.home.checkout',compact('prducts','productsname','categories'));

    }

    public function qtyUpdate($id){

        $qtyUpdatee = Cart::find($id);
        $qtyUpdatee->qty= request()->qty;
        $qtyUpdatee->save();
        return redirect()->back()->with('success','Quantity Has Been Updated');

    }

    public function qtyDelete($id){

        $qtyDelete = Cart::find($id);
    
        $qtyDelete->delete();
        return redirect()->back()->with('success','Product Deleted To Cart');

    }
    public function confirmorder(Request $request){
        $order = new Order();
        $order->name = $request->name;
        $order->product_name = $request->product_name;
        $order->product_image = $request->product_image;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->total_qty = $request->total_qty;
        $order->total_price = $request->total_price;
        $order->save();

        if($order->save()){
            $cartProduct = Cart::all();
            foreach($cartProduct as $cartProduct){
                $cartProduct->delete();
            }
        }
        return redirect()->back()->with('success','Order Confirmed');
 

    }


}
