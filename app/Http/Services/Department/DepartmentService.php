<?php

namespace App\Http\Services\Department;

use App\Models\Department;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DepartmentService{
    public function getAll(){
        return Department::orderByDesc('id')->paginate(20);
    }
    public function create($request){
        try{
            Department::create([
                'name_department' => (string)$request->input('name_department')
            ]);
            back()->with(Session::flash('susses','Tạo bộ môn thành công'));
        }catch(\Exception $err){
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true ;
    }
    public function update($request, $id){

        $id->name_department= (string) $request->input('name_department');
        $id->save();
        Session::flash('success', 'Cập nhật thành công Bộ Môn');
        return true;
    }
    public function delete($request){
        $department = Department::where('id', $request->input('id'))->first();
        if($department){
            return Department::where('id',$request->input('id'))->delete();
        }
        return false;
    }
}