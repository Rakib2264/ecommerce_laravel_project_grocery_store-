<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Support\Str;
use Image;


class ProductController extends Controller{
    public function productManage(){
        $products = Product::orderBy('id', 'desc')->get();
        return view("backend.product.index",compact('products'));
    }


    public function productAddForm(){
        $categories = Category::orderBy('id','desc')->get();
        $subcategories = SubCategory::orderBy('id','desc')->get();
        return view("backend.product.create",compact('categories','subcategories'));
    }

    public function productStore(Request $request){

        $request->validate([
            'category_id'=>'required|integer',
            'sub_category_id'=>'required|integer',
            'name'=>'required|string',
            'buy_price'=>'required',
            'sale_price'=>'required',
            'long_description'=>'required',
            'image'=>'required|image',
        ]);

        
         $image = $request->file('image');
        $imageName = rand().'.'.$image->getClientOriginalExtension();
        $location = public_path("product/".$imageName);
        Image::make($image)->resize(219,150)->save($location);

        Product::create([
              'category_id' =>$request->category_id,
              'sub_category_id' =>$request->sub_category_id,
              'name'=>$request->name,
              'slug'=>Str::slug($request->name),
              'buy_price'=>$request->buy_price,
              'sale_price'=>$request->sale_price,
              'short_description'=>$request->short_description,
              'long_description'=>$request->long_description,
               'image'=>$imageName,

        ]);
        return redirect()->back()->with('success', 'Product Has Been Saved');


    }

    public function productEdit($id){
        $categories = Category::orderBy('id','desc')->get();
        $subcategories = SubCategory::orderBy('id','desc')->get();
        $product = Product::find($id);
        return view("backend.product.edit",compact('categories','subcategories','product'));

    }
 public function productUpdate(Request $request , $id){

  $product = Product::find($id);
    $request->validate([
        'category_id'=>'required|integer',
        'sub_category_id'=>'required|integer',
        'name'=>'required|string',
        'buy_price'=>'required',
        'sale_price'=>'required',
        'long_description'=>'required',
     ]);
     if($request->hasFile('image')){
        if ($product->image && file_exists('/product/'.$product->image)) {
           unlink('product/'.$product->image);
        }
        $imageUpdate= time().'.'.$request->image->extension();
        $request->image->move('product',$imageUpdate);
        $product->image = $imageUpdate;
     }

      $product->update([
        'category_id' =>$request->category_id,
        'sub_category_id' =>$request->sub_category_id,
        'name'=>$request->name,
        'slug'=>Str::slug($request->name),
        'buy_price'=>$request->buy_price,
        'sale_price'=>$request->sale_price,
        'short_description'=>$request->short_description,
        'long_description'=>$request->long_description,

      ]);
      return redirect()->back()->with('success', 'Product Updated');

 }

 public function productDelete($id){
    $product = Product::find($id);
    $product->delete();
    return redirect()->back()->with('success', 'Product Delete');
 }

}
