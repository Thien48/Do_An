<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Services\Student\StudentService;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\Topic;
use App\Models\User;
use App\Models\Duration;
use App\Models\RegisterTopic;
use App\Models\Subjects;
use App\Models\Instruction;
use App\Models\SubjectType;
use App\Models\TopicProposal;

class StudentRegisterController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }
    public function studentUnregister($topic_id)
    {

        $getID = Auth::user()->id;
        $getName = Student::where('user_id', $getID)->first();

        $registerTopic = RegisterTopic::where('topic_id', $topic_id);
        $registerTopic->delete();
        $intruction = Instruction::where('topic_id', $topic_id);
        $intruction->delete();

        return back()->with('success', 'Hủy đăng kí thành công');
    }
    public function studentRegister($topic_id)
    {
        $now = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $getID = Auth::user()->id;
        $getName = Student::where('user_id', $getID)->first();
        $topic = Topic::join('topic_proposals', 'topics.proposal_id', '=', 'topic_proposals.id')
            ->join('lecturers', 'topic_proposals.lecturer_id', '=', 'lecturers.id')
            ->join('subject_types', 'topic_proposals.subject_id', '=', 'subject_types.id')
            ->select('topic_proposals.id as topic_proposals_id', 'lecturers.id as lecturer_id', 'subject_types.id as subject_id', 'topics.id as topic_id',  'topic_proposals.*', 'topics.*', 'lecturers.*', 'subject_types.*')
            ->where('topics.id', $topic_id)
            ->first();
        $registeredTopics = RegisterTopic::where('student_id', $getName->id)
            ->count();
        if ($registeredTopics > 0) {
            return back()->with('error', 'Bạn đã đăng kí đề tài!! Hủy đề tài để đăng kí đề tài khác');
        }
        $checkTopic = RegisterTopic::where('topic_id', $topic_id)->first();

        if ($checkTopic) {
            return redirect()->back()->with('error', 'Đề tài này đã được đăng ký bởi một sinh viên khác.');
        }

        $registerTopic = new RegisterTopic();
        $registerTopic->student_id = $getName->id;
        $registerTopic->topic_id = $topic_id;
        $registerTopic->registration_date = $now;

        $registerTopic->save();

        $intruction = new Instruction();
        $intruction->lecturer_id = $topic->lecturer_id;
        $intruction->topic_id = $topic->topic_id;
        $intruction->student_id = $getName->id;
        $intruction->save();
        return back()->with('success', 'Đăng kí thành công');
    }
    public function index()
    {
        $now = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $formattedDateTime = $now->format('d-m-Y');

        $subjectOTP = SubjectType::all();

        $studentId = Auth::user()->student->id;
        $registeredTopics = RegisterTopic::where('student_id', $studentId)->get();

        $hasRegisteredTopic = $registeredTopics->isNotEmpty(); // Kiểm tra xem sinh viên đã đăng ký đề tài nào chưa

        $topic = Topic::join('topic_proposals', 'topics.proposal_id', '=', 'topic_proposals.id')
            ->join('lecturers', 'topic_proposals.lecturer_id', '=', 'lecturers.id')
            ->join('subject_types', 'topic_proposals.subject_id', '=', 'subject_types.id')
            ->select('topic_proposals.id as topic_proposal_id', 'lecturers.id as lecturer_id', 'subject_types.id as subject_id', 'topics.id as topic_id', 'topic_proposals.*', 'topics.*', 'lecturers.*', 'subject_types.*')
            ->paginate(5);

        $allRegisteredTopics = RegisterTopic::pluck('topic_id')->toArray(); // Lấy tất cả các topic_id đã được đăng ký

        $duration = Duration::first();
        $registration_start_date = $duration->registration_start_date;
        $registration_end_date = $duration->registration_end_date;
        $instruct_start_date = $duration->instruct_start_date;
        $instruct_end_date = $duration->instruct_end_date;

        $instruct = Instruction::where('student_id', $studentId)->first();

        return view('student.index', [
            'formattedDateTime' => $formattedDateTime,
            'now' => $now,
            'topic' => $topic,
            'registration_start_date' => $registration_start_date,
            'registration_end_date' => $registration_end_date,
            'instruct_start_date' => $instruct_start_date,
            'instruct_end_date' => $instruct_end_date,
            'registeredTopics' => $registeredTopics,
            'subjectOTP' => $subjectOTP,
            'instruct' => $instruct,
            'hasRegisteredTopic' => $hasRegisteredTopic, // Truyền biến vào view
            'allRegisteredTopics' => $allRegisteredTopics, // Truyền danh sách các đề tài đã được đăng ký vào view
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
            return redirect()->back()->withErrors(['confirm_password' => 'Mật khẩu mới và xác nhận của bạn không khớp']);
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
        $proposal = TopicProposal::find($id);
        $subject = SubjectType::where('id', $proposal->subject_id)->first();

        return view('student.proposal.detailProposal', [
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
            'proposal' => $proposal,
            'subject' => $subject,
        ]);
    }
    public function updateProfileStudent()
    {
        $getID = Auth::user()->id;
        $getName = Student::where('user_id', $getID)->first();
        $newImage = '';

        return view('student.updateProfileStudent', [
            'name' =>  $getName,
            'newImage' => $newImage,
        ]);
    }
    public function updateProfileStudentPort(Request $request)
    {
        $getID = Auth::user()->id;
        $getName = Student::where('user_id', $getID)->first();
        $user = User::find($getID);
        $user->email = $request->email;
        $newImage = '';
        $getName->name = $request->name;
        $getName->mssv = $request->mssv;
        $getName->class = $request->class;
        $getName->gender = $request->gender;
        $getName->telephone = $request->telephone;
        $oldImage = $getName->image;

        if ($request->has('image')) {
            $newfile = $request->image;
            $ext = $request->image->extension();
            $file_name = time() . '-' . 'avatar' . '.' . $ext;
            $newImage = $file_name;
            $newfile->move(public_path('avatar'), $file_name);
            $getName->image = $newImage;
        } else {
            $getName->image = $oldImage;
        }

        $user->save();
        $getName->save();

        return back()->with('success', 'Cập nhập thành công');
    }
}
