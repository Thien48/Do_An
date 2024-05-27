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
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentImport;
use App\Mail\NotifyStudentMail;
use Illuminate\Support\Facades\Mail;



class StudentController extends Controller
{
    // protected $studentService;
    // public function __construct(StudentController $studentService)
    // {
    //     $this->studentService = $studentService;
    // }
    public function index()
    {

        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $student = DB::table('students')->orderBy('mssv')->paginate(5);

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
        return view('admin.student.add', [
            'title' => 'Thêm mới học sinh',
            'name' => $getName
        ]);
    }
    public function addStudentPort(Request $request)
    {

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
            $student->image = $file_name;
        }
        if (!preg_match('/^[0-9]{8}$/', $request->mssv)) {
            return back()->withErrors('Mã SV phải là 8 số');
        }
        $isExist = Student::where('mssv', $request->mssv)->exists();
        if ($isExist) {
            return back()->withErrors('Mã SV phải không được trùng nhau');
        }

        $user->save();
        $userId = $user->id;
        $student->user_id = $userId;
        $student->save();

        return redirect()->back()->with('success', 'Thêm học sinh thành công');
    }
    public function editStudent($id)
    {
        $newImage = '';
        $student = Student::find($id);
        $user = User::where('id', $student->user_id)->first();
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        return view('admin.student.edit', [
            'title' => 'Chỉnh sửa học sinh' . $student->name,
            'newImage' => $newImage,
            'student' => $student,
            'user' => $user,
            'name' => $getName

        ]);
    }
    public function editStudentPort(Request $request, $id)
    {
        $newImage = '';
        $student = Student::find($id);
        $user = User::where('id', $student->user_id)->first();
        $user->email =  $request->email;
        $student->mssv =  $request->mssv;
        $student->name = $request->name;
        $student->class = $request->class;
        $student->gender = $request->gender;
        $student->telephone = $request->telephone;
        $oldImage = $student->image;

        if ($request->has('image')) {
            $newfile = $request->image;

            $ext = $request->image->extension();
            $file_name = time() . '-' . 'avatar' . '.' . $ext;
            $newImage = $file_name;
            $newfile->move(public_path('avatar'), $file_name);
            $student->image = $newImage;
        } else {
            $student->image = $oldImage;
        }
        $student->save();
        $user->save();
        return redirect('/admin/student/list')->with(Session::flash('success', 'Cập nhật thành công '));
    }
    public function destroyStudent(string $user_id)
    {
        $student = Student::where('user_id', $user_id);
        $user = User::where('id', $user_id);
        $student->delete();
        $user->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }
    public function searchStudent(Request $request)
    {
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $nameSR = $request->input('nameSR');
        $classSR = $request->input('classSR');
        $genderSR = $request->input('genderSR');
        $mssvSR = $request->input('mssvSR');
        $query = Student::query()->orderBy('mssv')
            ->select('students.*');

        if (!empty($nameSR)) {
            $query->where('name', 'LIKE', "%$nameSR%");
        }
        if ($genderSR !== null) {
            $query->where('gender', $genderSR);
        }
        if (!empty($mssvSR)) {
            $query->where('mssv', 'LIKE', "%$mssvSR%");
        }
        if (!empty($classSR)) {
            $query->where('class', 'LIKE', "%$classSR%");
        }
        $student = $query->paginate(5);
        return view(
            'admin.student.list',
            [
                'title' => 'Thêm danh mục mới',
                'formattedDateTime' => $formattedDateTime,
                'name' => $getName,
                'students' => $student,
                'nameSR' => $nameSR,
                'classSR' => $classSR,
                'genderSR' => $genderSR,
                'mssvSR' => $mssvSR
            ]
        );
    }
    public function importStudent(Request $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file'
            ],
        ]);
        Excel::import(new StudentImport, $request->file('import_file'));
        return redirect()->back()->with('status', 'Nhập thành công file excel');
    }
    public function showNotificationForm()
    {
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
       


        return view('admin.student.notification',[
            'formattedDateTime' => $formattedDateTime,
            'name' => $getName
        ]);
    }

    public function sendNotification(Request $request)
    {
        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        
        // Lấy thông tin admin
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();

        // Lấy tiêu đề và nội dung từ request
        $title = $request->input('title');
        $content = $request->input('content');
        $students = User::where('role','sv')->get();
        foreach ($students as $student) {
            Mail::to('thien541135@gmail.com')->send(new NotifyStudentMail($title, $content));
        }
       


        return redirect()->back()->with('success', 'Notification sent successfully.');
    }
}

