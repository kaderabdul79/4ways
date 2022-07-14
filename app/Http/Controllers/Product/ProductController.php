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

    // edit product Detail's
    public function edit($id)
    {
        $product = Product::find($id);
        if($product)
        {
            return response()->json([
                'status'=>200,
                'product'=> $product,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No product Found.'
            ]);
        }
    }

    // update product Detail's
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'price'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $product = Product::find($id);
            if($product)
            {
                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->quantity = $request->quantity;
                $product->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'product Updated Successfully.'
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'No product Found.'
                ]);
            }
        }
    }

    // delete the product in specific the ID row
    public function destroy($id){
        $product = Product::find($id);
        if($product)
        {
            $product->delete();
            return response()->json([
                'status'=>200,
                'message'=>'product Deleted Successfully.'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No product Found.'
            ]);
        }
    }
}
