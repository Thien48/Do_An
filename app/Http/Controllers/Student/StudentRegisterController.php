<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Services\Student\StudentService;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\Topic;
use App\Models\User;
use App\Models\Duration;
use App\Models\RegisterTopic;
use App\Models\Lecturer;
use App\Models\Subjects;


class StudentRegisterController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }
    public function studentUnregister($proposal_form_id)
    {

        $getID = Auth::user()->id;
        $getName = Student::where('user_id', $getID)->first();
        $topic = Topic::find($proposal_form_id);

        $registerTopic = RegisterTopic::where('topic_id', $proposal_form_id);
        $topic->status = 0;
        $topic->save();
        $registerTopic->delete();


        return back()->with('success', 'Hủy đăng kí thành công');
    }
    public function studentRegister($proposal_form_id)
    {
        $now = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $getID = Auth::user()->id;
        $getName = Student::where('user_id', $getID)->first();
        $proposal = Proposal::find($proposal_form_id);
        $topic = Topic::find($proposal_form_id);
        $registeredTopics = RegisterTopic::where('student_id', $getName->id)
            ->count();
        if ($registeredTopics > 0) {
            return back()->with('error', 'Bạn đã đăng kí đề tài!! Hủy đề tài để đăng kí đề tài khác');
        }
        $checkTopic = RegisterTopic::where('topic_id', $proposal_form_id)->first();

        if ($checkTopic) {
            return redirect()->back()->with('error', 'Đề tài này đã được đăng ký bởi một sinh viên khác.');
        }
        $registerTopic = new RegisterTopic();
        $registerTopic->student_id = $getName->id;
        $registerTopic->topic_id = $proposal_form_id;
        $registerTopic->registration_date = $now;
        $topic->status = 1;

        $topic->save();
        $registerTopic->save();

        return back()->with('success', 'Đăng kí thành công');
    }
    public function index()
    {
        $now = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $loggedInStudent  = Student::where('user_id', $getID)->first();

        $registeredTopics = RegisterTopic::where('student_id', $loggedInStudent->id)
            ->get();
        $hasRegisteredTopics = $registeredTopics->count() > 0;

        if ($hasRegisteredTopics) {

            $topic = Topic::join('proposal_form', 'topics.proposal_id', '=', 'proposal_form.id')
                ->join('lecturers', 'proposal_form.lecturer_id', '=', 'lecturers.id')
                ->join('subjects', 'proposal_form.subject_id', '=', 'subjects.id')
                ->select('proposal_form.id as proposal_form_id', 'lecturers.id as lecturer_id', 'subjects.id as subject_id', 'topics.id as topic_id',  'proposal_form.*', 'topics.*', 'lecturers.*', 'subjects.*')
                ->paginate(5);
        } else {

            // Other students

            $registeredTopicIds = $registeredTopics->pluck('topic_id');

            $topic = Topic::join('proposal_form', 'topics.proposal_id', '=', 'proposal_form.id')
                ->join('lecturers', 'proposal_form.lecturer_id', '=', 'lecturers.id')
                ->join('subjects', 'proposal_form.subject_id', '=', 'subjects.id')
                ->select('proposal_form.id as proposal_form_id', 'lecturers.id as lecturer_id', 'subjects.id as subject_id', 'topics.id as topic_id',  'proposal_form.*', 'topics.*', 'lecturers.*', 'subjects.*')
                ->whereNotIn('topics.id', $registeredTopicIds)
                ->paginate(5);
        }

        $proposed_start_date = Duration::first()->proposed_start_date;
        $proposed_end_date = Duration::first()->proposed_end_date;


        return view('student.index', [
            'formattedDateTime' => $formattedDateTime,
            'now' => $now,
            'name' =>  $loggedInStudent,
            'topic' => $topic,
            'proposed_start_date' => $proposed_start_date,
            'proposed_end_date' => $proposed_end_date,
            'registeredTopics' => $registeredTopics,
        ]);
    }
    public function profileStudent()
    {
        $getID = Auth::user()->id;
        $student = Student::where('user_id', $getID)->first();
        $user = User::where('id', $getID)->first();
        return view('student.profileStudent', [
            'name' => $student,
            'user' => $user,
        ]);
    }
    public function changePasswordStudent()
    {
        $getID = Auth::user()->id;
        $getName = Student::where('user_id', $getID)->first();
        return view('student.changePass', [
            'name' =>  $getName,
        ]);
    }
    public function changePasswordStudentPort(Request $request)
    {
        $getID = Auth::user()->id;
        $user = User::find($getID);
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác.']);
        }
        // Kiểm tra mật khẩu mới và xác nhận mật khẩu mới khớp nhau
        if ($request->new_password !== $request->confirm_password) {
            return redirect()->back()->withErrors(['confirm_password' => 'Mật khẩu mới và xác nhận mật khẩu mới không khớp.']);
        }
        // Cập nhật mật khẩu mới cho người dùng
        $user->password = Hash::make($request->new_password);
        $user->save();
        // Chuyển hướng người dùng đến trang thành công hoặc thông báo thành công
        return back()->with('success', 'Đổi mật khẩu thành công.');
    }
    public function detailPorposalStudent($id)
    {
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Student::where('user_id', $getID)->first();
        $proposal = Proposal::find($id);
        $subject = Subjects::where('id', $proposal->subject_id)->first();

        return view('student.proposal.detailProposal', [
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
            'proposal' => $proposal,
            'subject' => $subject,
        ]);
    }
}
