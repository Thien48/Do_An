<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Instruct;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Lecturer\LecturerService;
use Carbon\Carbon;
use App\Exports\IntructDataExport;
use Maatwebsite\Excel\Facades\Excel;

class InstructController extends Controller
{
    public function listInstruct(){
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();

        $instruct = Instruct::join('students', 'instructs.student_id', '=', 'students.id')
        ->join('lecturers', 'instructs.lecturer_id', '=', 'lecturers.id')
        ->join('topics', 'instructs.topic_id', '=', 'topics.id')
        ->join('proposal_form', 'topics.proposal_id', '=', 'proposal_form.id')
        ->join('subjects', 'proposal_form.subject_id', '=', 'subjects.id')
        ->select('lecturers.name as name_lecturer','proposal_form.*', 'topics.*', 'lecturers.*', 'instructs.*', 'students.*', 'subjects.*')
        ->paginate(5);

        return view(
            'admin.instruct.listInstruct',
            [
                'title' => 'Thêm danh mục mới',
                'formattedDateTime' => $formattedDateTime,
                'name' => $getName,
                'instruct' =>$instruct
            ],
        );
    }
    public function exportIntructDataExport()
    {
        return Excel::download(new IntructDataExport, 'danhsach.xlsx');
    }
}
