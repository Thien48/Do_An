<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Proposal;
use App\Models\Lecturer;
use App\Models\Parameter;
use App\Models\User;
use App\Models\Duration;

use App\Models\Subjects;
use Carbon\Carbon;



class LecturerController extends Controller
{
    //
    public function index()
    {
        $now = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');;
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $subjectOTP = Subjects::all();
        $registrationStartTime = Duration::first()->proposed_start_date;
        $registrationEndTime =Duration::first()->proposed_end_date;
        $proposal = Proposal::join('subjects', 'proposal_form.subject_id', '=', 'subjects.id')
                ->select('proposal_form.id as proposal_form_id', 'subjects.id as subjects_id', 'proposal_form.*', 'subjects.*')
                ->where('lecturer_id',$getName->id)
                ->paginate(5);
        return view('lecturer.index', [
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
            'now' =>$now,
            'proposal' => $proposal,
            'subjectOTP' => $subjectOTP,
            'registrationStartTime' => $registrationStartTime,
            'registrationEndTime' => $registrationEndTime,
        ]);
    }
    public function profileLecturer(){
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $user = User::where('id', $getID)->first();
        return view('lecturer.profileLecturer', [
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
            'user' =>$user,
        ]);
    }
    public function changePasswordLecturer(){
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        return view('lecturer.changePass',[
            'name' =>  $getName,
        ]);
    }
    public function changePasswordLecturerPort(Request $request){
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
    public function detailPorposal($id)
    {
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $proposal = Proposal::find($id);
        $subject = Subjects::where('id',$proposal->subject_id)->first();

        return view('lecturer.proposal.detail', [
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
            'proposal' => $proposal,
            'subject' => $subject,
        ]);
    }
    public function createPorposal()
    {
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $subject = Subjects::all();

        return view('lecturer.proposal.add', [
            'subject' => $subject,
            'name' =>  $getName,
        ]);
    }
    public function createPorposalPort(Request $request)
    {
        $errors = [];
        $now = Carbon::now();

        $getID = Auth::user()->id;
        $getLecturerId = Lecturer::where('user_id', $getID)->first();
        $getLecturerId = Lecturer::where('user_id', $getID)->first();
        $countProposal = Proposal::where('lecturer_id', $getLecturerId->id)->where('subject_id', $request->subject_id)->count();

        if ($getLecturerId->degree == 'Thạc Sĩ') {
            $minProposalsThs = Parameter::where('name_parameters', 'Số lượng đề tài đối với thạc sĩ')->value('value');
            if ( $countProposal >= $minProposalsThs) {
                return redirect()->back()->with('error', 'Bạn đã đạt đến số lượng đề tài tối đa');
            }
        }

        if ($getLecturerId->degree == 'Tiến Sĩ') {
            $minProposalsTS = Parameter::where('name_parameters', 'Số lượng đề tài đối với tiến sĩ')->value('value');
            if ( $countProposal >= $minProposalsTS) {
                return redirect()->back()->with('error', 'Bạn đã đạt đến số lượng đề tài tối đa');
            }
        }
        $proposal  = new Proposal();
        $proposal->name_proposal = $request->input('name_proposal');
        $proposal->proposed_date = $now;
        $proposal->target = $request->input('target');
        $proposal->request = $request->input('request');
        $proposal->references = $request->input('references');
        $proposal->subject_id = $request->subject_id;
        $proposal->lecturer_id = $getLecturerId->id;
        $proposal->year =  $request->year;
        $proposal->status = 0;

        $proposal->save();
        return back()->with('success', 'Thêm thành công');
    }
    public function updateProposal($id)
    {
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $proposal = Proposal::find($id);
        $subject = Subjects::all();
        // dd($proposal->name);
        return view('lecturer.proposal.edit', [
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
            'proposal' => $proposal,
            'subject' =>$subject,
        ]);
    }
    public function updateProposalPost(Request $request, $id)
    {
        $now = Carbon::now();
        $proposal = Proposal::find($id);
        $proposal->proposed_date = $now;
        $proposal->name_proposal = $request->input('name_proposal');
        $proposal->target = $request->input('target');
        $proposal->request = $request->input('request');
        $proposal->references = $request->input('references');
        $proposal->subject_id = $request->subject_id;
        $proposal->year =  $request->year;
        $proposal->save();
        return redirect('/lecturer');
    }
    public function destroyProposal($id)
    {
        $proposal = Proposal::find($id);
        $proposal->delete();
        return redirect()->back()->with('success', 'Thành công xóa đề tài');
    }
    public function searchProposal(Request $request){
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $subjectOTP = Subjects::all();
        $getName = Lecturer::where('user_id', $getID)->first();
        $subject = Subjects::all();
      
        $subjectSR = $request->input('subjectSR');
        $nameSR = $request->input('nameSR');
        $query = Proposal::join('subjects', 'proposal_form.subject_id', '=', 'subjects.id')
        ->select('proposal_form.id as proposal_form_id', 'subjects.id as subjects_id', 'proposal_form.*', 'subjects.*');
        
        if (!empty($subjectSR)) {
            $query->where('subjects.id', $subjectSR);
        }
        if (!empty($nameSR)) {
            $query->where('proposal_form.name', 'LIKE', "%$nameSR%");
        }
        $proposal = $query->paginate(6);
        // dd($proposal->name);
        return view('lecturer.index', [
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
            'subjectSR' => $subjectSR,
            'nameSR' => $nameSR,
            'subject' =>$subject,
            'subjectOTP' => $subjectOTP,
            'proposal' => $proposal,
        ]);
    }
}
