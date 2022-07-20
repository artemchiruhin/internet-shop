<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        return view('user.products.show', compact('product'));
    }

    public function addProductToCart(Product $product)
    {
        session()->push('cart', $product->id);
        return to_route('user.cart.index');
    }

    public function removeProductFromCart(Product $product)
    {
        $products = session()->pull('cart', []);
        if(($key = array_search($product->id, $products)) !== false) {
            unset($products[$key]);
        }
        session()->put('cart', $products);
        return to_route('user.cart.index');
    }
}
