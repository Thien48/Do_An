<?php

namespace App\Http\Services\Lecturer;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Lecturer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Services\User\UserService;

class LecturerService
{
    public function getDepartment()
    {
        return Department::all();
    }
    
    protected $userService;
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    public function updateLecturer($request, $id)
    {
        $lecturer = Lecturer::find($id)->first();
        $user = User::where('id',$lecturer->user_id)->first();
        $user->email =  $request->email;
        $lecturer->msgv =  $request->msgv;
        $lecturer->department_id =  $request->department_id;

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
        $user->save();
        $lecturer->save();

        Session::flash('success', 'Cập nhật thành công Bộ Môn');
        return true;
    }
    public function destroyLecturer($request)
    {
    
    }
}
