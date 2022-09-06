<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoriesController extends Controller
{
    public function index()
    {
     $categories = Category::all();
     $response['data'] = $categories;
     $response['message'] = "This is all categories";
     return  response()->json($response,200);
    }
    public function show($id)
    {
    $category = Category::find($id);
    if (isset($category)) {
       $response['data'] = $category;
       $response['message'] = "Success";
       return  response()->json($response,200);

    }
       $response['data'] = $category;
       $response['message'] = "Error Not Found";
       return  response()->json($response,404);
    
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;

        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationpath = public_path('/upload');
        $image->move($destinationpath , $name);
        $category->image = $name;
        
        $category->save();
        $response['data'] = $category;
        $response['message'] = "Category Created Successfully";
        return  response()->json($response,200);
        
    }
    public function update(Request $request , $id)
    {
    $category = Category::where('id' , $id)->first();
    if (isset($category))
    {
        if (isset($request->name)){
        $category->name = $request->name;}
        $category->save();
        $response['data'] = $category;
        $response['message'] = "Update Successfully ";
       return  response()->json($response,200);

    }
       $response['data'] = '';
       $response['message'] = "Error Not Found";
       return  response()->json($response,404);

    }
    public function destroy($id)
    {
         $category = Category::find($id);
  if (isset($category)) {
        $category->delete();
        $response['data'] = '';
        $response['message'] = "Category Deleted Successfully";
       return  response()->json($response,200);

    }
       $response['data'] = '';
       $response['message'] = "Error Not Found";
       return  response()->json($response,404); 
    
}

}
