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

use App\Models\Department;
use App\Models\SubjectType;
use App\Models\TopicProposal;
use Carbon\Carbon;



class LecturerController extends Controller
{
    //
    public function index()
    {
        $now = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $formattedDateTime = $now->format('d-m-Y');
        

        $subjectOTP = SubjectType::all();
        $registrationStartTime = Duration::first()->proposed_start_date;
        $registrationEndTime =Duration::first()->proposed_end_date;

        $proposal = TopicProposal::join('subject_types', 'topic_proposals.subject_id', '=', 'subject_types.id')
                ->join('lecturers', 'topic_proposals.lecturer_id', '=', 'lecturers.id')
                ->select('topic_proposals.id as topic_proposal_id', 'subject_types.id as subjects_id', 'topic_proposals.*', 'subject_types.*')
                ->where('lecturer_id', Auth::user()->lecturer->id )
                ->paginate(10);
        return view('lecturer.index', [
            'formattedDateTime' => $formattedDateTime,
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
            'user' =>$user,
            'name' => $getName,
        ]);
    }
    public function updateProfileLecturer()
    {
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $departmentsOTP = Department::all();

        $newImage = '';

        return view('lecturer.updateProfileLecturer', [
            'name' =>  $getName,
            'newImage' => $newImage,
            'departmentsOTP' => $departmentsOTP
        ]);
    }
    public function updateProfileLecturerPort(Request $request)
    {
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $user = User::find($getID);
        $user->email = $request->email;
        $newImage = '';
        $getName->msgv = $request->msgv;
        $getName->name = $request->name;
        $getName->telephone = $request->telephone;
        $getName->degree = $request->degree;
        $getName->gender = $request->gender;
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
        if ($request->new_password !== $request->confirm_password) {
            return redirect()->back()->withErrors(['confirm_password' => 'Mật khẩu mới và xác nhận mật khẩu mới không khớp.']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('success', 'Đổi mật khẩu thành công.');
    }
    public function detailPorposal($id)
    {
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');

        $proposal = TopicProposal::find($id);
        $subject = SubjectType::where('id',$proposal->subject_id)->first();

        return view('lecturer.proposal.detail', [
            'formattedDateTime' => $formattedDateTime,
            'proposal' => $proposal,
            'subject' => $subject,
        ]);
    }
    public function createPorposal()
    {

        $subject = SubjectType::all();
        return view('lecturer.proposal.add', [
            'subject' => $subject,
        ]);
    }
    public function createPorposalPort(Request $request)
    {
        $errors = [];
        $now = Carbon::now();

        $getID = Auth::user()->id;
        $getLecturerId = Lecturer::where('user_id', $getID)->first();
        $getLecturerId = Lecturer::where('user_id', $getID)->first();
        $countProposal = TopicProposal::where('lecturer_id', $getLecturerId->id)->where('subject_id', $request->subject_id)->count();

        if ($getLecturerId->degree == 'Thạc Sĩ') {
            $minProposalsThs = Parameter::where('name_parameters', 'Số lượng đề tài tối đa đối với thạc sĩ')->value('value');
            if ( $countProposal >= $minProposalsThs) {
                return redirect()->back()->with('error', 'Bạn đã đạt đến số lượng đề tài tối đa');
            }
        }

        if ($getLecturerId->degree == 'Tiến Sĩ') {
            $minProposalsTS = Parameter::where('name_parameters', 'Số lượng đề tài tối đa đối với tiến sĩ')->value('value');
            if ( $countProposal >= $minProposalsTS) {
                return redirect()->back()->with('error', 'Bạn đã đạt đến số lượng đề tài tối đa');
            }
        }
        $proposal  = new TopicProposal();
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

        $proposal = TopicProposal::find($id);
        $subject = SubjectType::all();
        // dd($proposal->name);
        return view('lecturer.proposal.edit', [
            'formattedDateTime' => $formattedDateTime,
            'proposal' => $proposal,
            'subject' =>$subject,
        ]);
    }
    public function updateProposalPost(Request $request, $id)
    {
        $now = Carbon::now();
        $proposal = TopicProposal::find($id);
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
        $proposal = TopicProposal::find($id);
        $proposal->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }
    public function listProposal(){
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');

        $proposal = TopicProposal::join('subject_types', 'topic_proposals.subject_id', '=', 'subject_types.id')
                ->select('topic_proposals.id as topic_proposal_id', 'subject_types.id as subjects_id', 'topic_proposals.*', 'subject_types.*')
                ->paginate(7);

        $subjectOTP = SubjectType::all();
        $subject = SubjectType::all();
        $registrationStartTime = Duration::first()->proposed_start_date;
        $registrationEndTime =Duration::first()->proposed_end_date;

        return view('lecturer.proposal.listProposal',[
            'formattedDateTime' => $formattedDateTime,
            'proposal' => $proposal,
            'subjectOTP' => $subjectOTP,
            'subject' =>$subject,
            'registrationStartTime' => $registrationStartTime,
            'registrationEndTime' => $registrationEndTime
        ]);
    }
    public function searchProposal(Request $request){
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $subjectOTP = SubjectType::all();
       
        $subject = SubjectType::all();

        $registrationStartTime = Duration::first()->proposed_start_date;
        $registrationEndTime =Duration::first()->proposed_end_date;

        $subjectSR = $request->input('subjectSR');
        $nameSR = $request->input('nameSR');
        $query = TopicProposal::join('subject_types', 'topic_proposals.subject_id', '=', 'subject_types.id')
        ->select('topic_proposals.id as proposal_form_id', 'subject_types.id as subjects_id', 'topic_proposals.*', 'subject_types.*');
        
        if (!empty($subjectSR)) {
            $query->where('subject_types.id', $subjectSR);
        }
        if (!empty($nameSR)) {
            $query->where('topic_proposal.name_proposal', 'LIKE', "%$nameSR%");
        }
        $proposal = $query->paginate(7);
        // dd($proposal->name);
        return view('lecturer.index', [
            'now' => $now,
            'formattedDateTime' => $formattedDateTime,
            'subjectSR' => $subjectSR,
            'nameSR' => $nameSR,
            'subject' =>$subject,
            'subjectOTP' => $subjectOTP,
            'proposal' => $proposal,
            'registrationStartTime' => $registrationStartTime,
            'registrationEndTime' => $registrationEndTime
        ]);
    }
    public function searchListProposal(Request $request){
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $subjectOTP = SubjectType::all();


        $subject = SubjectType::all();
        $registrationStartTime = Duration::first()->proposed_start_date;
        $registrationEndTime =Duration::first()->proposed_end_date;

        $subjectSR = $request->input('subjectSR');
        $nameSR = $request->input('nameSR');
        $query = TopicProposal::join('subject_types', 'topic_proposals.subject_id', '=', 'subject_types.id')
        ->select('topic_proposals.id as proposal_form_id', 'subject_types.id as subjects_id', 'topic_proposals.*', 'subject_types.*');
        
        if (!empty($subjectSR)) {
            $query->where('subject_types.id', $subjectSR);
        }
        if (!empty($nameSR)) {
            $query->where('topic_proposals.name_proposal', 'LIKE', "%$nameSR%");
        }
        $proposal = $query->paginate(7);
        
        return view('lecturer.proposal.listProposal', [
            'formattedDateTime' => $formattedDateTime,
            'subjectSR' => $subjectSR,
            'nameSR' => $nameSR,
            'subject' =>$subject,
            'subjectOTP' => $subjectOTP,
            'proposal' => $proposal,
            'registrationStartTime' => $registrationStartTime,
            'registrationEndTime' => $registrationEndTime
        ]);
    }
}
