<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index()
    {
    	$category = Category::orderBy('id','DESC')->get();
    	return view('category',compact('category'));
    }

    public function addCategory(Request $request)
    {
    	$category = new Category();
    	$category->itemname = $request->itemname;
		$category->category = $request->category;
		$category->save();
		return response()->json($category);    	
    }

    public function deleteCategory($id)
    {
    	$category = Category::find($id);
    	$category->delete();
    	return response()->json(['success'=>'Record has been deleted']);
    }
}
