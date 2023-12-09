<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if ($user) {

            $products = Product::all();
            return response()->json(['products' => $products], 200);
        } else {
            return response()->json(['forbidden'], 403);
        }

    }

    public function show($product_id)
    {
        $user = Auth::user();

        if ($user) {
            $product = Product::where('product_id', $product_id)->first();
            return response()->json(['product' => $product], 200);

        } else {
            return response()->json(['forbidden'], 403);
        }


    }

    public function store(Request $req)
    {
        $user = Auth::user();

        if ($user && $user->user_type_id === 2) {

            $product = Product::insert([
                "product_name" => $req->product_name,
                "product_description" => $req->product_description,
                "product_price" => $req->product_price,
                "product_stock" => $req->product_stock,
                "seller_id" => $req->seller_id,
            ]);
    
            return response()->json(['product' => $product], 200);

        } else {
            return response()->json(['forbidden'], 403);
        }

    }

    
    public function update(Request $req)
    {
        $user = Auth::user();

        if ($user && $user->user_type_id === 2) {

            $product = Product::where('product_id', $req->product_id)->first();
        
            $product->update([
                "product_name" => $req->product_name ?? $product->product_name,
                "product_description" => $req->product_description ?? $product->product_description,
                "product_price" => $req->product_price ?? $product->product_price,
                "product_stock" => $req->product_stock ?? $product->product_stock,
                "seller_id" => $req->seller_id ?? $product->seller_id
            ]);
    
            return response()->json(['product' => $product], 200);
            
        } else {
            return response()->json(['forbidden'], 403);
        }

    }

    public function destroy(Request $req)
    {
        $user = Auth::user();

        if ($user && $user->user_type_id === 2) {

        $product = Product::where('product_id', $req->product_id)->first();

        $product->delete();

        return response()->json("product deleted", 200);
    } else {
            return response()->json(['forbidden'], 403);
        }}}