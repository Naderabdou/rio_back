<?php

namespace App\Http\Controllers\Site;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Site\LoginRequest;
use App\Http\Requests\Site\ForgetPassword;
use App\Http\Requests\Site\RegisterRequest;
use App\Http\Requests\Site\ResetPasswordRequest;
use App\Http\Requests\Site\CheckCodeRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $password = $request->password;
        $login = $request->emailOrPhone;
        $credentials = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? ['email' => $login, 'password' => $password]
            : ['phone' => $login, 'password' => $password];
        Auth::attempt($credentials);
        if (Auth::check()) {
            return response()->json(['message' => transWord('Logged in successfully'), 'user' => Auth::user()]);
        } else {
            return response()->json(['message' => transWord('بيانات الدخول خطأ')], 422);
        }
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->except('check');
        $user = User::create($data);
        $user->assignRole('user');

        //login user
        Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        return response()->json(['message' => transWord('Registered successfully')]);
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();


        return redirect('/')->with('success', transWord('تم تسجيل الخروج'));
    }

    public function forgetPassword(ForgetPassword $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->sendEmailVerificationCode();
            return response()->json(['message' => transWord('Reset password link sent to your email'), 'email' => $request->email]);
        } else {
            return response()->json(['message' => transWord('User not found')], 422);
        }
    }

    public function checkCode(CheckCodeRequest $request)
    {
        $code  = implode('', $request->code);
        $user = User::where('email', $request->email)->first();
        if ($user->code == $code) {
            $user->update(['code' => null]);
            return response()->json(['message' => transWord('Code is correct'), 'email' => $request->email]);
        } else {
            return response()->json(['message' => transWord('Code is incorrect')], 422);
        }
    }

    public function updatePassword(ResetPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => transWord('User not found')], 422);
        }

        $user->password = $request->password;
        $user->save();
        return response()->json(['message' => transWord('Password update successfully')]);
    }

    public function resendCode($email)
    {

        $user = User::where('email', $email)->first();

        $user->sendEmailVerificationCode();
        return response()->json(['message' => transWord('Code sent to your email')]);
    }
}
