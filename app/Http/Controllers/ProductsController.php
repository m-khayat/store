<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;1
use DB ;
use App\User;


class ProductsController extends Controller
{
    public function index()
    {
        
        $products=Product::all();
        foreach ($products as $product) {
            $b_date=Carbon::today();
            $f_date=Carbon::parse($product->expiration_date);
            if($f_date->Ispast())
            {
                $product-> delete();
            }
            if($b_date->diffInDays($f_date)<=$product->period3)
            {
                $product->price=$product->price-($product->price*$product->discount_period3/100);
            }
            elseif($b_date->diffInDays($f_date)<=$product->period2)
            {
                $product->price=$product->price-($product->price*$product->discount_period2/100);
            }
            elseif($b_date->diffInDays($f_date)<=$product->period1)
            {
                $product->price=$product->price-($product->price*$product->discount_period1/100);
            }
        }
        return $products;

        $response['data'] = $products;
        $response['message'] = "This is all products";
        return  response()->json($response,200);
    }

 public function progressive()
    {
        $products=Product::orderBy('name')->get();
        foreach ($products as $product) {
            $b_date=Carbon::today();
            $f_date=Carbon::parse($product->expiration_date);
            if($f_date->Ispast())
            {
                $product-> delete();
            }
            if($b_date->diffInDays($f_date)<=$product->period3)
            {
                $product->price=$product->price-($product->price*$product->discount_period3/100);
            }
            elseif($b_date->diffInDays($f_date)<=$product->period2)
            {
                $product->price=$product->price-($product->price*$product->discount_period2/100);
            }
            elseif($b_date->diffInDays($f_date)<=$product->period1)
            {
                $product->price=$product->price-($product->price*$product->discount_period1/100);
            }
        }
        return $products;

        $response['data'] = $products;
        $response['message'] = "This is all products";
        return  response()->json($response,200);
    }

 public function descending()
    {
        $products=Product::orderBy('name','desc')->get();
        foreach ($products as $product) {
            $b_date=Carbon::today();
            $f_date=Carbon::parse($product->expiration_date);
           if($f_date->Ispast())
            {
                $product-> delete();
            }
            if($b_date->diffInDays($f_date)<=$product->period3)
            {
                $product->price=$product->price-($product->price*$product->discount_period3/100);
            }
            elseif($b_date->diffInDays($f_date)<=$product->period2)
            {
                $product->price=$product->price-($product->price*$product->discount_period2/100);
            }
            elseif($b_date->diffInDays($f_date)<=$product->period1)
            {
                $product->price=$product->price-($product->price*$product->discount_period1/100);
            }
        }
        return $products;

        $response['data'] = $products;
        $response['message'] = "This is all products";
        return  response()->json($response,200);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (isset($product)) {
            $b_date=Carbon::today();
            $f_date=Carbon::parse($product->expiration_date);
            if($f_date->Ispast())
            {
                $product-> delete();
            }
            if($b_date->diffInDays($f_date)<=$product->period3)
            {
                $product->price=$product->price-($product->price*$product->discount_period3/100);
            }
            elseif($b_date->diffInDays($f_date)<$product->period2)
            {
                $product->price=$product->price-($product->price*$product->discount_period2/100);
            }
            elseif($b_date->diffInDays($f_date)<$product->period1)
            {
                $product->price=$product->price-($product->price*$product->discount_period1/100);
            }

            $response['data'] = $product;
            $response['message'] = "Success";
            return  response()->json($response,200);

        }
        $response['data'] = $product;
        $response['message'] = "Error Not Found";
        return  response()->json($response,404);

    }
    public function store(Request $request ){
        $product = new Product();
        $product->name=$request->name;
        $product->description=$request->description;
        $product->expiration_date=$request->expiration_date;
        $product->contact_informations=$request->contact_informations;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->period1=$request->period1;
        $product->period2=$request->period2;
        $product->period3=$request->period3;
        $product->discount_period1=$request->discount_period1;
        $product->discount_period2=$request->discount_period2;
        $product->discount_period3=$request->discount_period3;
        $product->view_count=$request->view_count;
        $product->category_id=$request->category_id;
        $product->user_id=$request->user_id;
        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationpath = public_path('/upload');
        $image->move($destinationpath , $name);
        $product->image = $name;


        $product->save();
        $response['data'] = $product;
        $response['message'] = "Success";
        return  response()->json($response,200);
    }

    public function update(Request $request , $id)
    {

     $product = product::where('id' , $id)->first();
     
         if (isset($product)) 
         {
            if (isset($request->name)) {
                $product->name = $request->name;
            }

            if (isset($request->description)) {
                $product->description = $request->description;
            }

            if (isset($request->contact_informations)) {
                $product->contact_informations = $request->contact_informations;
            }
            if (isset($request->quantity)) {
                $product->quantity = $request->quantity;
            }
            if (isset($request->price)) {
                $product->price = $request->price;
            }
            if (isset($request->period1)) {
                $product->period1 = $request->period1;
            }
            if (isset($request->period2)) {
                $product->period2 = $request->period2;
            }
            if (isset($request->period3)) {
                $product->period3 = $request->period3;
            }
            if (isset($request->discount_period1)) {
                $product->discount_period1 = $request->discount_period1;
            }
            if (isset($request->discount_period2)) {
                $product->discount_period2 = $request->discount_period2;
            }
            if (isset($request->discount_period3)) {
                $product->discount_period3 = $request->discount_period3;
            }
            if (isset($request->image)) 
            { 
               $image = $request->file('image');
               $name = time().'.'.$image->getClientOriginalExtension();
               $destinationpath = public_path('/upload');
               $image->move($destinationpath , $name);
               $product->image = $name;
           }

           $product->save();
           $response['data'] = $product;
           $response['message'] = "success";
           return response()->json($response,200);

       }

       $response['data'] = $product;
       $response['message'] = "Error Not Found";
       return response()->json($response,404);

   }

public function destroy($id)
{
    $product = Product::find($id);
    if (isset($product)) {
        $product->delete();
       
        $response['message'] = "Product Deleted Successfully";
        return  response()->json($response,200);

    }
   
    $response['message'] = "Error Not Found";
    return  response()->json($response,404);

}

public function Search(Request $request) 
{

    $data = $request->get('data');

    $search_product = Product::where('name', 'like', "%{$data}%")
    ->orWhere('expiration_date', 'like', "{$data}%")
    ->get();
    if (count($search_product)){
        $response['data'] = $search_product;
       $response['message'] = "success";
       return response()->json([$response,200]);     
   }
   else
   {
    return response()->json(['message' => ' Data not found'], 404);
}

}

public function SearchByCategory(Request $request) 
{

    $data = $request->get('data');

    $search_product = Product::where('category_id', $data)
    ->get();
    if (count($search_product)){
       $response['data'] = $search_product;
       $response['message'] = "success";
       return response()->json([$response,200]);     
   }
   else
   {
    return response()->json(['message' => ' Data not found'], 404);
}

}

}