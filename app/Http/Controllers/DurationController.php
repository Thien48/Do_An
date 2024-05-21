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
    public function editDurationPost($id, Request $request){
        $duration =  Duration::find($id);

        $duration->registration_start_date = $request->registration_start_date;
        $duration->registration_end_date = $request->registration_end_date;
        $duration->proposed_start_date = $request->proposed_start_date;
        $duration->proposed_end_date = $request->proposed_end_date;
        
    
        $duration->save();
        return redirect('admin/duration/')->with('success', 'Cập nhập thành công');
    }
}
