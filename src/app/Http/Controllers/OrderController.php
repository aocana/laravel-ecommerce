<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
        if (!Gate::allows('order-user', $order->user->id)) {
            abort(404);
        }

        return view('order.show', compact('order'));
    }

    public function search(Request $request): View
    {
        return view('order.index', [
            'orders' => $this->searchTemplate($request, Order::class),
        ]);
    }
}
