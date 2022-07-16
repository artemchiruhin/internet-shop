<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('index', compact('products'));
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function verificationMessage()
    {
        return view('auth.verify-email');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return to_route('index');
    }

    public function resendEmailVerificationMessage(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Ссылка была отправлена!');
    }
}
