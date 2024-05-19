<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\User;


class StudentRegisterController extends Controller
{
    public function index(){
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Student::where('user_id', $getID)->first();
        return view('student.index',[
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
        ]);
    }
    public function profileStudent(){
        $getID = Auth::user()->id;
        $student = Student::where('user_id', $getID)->first();
        $user = User::where('id', $getID)->first();
        return view('student.profileStudent',[
            'name' => $student,
            'user' => $user,
        ]);
    }
    public function changePasswordStudent(){
        $getID = Auth::user()->id;
        $getName = Student::where('user_id', $getID)->first();
        return view('student.changePass',[
            'name' =>  $getName,
        ]);
    }
    public function changePasswordStudentPort(Request $request){
        $getID = Auth::user()->id;
        $user = User::find($getID);
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác.']);
        }

        // Kiểm tra mật khẩu mới và xác nhận mật khẩu mới khớp nhau
        if ($request->new_password !== $request->confirm_password) {
            return redirect()->back()->withErrors(['confirm_password' => 'Mật khẩu mới và xác nhận mật khẩu mới không khớp.']);
        }

        // Cập nhật mật khẩu mới cho người dùng
        $user->password = Hash::make($request->new_password);

        $user->save();

        // Chuyển hướng người dùng đến trang thành công hoặc thông báo thành công
        return back()->with('success', 'Đổi mật khẩu thành công.');
    }
}
