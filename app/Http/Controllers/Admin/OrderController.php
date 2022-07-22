<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = cache()->remember('orders', 60*60*24, fn () => Order::with('user', 'products')->get());
        return view('admin.orders.index', compact('orders'));
    }

    public function approve(Request $request, Order $order)
    {
        if(!is_null($order->approved_at)) {
            return to_route('admin.orders.index');
        }
        $order->approved_at = now();
        $order->save();
        return to_route('admin.orders.index')->with('success', 'Заказ был подтвержден');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return to_route('admin.orders.index')->with('success', 'Заказ был удален');
    }
}
