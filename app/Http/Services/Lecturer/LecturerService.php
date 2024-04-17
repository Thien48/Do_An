<?php

namespace App\Http\Services\Lecturer;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Lecturer;
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
    public function createLecturer( $request)
    {

        $user = $this->userService->createUserLecturer($request);

        $lecturer  = new Lecturer();
        $lecturer->lecturers_id = $request->lecturers_id;
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
        $userId = $user->id;
        $lecturer->user_id = $userId;
        $lecturer->save();

        return $lecturer;
    }
    public function updateLecturer($request, array $user_id)
    {
        $user = User::where('id', $user_id)->first();
        $lecturer = Lecturer::where('user_id', $user_id)->first();
        $lecturer->lecturers_id = $request->lecturers_id;
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
        $userId = $user->id;
        $lecturer->user_id = $userId;
        $lecturer->save();

        return $lecturer;
    }
    public function destroyLecturer($request)
    {
        $id = (string) $request->input('lecturers_id');
        $lecturer = Lecturer::where('lecturers_id ', $request->input('lecturers_id ')->first());
        if($lecturer){
            return Lecturer::where('lecturers_id', $id)->delete();
        }
        return false;
    }
}
