<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendResetPasswordLinkRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function forgotPasswordForm()
    {
        return view('auth.password.forgot');
    }

    public function sendResetLink(SendResetPasswordLinkRequest $request)
    {
        $validated = $request->validated();

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => 'Ссылка успешно отправлена'])
            : back()->withErrors(['email' => 'Ошибка в email']);
    }

    public function resetPasswordForm($token)
    {
        return view('auth.password.reset', compact('token'));
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $request->validated();
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password
                ]);

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('auth.login')->with('status', __($status))
            : back()->withErrors(['email' => ['Ошибка в email']]);
    }
}
