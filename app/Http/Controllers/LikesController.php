<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\user;
use App\like;

class LikesController extends Controller
{
   public function index()
    {
     $likes = like::all();
     $response['data'] = $likes;
     $response['message'] = "This is all likes";
     return  response()->json($response,200);
    }
 public function store(Request $request)
    {
        $like = new like();
        $like->like = $request->like;
        $like->user_id = $request->user_id;
         $like->product_id = $request->product_id;
        $like->save();

        return $response['data'] = $like;
        
        
    }
 public function destroy($id)
    {
         $like = like::find($id);
  if (isset($like)) {
         $like->delete();
         $response['message'] = "Deleted Successfully";
         return  response()->json($response,200);
    }
        $response['message'] = "nothing to delete";
        return  response()->json($response,404);
 
}
}
