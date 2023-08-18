<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // Đăng nhập thành công
            return redirect()->intended('/admin/dashboard');
        } else {
            // Đăng nhập thất bại
            return redirect()->back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác']);
        }
    }

    // Hiển thị form quên mật khẩu
    public function showForgotPasswordForm()
    {
        return view('admin.forgot-password');
    }

    // Gửi liên kết đặt lại mật khẩu
    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $response = Password::broker('admins')->sendResetLink(
            $request->only('email')
        );

        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('status', 'Link đặt lại mật khẩu đã được gửi vào email của bạn.');
        }

        return back()->withErrors(['email' => trans($response)]);
    }
}
