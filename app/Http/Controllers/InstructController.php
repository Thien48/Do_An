<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Instruction;
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

        $instruct = Instruction::join('students', 'instructions.student_id', '=', 'students.id')
        ->join('lecturers', 'instructions.lecturer_id', '=', 'lecturers.id')
        ->join('topics', 'instructions.topic_id', '=', 'topics.id')
        ->join('topic_proposals', 'topics.proposal_id', '=', 'topic_proposals.id')
        ->join('subject_types', 'topic_proposals.subject_id', '=', 'subject_types.id')
        ->select('lecturers.name as name_lecturer','topic_proposals.*', 'topics.*', 'lecturers.*', 'instructions.*', 'students.*', 'subject_types.*')
        ->paginate(5);

        return view(
            'admin.instruct.listInstruct',
            [
                'title' => 'Thêm danh mục mới',
                'formattedDateTime' => $formattedDateTime,
                'instruct' =>$instruct
            ],
        );
    }
    public function exportIntructDataExport()
    {
        return Excel::download(new IntructDataExport, 'danhsachSinhVienDkDeTai.xlsx');
    }
}
