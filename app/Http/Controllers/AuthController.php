<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\User\UserService;
class AuthController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    public function register()
    {
        return view('auth.dangKi');
    }

    public function registerPost(Request $request)
    {
        $result = $this->userService->createUser($request);

        return back()->with('success', 'Register successfully');
    }

    public function login()
    {
        return view('auth.dangNhap');
    }

    public function loginPost(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credetials)) {
            if (Auth::user()->role == 'admin') {
                return redirect('/admin')->with('success', 'Login Success');
            } else if (Auth::user()->role == 'gv') {
                return redirect('/giangVien')->with('success', 'Login Success');
            } else if (Auth::user()->role == 'sv') {
                return redirect('/sinhVien')->with('success', 'Login Success');
            }
        }
        return back()->with('error', 'Sai mật khẩu hoặc tài khoản');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
