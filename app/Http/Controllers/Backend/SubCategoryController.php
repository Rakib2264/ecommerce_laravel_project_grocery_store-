<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
class SubCategoryController extends Controller{

    public function subcategoryAddForm(){
        $catagories = Category::orderBy('id','desc')->get();
        return view('backend.subcategory.add',compact('catagories'));
    }

    public function subcategorystore(Request $request){
        $request->validate([
            'name'=>'required'
        ]);
        SubCategory::create([
               'category_id'=>$request->category_id,
               'name'=>$request->name,
               'slug'=>Str::slug($request->name),
        ]);
        return redirect()->back()->withSuccess('SubCategory Has Been Saved');
    }


    public function subcategoryManage(){
        $subcategories = SubCategory::orderBy('id','desc')->get();
         return view('backend.subcategory.manage',compact('subcategories'));
    }



    public function subcategoryedit($id){
        $catagories = Category::orderBy('id','desc')->get();
        $subcategory = SubCategory::find($id);
         return view('backend.subcategory.edit',compact('subcategory','catagories'));

    }

    public function subcategoryupdate(Request $request , $id){
        $subcategory = SubCategory::find($id);
      $subcategory->update([
        'category_id'=>$request->category_id,
        'name'=>$request->name,
        'slug'=>Str::slug($request->name),
    ]);

     return redirect()->route('subcategory.manage')->with('success','SubCategory Updated');

    }
    public function subcategorydelete(Request $request , $id){
        $subcategory = SubCategory::find($id);
        $subcategory->delete();
        session()->flash('success', 'SubCategory Deleted');
        return redirect()->route('subcategory.manage')->with('success','SubCategory Deleted');

    }
}
