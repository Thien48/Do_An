<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Lecturer\LecturerService;
use App\Models\Parameter;
use Carbon\Carbon;

class ParametersController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');

        $parameter = Parameter::all();

        return view(
            'admin.parameter.homeParameter',
            [
                'title' => 'Tham số',
                'formattedDateTime' => $formattedDateTime,
                'parameter' => $parameter,
            ],
        );
    }
    public function editParameters($id){
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');

        $parameter =  Parameter::find($id);
        
        return view(
            'admin.parameter.editParameter',
            [
                'title' => 'Tham số',
                'formattedDateTime' => $formattedDateTime,
                'parameter' => $parameter,
            ],
        );
    }
    public function editParametersPost($id, Request $request){
        $parameter =  Parameter::find($id);
        $parameter->value = $request->value;
        $parameter->save();
        return redirect('admin/parameters/')->with('success', 'Cập nhập thành công');
    }
}
