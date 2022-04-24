<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::latest()->paginate(12);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        //
    }
}
