<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Student;

class StudentRegisterController extends Controller
{
    public function index(){
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Student::where('user_id', $getID)->first();
        return view('student.index',[
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
        ]);
    }
}
