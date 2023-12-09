<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;


class OrderController extends Controller
{

    public function orderHistory() {
        $user = Auth::user();
        if ($user) {
        $orders = Order::where('user_id', $user->id)->get();
        return response()->json(['orderHistory' => $orders], 200);
    } else {
        return response()->json(['forbidden'], 403);
    }
}}
