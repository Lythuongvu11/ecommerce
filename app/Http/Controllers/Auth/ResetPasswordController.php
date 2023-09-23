<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use function Symfony\Component\String\u;

class ResetPasswordController extends Controller
{

    public function showResetForm(Request  $request,$token){
        $user = User::where('reset_password_token', $token)->first();
        if (!$user) {
            return redirect()->route('login')->with(['message' => 'Đường dẫn không hợp lệ']);
        }

        return view('client.auth.reset', compact('user', 'token'));

    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'user' => 'required|exists:users,id',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('reset_password_token', $request->token)
            ->where('id', $request->user)
            ->first();
        if (!$user) {
            return redirect()->route('login')->with(['error' => 'Đường dẫn không hợp lệ']);
        }
        $newPassword = Hash::make($request->password);
        try {
            $user->password = $newPassword;
            $user->reset_password_token = null;
            $user->save();

            return redirect()->route('login')->with(['message' => 'Đổi mật khẩu thành công']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['password' => 'Đã có lỗi xảy ra khi thay đổi mật khẩu']);
        }
    }

}
