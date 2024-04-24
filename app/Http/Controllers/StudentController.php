<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\Menu\CreateFormRequest;
use Carbon\Carbon;

class StudentController extends Controller
{
    // protected $lecturerService;
    // public function __construct(StudentController $lecturerService)
    // {
    //     $this->lecturerService = $lecturerService;
    // }
    public function index()
    {

        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $student = Student::all();

        return view(
            'admin.student.list',
            [
                'title' => 'Thêm danh mục mới',
                'formattedDateTime' => $formattedDateTime,
                'name' => $getName,
                'students' => $student,
            ]
        );
    }
    public function addStudent()
    {
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        return view('admin.student.add',[
            'title' => 'Thêm mới học sinh',
            'name' =>$getName
        ]);
    }
    public function addStudentPort(Request $request)
    {
        $errors = [];
        $user = new User();

        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'sv';

        $student  = new Student();
        
        $student->mssv = $request->mssv;
        $student->name = $request->name;
        $student->class = $request->class;
        $student->gender = $request->gender;
        $student->telephone = $request->telephone;
        if ($request->has('image')) {
            $file = $request->image;

            $ext = $request->image->extension();
            $file_name = time() . '-' . 'avatar' . '.' . $ext;
            $file->move(public_path('avatar'), $file_name);
        }
        $student->image = $file_name;
        if (!preg_match('/^[0-9]{10}$/', $request->mssv)) {
            return back()->withErrors('Mã SV phải là 10 số');
        }
        if (!$errors) {
            $user->save();
            $userId = $user->id;
            $student->user_id = $userId;
            $student->save();
        }
        return redirect()->back()->with('success', 'Thêm học sinh thành công');
    }
    public function editStudent(Student $id){
        return view('admin.Student.edit',[
            'title' => 'Chỉnh sửa học sinh',
            'id' => $id,
            // 'Student' => $this->studentService->getAll()
        ]);
    }
    public function editStudentPort(Student $id, CreateFormRequest $request){
        // $this->studentService->update($request, $id);
        return redirect('/admin/Student/home');
    }
    public function deleteStudent(Request $request){
        // $resual = $this->StudentService->delete($request);
        // if($resual){
        //     return response()->json([
        //         'error' => false,
        //         'message' => 'Xóa Thành công học sinh'
        //     ]);
        // }
        // return response()->json([
        //         'error' => true,
        //     ]);
    }
}
