<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterFormRequest $request)
    {
        $validated = $request->validated();
        $user = User::create($validated);
        try {
            event(new Registered($user));
            auth()->login($user);
            return to_route('verification.notice');
        } catch (\Exception $e) {
            auth()->login($user);
            return to_route('index');
        }
    }
}
