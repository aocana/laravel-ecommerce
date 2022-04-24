<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::where('user_id', '=', auth()->user()->id)
            ->paginate(12);
        return view('order.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        return view('order.show', compact('order'));
    }
}
