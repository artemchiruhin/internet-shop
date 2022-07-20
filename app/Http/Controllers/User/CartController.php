<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $products = [];
        $cost = 0;
        foreach(session('cart') ?? [] as $item) {
            $product = Product::find($item);
            $products[] = $product;
            $cost += $product->price;
        }
        return view('user.cart.index', compact('products', 'cost'));
    }

    public function makeOrder()
    {
        $order = Order::create([
            'user_id' => auth()->id(),
        ]);
        $order->products()->attach(session('cart'));
        session()->forget('cart');
        return to_route('user.cart.index');
    }
}
