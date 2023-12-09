<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;


class OrderController extends Controller
{
    public function orderHistory($userId) {

        $orders = Order::where('user_id', $userId)->get();


        return response()->json(['orderHistory' => $orders], 200);
    }
}
