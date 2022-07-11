<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        return view('product.index');
    }
    // check validation and insert data to db
    public function store(Request $request){
        // validating data
        $validation = Validator::make($request->all(),[
            'name'=>'required',
            'price'=>'required',
        ]);
        if($validation->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validation->messages()
            ]);
        }
        // create product instance
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->save();
        return response()->json([
            'status'=>200,
            'message'=>'Product Added Successfully.'
        ]);
    }

    // fetch all product from db
    public function getAllProduct()
    {
        $products = Product::all();
        return response()->json([
            'products'=>$products,
        ]);
    }
}
