<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Lecturer\LecturerService;
use Carbon\Carbon;


class AdminController extends Controller
{
    protected $lecturerService;
    public function __construct(LecturerService $lecturerService)
    {
        $this->lecturerService = $lecturerService;
    }
    public function index()
    {

        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $lecturers = Lecturer::with('department')->get();
        $data = DB::table('lecturers')
            ->join('departments', 'lecturers.department_id', '=', 'departments.id')
            ->select('lecturers.*', 'departments.name_department')
            ->get();

        return view(
            'admin.index',
            [
                'title' => 'Thêm danh mục mới',
                'lecturers' => $lecturers,
                'formattedDateTime' => $formattedDateTime,
                'data' => $data
            ]
        );
    }
    public function createLecturer()
    {
        $department =  Department::all();

        return view(
            'admin.lecturer.add',
            [
                'title' => 'Thêm giảng viên mới',
                'departments' => $department,
            ]
        );
    }
    public function createLecturerPost(Request $request)
    {
        $errors = [];
        $user = new User();

        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'gv';

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
        if (!preg_match('/^[0-9]{10}$/', $request->msgv)) {
            return back()->withErrors('Mã GV phải là 10 số');
        }
        if (!$errors) {
            $user->save();
            $userId = $user->id;
            $lecturer->user_id = $userId;
            $lecturer->save();
        }

        return back()->with('success', 'Thêm thành công');
    }
    public function updateLecturer($id)
    {
        $newImage = '';
        $lecturer = Lecturer::find($id);
        $user = User::where('id', $lecturer->user_id)->first();
        $department =  Department::where('id', $lecturer->department_id)->first();
        $departments = Department::all();
        return view('admin.lecturer.edit', [
            'title' => 'Chỉnh sửa giảng viên: ' . $lecturer->name,
            'lecturer' =>  $lecturer,
            'departments' => $department,
            'departmentsOTP' => $departments,
            'user' => $user,
            'newImage' => $newImage
        ]);
    }
    public function updateLecturerPost(Request $request, $id)
    {

        $this->lecturerService->updateLecturer($request, $id);
        return redirect('/admin');
    }
    public function destroyLecturer(string $user_id)
    {
        $lecturer = Lecturer::where('user_id', $user_id);
        $user = User::where('id', $user_id);
        $lecturer->delete();
        $user->delete();
        return redirect()->back()->with('success', 'Thành công xóa giảng viên');
    }
}
