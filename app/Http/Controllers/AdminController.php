<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\GiangVien;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Lecturer\LecturerService;
use App\Http\Requests\Menu\CreateFormRequest;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        //
        $now = Carbon::now();
        // Định dạng theo định dạng chuẩn của PHP
        $formattedDateTime = $now->format('d-m-Y');
        $lecturers = Lecturer::All();
        return view('admin.index', ['lecturers' => $lecturers], ['formattedDateTime' => $formattedDateTime]);
    }

    /**
     * Show the form for creating a new resource.
     */
    protected $lecturerService;
    public function __construct(LecturerService $lecturerService)
    {
        $this->lecturerService = $lecturerService;
    }
    public function createLecturer()
    {
        //
        $department = new Department;
        $departments = $department->getAllDepartments();

        return view(
            'admin.lecturer.add',
            [
                'title' => 'Thêm giảng viên mới',
                'departments' => $departments,
            ]
        );
    }
    public function createLecturerPost(Request $request)
    {
        $user = new User();

        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'gv';


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
        $user->save();
        $userId = $user->id;
        $lecturer->user_id = $userId;
        $lecturer->save();

        return back()->with('success', 'Thêm Thành công successfully');
    }
    public function updateLecturer(Request $request, Lecturer $lecturer, User $user) {

        // Validate request

        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $lecturer->lecturers_id = $request->lecturers_id;
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
        $lecturer->save();
      
        return redirect('/lecturers')->with('success', 'Đã cập nhật thành công');
      
      }
    public function createStudent()
    {
        //
    }
    public function createPostStudent(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
