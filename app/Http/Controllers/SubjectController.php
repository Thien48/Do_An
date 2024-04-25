<?php

namespace App\Http\Controllers;

use App\Http\Services\Department\DepartmentService;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Models\Subjects;
use Illuminate\Support\Facades\Session;

class SubjectController extends Controller
{
    public function homeSubject()
    {
        $now = Carbon::now();
        // Định dạng theo định dạng chuẩn của PHP
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $subjects = Subjects::all();
        return view(
            'admin.subject.home',
            [
                'title' => 'Trang danh sách đề tài',
                'formattedDateTime' => $formattedDateTime,
                'subjects' => $subjects,
                'name' => $getName
            ]
        );
    }
    public function addSubject()
    {
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        return view('admin.subject.add',[
            'title' => 'Thêm mới bộ môn',
            'name' => $getName
        ]);
    }
    public function addSubjectPort(Request $request)
    {
        $errors = [];
        $subject = new Subjects();
        $subject->subject_name = $request->subject_name;
        if($request->subject_name ==''){
            return back()->withErrors('Vui lòng nhập tên đề tài');
        }
        if (!$errors) {
            $subject->save();
        }

        return back()->with('success', 'Thêm thành công');
    }
    public function updateSubject( $id)
    {
        $subject = Subjects::find($id);
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        return view('admin.subject.edit', [
            'title' => 'Chỉnh sửa Đề tài: ' . $subject->subject_name,
            'subjects' =>  $subject,
            'name' =>$getName
        ]);
    }
    public function updateSubjectPost(Request $request, $id)
    {
        $errors = [];
        $subject = Subjects::find($id);
        $subject->subject_name = $request->subject_name;
        if($request->subject_name ==''){
            return back()->withErrors('Không để trống tên đề tài');
        }
        if (!$errors) {
            $subject->save();
        }
        return redirect('/admin/subject/home')->with('success', 'Cập nhập thành công');
    }
    public function destroySubject($id)
    {
        $subject = Subjects::find($id);
        $subject->delete();
        return redirect()->back();
    }
}
