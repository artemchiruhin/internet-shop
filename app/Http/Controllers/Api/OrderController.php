<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return new OrderCollection(Order::all());
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function approve(Order $order)
    {
        abort_if($order->approved_at !== null, 403);
        $order->approved_at = now();
        $order->save();
        return new OrderResource($order);
    }
    public function destroy(Order $order)
    {
        $order->delete();
        return new OrderResource($order);
    }

}
