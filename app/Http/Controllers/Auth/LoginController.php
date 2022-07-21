<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginFormRequest $request)
    {
        $validated = $request->validated();
        if(auth()->attempt($validated)) {
            return to_route('index');
        }
        return back()->withErrors(['incorrect_data' => 'Пользователь не найден']);
    }

    public function logout()
    {
        auth()->logout();
        return to_route('index');
    }

    public function loginAdmin()
    {
        if (App::environment('develop')) {
            $user = User::where('role', 'admin')->first();
            auth()->login($user);
            return to_route('index');
        }
        abort(403);
    }
}
