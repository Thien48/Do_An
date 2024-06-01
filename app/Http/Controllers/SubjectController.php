<?php

namespace App\Http\Controllers;

use App\Http\Services\Department\DepartmentService;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Models\SubjectType;
use App\Models\TopicType;
use Illuminate\Support\Facades\Session;

class SubjectController extends Controller
{
    public function homeSubject()
    {
        $now = Carbon::now();
        // Định dạng theo định dạng chuẩn của PHP
        $formattedDateTime = $now->format('d-m-Y');

        $subjects = SubjectType::all();
        return view(
            'admin.subject.home',
            [
                'title' => 'Trang danh sách đề tài',
                'formattedDateTime' => $formattedDateTime,
                'subjects' => $subjects,
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
        $subject = new SubjectType();
        $subject->name_subject = $request->name_subject;
        if($request->name_subject ==''){
            return back()->withErrors('Vui lòng nhập tên đề tài');
        }
        if (!$errors) {
            $subject->save();
        }

        return back()->with('success', 'Thêm thành công');
    }
    public function updateSubject( $id)
    {
        $subject = SubjectType::find($id);
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        return view('admin.subject.edit', [
            'title' => 'Chỉnh sửa Đề tài: ' . $subject->name_subject,
            'subjects' =>  $subject,
            'name' =>$getName
        ]);
    }
    public function updateSubjectPost(Request $request, $id)
    {
        $errors = [];
        $subject = SubjectType::find($id);
        $subject->name_subject = $request->name_subject;
        if($request->name_subject ==''){
            return back()->withErrors('Không để trống tên đề tài');
        }
        if (!$errors) {
            $subject->save();
        }
        return redirect('/admin/subject/home')->with('success', 'Cập nhập thành công');
    }
    public function destroySubject($id)
    {
        $subject = SubjectType::find($id);
        $subject->delete();
        return redirect()->back();
    }
}
