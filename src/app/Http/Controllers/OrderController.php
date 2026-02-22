<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Material;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
      public function index()
    {
        $orders = Order::with('checkouts.material')
        ->where('user_id', Auth::id())
        ->get();

        return view('orders.index', compact('orders'));

    }

    public function show(Order $order)
    {
        $order->load('checkouts.material');

        return view('orders.show', compact('order'));
    }



}
