<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('index', compact('products'));
    }

    public function profile()
    {
        return view('user.profile');
    }
}
