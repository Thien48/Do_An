<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Proposal;
use App\Models\Lecturer;
use App\Models\TopicProposal;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Lecturer\LecturerService;
use App\Models\SubjectType;
use App\Models\Topic;
use Carbon\Carbon;

class ProposalController extends Controller
{
    public function listProposal()
    {
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $subjectOTP = SubjectType::all();
        $proposal = TopicProposal::join('subject_types', 'topic_proposals.subject_id', '=', 'subject_types.id')
                ->join('lecturers', 'topic_proposals.lecturer_id', '=', 'lecturers.id')
                ->select('topic_proposals.id as proposal_form_id', 'subject_types.id as subjects_id', 'topic_proposals.*', 'subject_types.*', 'lecturers.*')
                ->paginate(5);
        return view('admin.proposal.suggestedList', [
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
            'proposal' => $proposal,
            'subjectOTP' => $subjectOTP,
        ]);
    }

    public function detailPorposal($id)
    {
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $proposal = TopicProposal::find($id);
        $subject = SubjectType::where('id',$proposal->subject_id)->first();
        $lecturer = Lecturer::where('id' , $proposal->lecturer_id)->first();

        return view('admin.proposal.detail', [
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
            'proposal' => $proposal,
            'subject' => $subject,
            'lecturer' => $lecturer
        ]);
    }
    public function approveProposal($proposal_form_id){
        $now = Carbon::now();
        $proposal = TopicProposal::find($proposal_form_id);
        $proposal->status = 1;
        $proposal->approval_date = $now;
        $proposal->save();
        $topic = new Topic();
        $topic->proposal_id = $proposal->id;
        $topic->status = 0;
        $topic->save();

        return redirect()->back()->with('success', 'Thành công duyệt đề tài');
    }
    public function feedbackProposalPort($proposal_form_id, Request $request)
    {
        $proposal = TopicProposal::find($proposal_form_id);
        $proposal->feedback = $request->feedback;
        $proposal->save();
        
        return redirect()->back()->with('success', 'Thêm góp ý thành công');
    }
}
