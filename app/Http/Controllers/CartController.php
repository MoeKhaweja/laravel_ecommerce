<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{

    public function createCart(Request $request)
    {
        $user = Auth::user();

        if (!$user->cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Cart created for user',
                'cart' => $cart,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'User already has a cart',
            'cart' => $user->cart,
        ]);
    }

    public function addToCart(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $cart = $user->cart;

            CartItem::create([
                'cart_id' => $cart->cart_id,
                'product_id' => $request->product_id,
                'product_quantity'=> $request->product_quantity
            ]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Item added to cart successfully',
            ]);
        } else {
            return response()->json(['forbidden'], 403);
        }
        

    }

    public function removeFromCart(Request $request)
    {
        $user = Auth::user();
        if ($user) {

        $cart = $user->cart;

        CartItem::where('cart_id', $cart->cart_id)
            ->where('cart_item_id', $request->cart_item_id)
            ->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Item removed from cart successfully',
        ]);
        } else {
            return response()->json(['forbidden'], 403);
        }


    }

    public function viewCart(Request $request)
    {
        $user = Auth::user();

        if ($user) {
                    $cart = $user->cart;

        $cartItems = CartItem::where('cart_id', $cart->cart_id)->get();

        return response()->json([
            'status' => 'success',
            'cart_items' => $cartItems,
       
        ]);
        } else {
            return response()->json(['forbidden'], 403);
        }

    }
}
