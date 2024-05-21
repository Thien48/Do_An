<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\User\UserService;
use App\Models\Lecturer;

class AuthController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function register()
    {
        $department =  Department::all();
        return view('auth.dangKi', [
            'departments' => $department,
        ]);
    }

    public function registerPost(Request $request)
    {
        $errors = [];
        $user = new User();

        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;

        $lecturer  = new Lecturer();
        $lecturer->msgv = $request->msgv;
        $lecturer->department_id = $request->department_id;

        $lecturer->name = $request->name;
        $lecturer->telephone = $request->telephone;
        $lecturer->degree = $request->degree;
        $lecturer->gender = $request->gender;
        if ($request->has('image')) {
            $file = $request->image;
            $ext = $request->image->extension();
            $file_name = time() . '-' . 'avatar' . '.' . $ext;
            $file->move(public_path('avatar'), $file_name);
        }
        $lecturer->image = $file_name;
        if (!preg_match('/^[0-9]{7}$/', $request->msgv)) {
            return back()->withErrors('Mã GV phải là 7 số');
        }
        if (!$errors) {
            $user->save();
            $userId = $user->id;
            $lecturer->user_id = $userId;
            $lecturer->save();
            return back('')->with('success', 'Thêm thành công');
        }

        return back()->with('error', 'Thêm không thành công');
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
                return redirect('/admin')->with('successLogin', 'Đăng Nhập thành công');
            } else if (Auth::user()->role == 'gv') {
                return redirect('/lecturer')->with('successLogin', 'Đăng Nhập thành công');
            } else if (Auth::user()->role == 'sv') {
                return redirect('/student')->with('successLogin', 'Đăng Nhập thành công');
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
