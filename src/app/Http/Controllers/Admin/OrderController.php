<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Order\OrderUpdateRequest;

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

    public function edit(Order $order): View
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(OrderUpdateRequest $request, Order $order): RedirectResponse
    {
        $order->update($request->validated());

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order status updated succesfully');
    }
}
