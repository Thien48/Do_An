<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UploadService
{
    public  function store($request){
        
        if($request->hasFile('image')){
            try{
                $name = $request->file('image')->getClientOriginalName();

                $pathFull =  'uploads/' .date("Y/m/d");
                $path = $request('image')->storeAs(
                    'public/' .$pathFull , $name
                );

                return  '/storage/' . $pathFull . '/' . $name;
            }catch(\Exception $error){
                return false;
            }

        }
    }
}
