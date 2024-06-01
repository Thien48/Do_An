<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email'),
            function ($user, $token) {
                $resetUrl = url(route('password.reset', ['token' => $token, 'email' => $user->getEmailForPasswordReset()], false));
                Mail::to($user->getEmailForPasswordReset())->send(new ResetPasswordMail($resetUrl));
            }
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => 'Chúng tôi đã gửi email liên kết đặt lại mật khẩu của bạn.'])
                    : back()->withErrors(['email' => __('Không thể tìm thấy địa chỉ email của người dùng.')]);
    }
}
