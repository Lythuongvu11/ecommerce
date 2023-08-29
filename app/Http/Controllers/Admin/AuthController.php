<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request, )
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $admin =Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Đăng nhập thành công
            return redirect()->intended('/admin/dashboard');
        } else {
            // Đăng nhập thất bại
            return redirect()->back()->withErrors(['email' => 'Login information is incorrect']);
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect('/admin/login');
    }

    // Hiển thị form quên mật khẩu
    public function showForgotPasswordForm()
    {
        return view('admin.auth.forgot-password');
    }

    // Gửi liên kết đặt lại mật khẩu
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|exists:admins,email'],
            [
                'email.required' => 'Email không được để trống',
                'email.exists' => 'Email không tồn tại',
            ]);
        $token = strtoupper(Str::random(15));
        $admin = Admin::where('email', $request->email)->first();
        if ($admin) {
            $admin->update(['reset_password_token' => $token]);
            $mailSent = Mail::send('admin.auth.mail_reset', compact('admin'), function ($email) use ($admin) {
                $email->subject('Admin SportShop - Reset Password');
                $email->to($admin->email,$admin->name);
            });

            if ($mailSent) {
                return redirect()->back()->with('message', 'Vui lòng kiểm tra email để lấy lại mật khẩu');
            } else {
                return redirect()->back()->withErrors(['message' => 'Có lỗi trong quá trình gửi email']);
            }
        } else {
            return redirect()->back()->withErrors(['message' => 'Email không tồn tại']);
        }
    }

    public function showResetPasswordForm(Request  $request,$token){
        $admin = Admin::where('reset_password_token', $token)->first();
        if (!$admin) {
            return redirect()->route('admin.login')->with(['message' => 'Đường dẫn không hợp lệ']);
        }

        return view('admin.auth.reset_password', compact('admin', 'token'));

    }
    public function resetPassword(Request $request){
        $request->validate([
            'token' => 'required',
            'admin' => 'required|exists:admins,id',
            'password' => 'required|min:6|confirmed',
        ]);
        $admin = Admin::where('reset_password_token', $request->token)
            ->where('id', $request->admin)
            ->first();
        if (!$admin) {
            return redirect()->route('admin.login')->with(['error' => 'Đường dẫn không hợp lệ']);
        }
        $newPassword = Hash::make($request->password);
        try {
            $admin->password = $newPassword;
            $admin->reset_password_token = null;
            $admin->save();

            return redirect()->route('admin.login')->with(['message' => 'Đổi mật khẩu thành công']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['password' => 'Đã có lỗi xảy ra khi thay đổi mật khẩu']);
        }
    }
}
