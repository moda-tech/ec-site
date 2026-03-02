<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Checkout;

class OrderController extends Controller
{
     public function index()
    {
         $orders = Order::with('checkouts')
        ->orderBy('created_at', 'desc')
        ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('checkouts')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

}
