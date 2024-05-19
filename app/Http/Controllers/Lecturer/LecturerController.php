<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Proposal;
use App\Models\Lecturer;

use App\Models\Subjects;
use Carbon\Carbon;



class LecturerController extends Controller
{
    //
    public function index()
    {
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $subjectOTP = Subjects::all();
        $proposal = Proposal::join('subjects', 'proposal_form.subject_id', '=', 'subjects.id')
                ->select('proposal_form.id as proposal_form_id', 'subjects.id as subjects_id', 'proposal_form.*', 'subjects.*')
                ->paginate(5);
        return view('lecturer.index', [
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
            'proposal' => $proposal,
            'subjectOTP' => $subjectOTP,
        ]);
    }
    public function profile(){
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();

        return view('lecturer.profile', [
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
        ]);
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
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getLecturerId = Lecturer::where('user_id', $getID)->first();

        $lecturerDegree = DB::table('lecturers')->where('id', $getLecturerId->id)->pluck('degree')->first();
        $countSubjectDoAn = Proposal::where('lecturer_id', $getLecturerId->id)->where('subject_id', $request->subject_id)->count();
        // if( $lecturerDegree == "Tiến Sĩ" && $countSubjectDoAn > 6){
        //     return back()->with(['error' => 'Đã đạt số lượng tối đa cho đồ án' ]);
        // }
        // if( $lecturerDegree == "Thạc Sĩ" && $countSubjectDoAn > 4){
        //     return back()->with(['error' => 'Đã đạt số lượng tối đa cho đồ án' ]);
        // }
       
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
