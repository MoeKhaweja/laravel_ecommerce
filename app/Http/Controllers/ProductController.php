<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        
    }
    
    public function index()
    {
        $products = Product::all();
        return response()->json(['products' => $products], 200);
    }

    public function show($product_id)
    {
        $product = Product::where('product_id', $product_id)->first();
        return response()->json(['product' => $product], 200);
    }
    public function store(Request $req)
    {

        $product = Product::insert([
            "product_name" => $req->product_name,
            "product_description" => $req->product_description,
            "product_price" => $req->product_price,
            "product_stock" => $req->product_stock,
            "seller_id" => $req->seller_id,
        ]);

        return response()->json(['product' => $product], 200);
    }

    public function update(Request $req)
    {
        $product = Product::where('product_id', $req->product_id)->first();
        
        $product->update([
            "product_name" => $req->product_name ?? $product->product_name,
            "product_description" => $req->product_description ?? $product->product_description,
            "product_price" => $req->product_price ?? $product->product_price,
            "product_stock" => $req->product_stock ?? $product->product_stock,
            "seller_id" => $req->seller_id ?? $product->seller_id
        ]);

        return response()->json(['product' => $product], 200);
    }

    public function destroy(Request $req)
    {
        $product = Product::where('product_id', $req->product_id)->first();

        $product->delete();

        return response()->json("product deleted", 200);
    }
}