<?php

namespace App\Imports;

use App\Models\Lecturer;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LecturersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        dd(Hash::make($row[1]));
        $department = Department::where('department_id',$row[7])->first();
        $user = User::create([
            'email' => $row[0],
            'password' => Hash::make($row[1]),
            'role' => 'gv',
        ]);
        
        return new Lecturer([
            'msgv' => $row[2],
            'name' => $row[3],
            'degree' => $row[4],
            'gender' => $row[5],
            'image' => $row[6],
            'department_id' => $department->department_id,
            'telephone' => $row[8],
            'user_id' => $user->id,
        ]);
    }
}
