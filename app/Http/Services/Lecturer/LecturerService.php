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
    
    protected $userService;
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    public function updateLecturer($request, $id)
    {
        $errors = [];
        $newImage = '';
        $lecturer = Lecturer::find($id);
        $user = User::where('id',$lecturer->user_id)->first();
        $user->email =  $request->email;
        $lecturer->msgv =  $request->msgv;
        $lecturer->department_id =  $request->department_id;

        $lecturer->name = $request->name;
        $lecturer->telephone = $request->telephone;
        $lecturer->degree = $request->degree;
        $lecturer->gender = $request->gender;
        $oldImage = $lecturer->image;

        if ($request->has('image')) {
            $newfile = $request->image;

            $ext = $request->image->extension();
            $file_name = time() . '-' . 'avatar' . '.' . $ext;
            $newImage = $file_name; 
            $newfile->move(public_path('avatar'), $file_name);
            $lecturer->image = $newImage;
        }
        else{
            $lecturer->image = $oldImage;
        }
        if (!preg_match('/^[0-9]{7}$/', $request->msgv)) {
            return back()->withErrors('Mã GV phải là 7 số');
        }
        if (!$errors) {
            $lecturer->save();
            $user->save();
        }
        Session::flash('success', 'Cập nhập thành công giảng viên');
        return true;
    }
}
