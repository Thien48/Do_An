<?php

namespace App\Http\Controllers;

use App\Http\Services\Department\DepartmentService;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\Menu\CreateFormRequest;

class DepartmentController extends Controller
{
    //
    protected $departmentService;
    public function __construct(DepartmentService $departmentService ){
        $this->departmentService = $departmentService;
    }
    public function homeDepartment()
    {
        $now = Carbon::now();
        // Định dạng theo định dạng chuẩn của PHP
        $formattedDateTime = $now->format('d-m-Y');
        $department = Department::all();
        return view(
            'admin.department.home',
            [
                'title' => 'Trang danh sách Bộ Môn',
                'departments' => $department,
                'formattedDateTime' => $formattedDateTime,
            ]
        );
    }
    public function addDepartment()
    {
        $getID = Auth::user()->id;
        $getName = Lecturer::where('user_id', $getID)->first();
        return view('admin.department.add',[
            'title' => 'Thêm mới bộ môn',
            'name' => $getName
        ]);
    }
    public function addDepartmentPort(CreateFormRequest $request)
    {
        $resual = $this->departmentService->create($request);
        return redirect()->back()->with('success', 'Thêm bộ môn thành công');
    }
    public function editDepartment(Department $id){
        return view('admin.department.edit',[
            'title' => 'Chỉnh sửa bộ môn',
            'id' => $id,
            'department' => $this->departmentService->getAll(),
        ]);
    }
    public function editDepartmentPort(Department $id, CreateFormRequest $request){
        $this->departmentService->update($request, $id);
        return redirect('/admin/department/home');
    }
    public function deleteDepartment($id){
        $deparment = Department::find($id);
        $deparment->delete();
        return back()->with('success','Xóa thành công');
    }
}
