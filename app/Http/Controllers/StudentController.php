<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    // protected $lecturerService;
    // public function __construct(StudentController $lecturerService)
    // {
    //     $this->lecturerService = $lecturerService;
    // }
    public function index()
    {

        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $students = Student::all();

        return view(
            'admin.student.list',
            [
                'title' => 'Thêm danh mục mới',
                'students' => $students,
                'formattedDateTime' => $formattedDateTime,
            ]
        );
    }
}
