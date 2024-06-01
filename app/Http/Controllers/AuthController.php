<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\User\UserService;
use App\Models\Student;
use Illuminate\Contracts\Session\Session;

class AuthController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function showStudentRegisterForm()
    {
        return view('auth.dangKi',);
    }

    public function createStudent(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'gender' => 'required|boolean',
            'telephone' => 'required|size:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role ='sv';
        $user->save();

        if ($request->has('image')) {
            $file = $request->image;
            $ext = $request->image->extension();
            $file_name = time() . '-' . 'avatar' . '.' . $ext;
            $file->move(public_path('avatar'), $file_name);
        }
 
        $student = new Student();
        $student->mssv = $request->mssv;
        $student->name = $request->name;
        $student->class = $request->class;
        $student->gender = $request->gender;
        $student->telephone = $request->telephone;
        $student->image = $file_name;
        $student->user_id =  $user->id;
        $student->save();
        return redirect('/dangNhap')->with('success', 'Đăng ký thành công');
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
