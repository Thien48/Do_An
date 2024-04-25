<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Lecturer\LecturerService;
use Carbon\Carbon;


class LecturerController extends Controller
{
    //
    public function index(){
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        return view('lecturer.index', [
            'formattedDateTime' => $formattedDateTime,
            'name' =>  $getName,
        ]);
    }
}
