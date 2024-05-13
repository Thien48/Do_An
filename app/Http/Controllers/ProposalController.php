<?php

namespace App\Http\Controllers;

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

class ProposalController extends Controller
{
    public function list()
    {
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $subjectOTP = Subjects::all();
        $proposal = Proposal::join('subjects', 'proposal_form.subject_id', '=', 'subjects.id')
                ->select('proposal_form.id as proposal_form_id', 'subjects.id as subjects_id', 'proposal_form.*', 'subjects.*')
                ->paginate(5);
        return view('admin.proposal.suggestedList', [
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
            'proposal' => $proposal,
            'subjectOTP' => $subjectOTP,
        ]);
    }
}
