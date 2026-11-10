<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\View\View;

class OrderHistoryController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('orderItems.book')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('orders.history', compact('orders'));
    }

    public function show(Order $order): View
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['orderItems.book', 'user']);

        return view('user.order-detail', compact('order'));
    }
}
