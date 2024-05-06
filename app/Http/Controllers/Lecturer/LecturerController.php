<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Proposal;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Lecturer\LecturerService;
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
        $total  = DB::table('proposal_form')
        ->join('subjects', 'proposal_form.subject_id', '=', 'subjects.id')
        ->select('proposal_form.id as proposal_form_id', 'subjects.id as subjects_id', 'proposal_form.*', 'subjects.*')
        ->count();
        if ($total < 5) {
            $proposal = DB::table('proposal_form')
            ->join('subjects', 'proposal_form.subject_id', '=', 'subjects.id')
            ->select('proposal_form.id as proposal_form_id', 'subjects.id as subjects_id', 'proposal_form.*', 'subjects.*')
            ->get();
        } else {
            $proposal = DB::table('proposal_form')
            ->join('subjects', 'proposal_form.subject_id', '=', 'subjects.id')
            ->select('proposal_form.id as proposal_form_id', 'subjects.id as subjects_id', 'proposal_form.*', 'subjects.*')
            ->paginate(5);
        }

        // dd($subject);
        return view('lecturer.index', [
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
            'proposal' => $proposal,
        ]);
    }
    public function detailPorposal()
    {
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $proposal = Proposal::all();
        return view('lecturer.index', [
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
            'proposal' => $proposal,
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
        $proposal  = new Proposal();

        $proposal->name = $request->name;
        $proposal->proposed_date = $now;
        $proposal->introduce = $request->input('introduce');
        $proposal->target = $request->input('target');
        $proposal->request = $request->input('request');
        $proposal->references = $request->input('references');
        $proposal->subject_id = $request->subject_id;
        $proposal->lecturer_id = $getLecturerId->id;
        $proposal->year = $request->year;
        $proposal->status = 0;

        $proposal->save();
        return back()->with('success', 'Thêm thành công');
    }
    public function destroyProposal($id)
    {
        $proposal = Proposal::find($id);
        $proposal->delete();
        return redirect()->back()->with('success', 'Thành công xóa đề tài');
    }
}
