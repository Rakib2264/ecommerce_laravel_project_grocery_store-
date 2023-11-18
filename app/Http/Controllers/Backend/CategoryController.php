<?php

namespace App\Http\Controllers\Backend;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller{
    public function categoryAddForm(){
        return view('backend.category.add');
    }

    public function categoryManage(){
        // $categoryes =Category::all();
        $categoryes =Category::orderBy('id','desc')->get();
        return view('backend.category.manage',compact('categoryes'));
    }

    public function categorystore(Request $request){
        $request->validate([
            'name'=>'required'
        ]);
        Category::create([
               'name'=>$request->name,
               'slug'=>Str::slug($request->name),
        ]);
        return redirect()->back()->with('success','Category Has Been Saved');
    }

    public function categoryedit($id){

        $category = Category::find($id);

        return view('backend.category.edit',compact('category'));

    }

    public function categoryupdate(Request $request , $id){
        $category = Category::find($id);
      $category->update([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
    ]);

     return redirect()->route('category.manage')->with('success','Category Updated');

    }
    public function categorydelete(Request $request , $id){
        $category = Category::find($id);
        $category->delete();
        session()->flash('success', 'Category Deleted');
        return redirect()->route('category.manage')->with('success','Category Deleted');

    }

}
