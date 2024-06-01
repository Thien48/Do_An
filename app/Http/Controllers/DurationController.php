<?php

namespace App\Http\Controllers;

use App\Models\Duration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class DurationController extends Controller
{
    public function indexDuration()
    {
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $duration = Duration::all();
        return view(
            'admin.duration.indexDuration',
            [
                'title' => 'Thời gian',
                'formattedDateTime' => $formattedDateTime,
                'name' => $getName,
                'duration' => $duration,
            ],
        );
    }
    public function editDuration($id){
        $now = Carbon::now();
        $formattedDateTime = $now->format('d-m-Y');
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        $duration =  Duration::find($id);

        return view(
            'admin.duration.editDuration',
            [
                'title' => 'Tham số',
                'formattedDateTime' => $formattedDateTime,
                'name' => $getName,
                'duration' => $duration,
            ],
        );
    }
    public function editDurationPost($id, Request $request)
    {
        $rules = [
            'registration_start_date' => 'required|date_format:H:i:s d-m-Y',
            'registration_end_date' => 'required|date_format:H:i:s d-m-Y',
            'proposed_start_date' => 'required|date_format:H:i:s d-m-Y',
            'proposed_end_date' => 'required|date_format:H:i:s d-m-Y',
            'instruct_start_date' => 'required|date_format:H:i:s d-m-Y',
            'instruct_end_date' => 'required|date_format:H:i:s d-m-Y',
        ];

        $messages = [
            'date_format' => 'Định dạng ngày giờ không hợp lệ(Giờ:Phút:Giây Ngày-Tháng-Năm).Vui lòng nhập lại !!!',
        ];

        try {
            $this->validate($request, $rules, $messages);

            $duration = Duration::find($id);

            $duration->registration_start_date = Carbon::createFromFormat('H:i:s d-m-Y', $request->registration_start_date)->format('Y-m-d H:i:s');
            $duration->registration_end_date = Carbon::createFromFormat('H:i:s d-m-Y', $request->registration_end_date)->format('Y-m-d H:i:s');
            $duration->proposed_start_date = Carbon::createFromFormat('H:i:s d-m-Y', $request->proposed_start_date)->format('Y-m-d H:i:s');
            $duration->proposed_end_date = Carbon::createFromFormat('H:i:s d-m-Y', $request->proposed_end_date)->format('Y-m-d H:i:s');
            $duration->instruct_start_date = Carbon::createFromFormat('H:i:s d-m-Y', $request->instruct_start_date)->format('Y-m-d H:i:s');
            $duration->instruct_end_date = Carbon::createFromFormat('H:i:s d-m-Y', $request->instruct_end_date)->format('Y-m-d H:i:s');

            $duration->save();

            return redirect('admin/duration/')->with('success', 'Cập nhật thành công');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }
    }
}
