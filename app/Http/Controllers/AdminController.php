<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\GiangVien;
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
        //
        $now = Carbon::now();
        // Định dạng theo định dạng chuẩn của PHP
        $formattedDateTime = $now->format('d-m-Y');
        $lecturers = Lecturer::All();
        return view(
            'admin.index',
            ['lecturers' => $lecturers],
            ['formattedDateTime' => $formattedDateTime],
            ['title' => 'Thêm danh mục mới']
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createLecturer()
    {
        //
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
        $user = $this->lecturerService->createLecturer($request);
        return back()->with('success', 'Thêm Thành công successfully');
    }
    public function updateLecturer( $user_id)
    {  
        $department =  Department::all();
        $user = User::where('id', $user_id)->first();
        $lecturer = Lecturer::where('user_id', $user_id)->first();
        return view('admin.lecturer.edit',[
            'title' =>'Chỉnh sửa giảng viên: ' . $lecturer->name,
            'lecturer' =>  $lecturer,
            'departments' => $department,
            'user' => $user
        ]);
    }
    public function updateLecturerPost(Request $request, $user_id) 
    {

        // Validate request
        
        $lecturer = Lecturer::where('user_id', $user_id)->first();
        $user = User::where('id', $user_id)->first();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

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
        $lecturer->user_id = $user_id;
        $user->save();
        $lecturer->save();
        return back()->with('success', 'Đã cập nhật thành công');
    }
    public function destroyLecturer(string $user_id)
    {

        $lecturer = Lecturer::where('user_id', $user_id);
        $user = User::where('id', $user_id);
        $lecturer->delete();
        $user->delete();
        return redirect()->back()->with('success', 'Thành công xóa giảng viên');
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
