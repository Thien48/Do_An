<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\Lecturer\LecturerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UploadController;
use PHPUnit\Framework\Attributes\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dangKi', [AuthController::class, 'register'])->name('register');
Route::post('/dangKi', [AuthController::class, 'registerPost'])->name('register');
Route::get('/dangNhap', [AuthController::class, 'login'])->name('login');
Route::post('/dangNhap', [AuthController::class, 'loginPost'])->name('login');

Route::middleware(['RoleAdmin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::get('/lecturer/add', [AdminController::class, 'createLecturer'])->name('createLecturer');
        Route::post('/lecturer/add', [AdminController::class, 'createLecturerPost'])->name('createLecturer');
        Route::get('/lecturer/edit/{id}', [AdminController::class, 'updateLecturer'])->name('updateLecturer');
        Route::put('/lecturer/edit/{id}', [AdminController::class, 'updateLecturerPost'])->name('updateLecturer');
        Route::get('/lecturer/destroy/{user_id}', [AdminController::class, 'destroyLecturer'])->name('destroyLecturer');
        Route::get('/lecturer/search', [AdminController::class, 'search'])->name('lecturer.search');
       
    });
    Route::prefix('admin/department')->group(function () {
        Route::get('/home', [DepartmentController::class, 'homeDepartment']);
        Route::get('/add', [DepartmentController::class, 'addDepartment'])->name('addDepartment');
        Route::post('/add', [DepartmentController::class, 'addDepartmentPort'])->name('addDepartment');
        Route::get('/edit/{id}', [DepartmentController::class, 'editDepartment'])->name('editDepartment');
        Route::post('/edit/{id}', [DepartmentController::class, 'editDepartmentPort'])->name('editDepartment');
        Route::delete('/destroy', [DepartmentController::class, 'deleteDepartment']);
    });
    Route::prefix('admin/subject')->group(function () {
        Route::get('/home', [SubjectController::class, 'homeSubject']);
        Route::get('/add', [SubjectController::class, 'addSubject'])->name('addSubject');
        Route::post('/add', [SubjectController::class, 'addSubjectPort'])->name('addSubject');
        Route::get('/edit/{id}', [SubjectController::class, 'updateSubject'])->name('updateSubject');
        Route::post('/edit/{id}', [SubjectController::class, 'updateSubjectPost'])->name('updateSubject');
        Route::get('/destroy/{id}', [SubjectController::class, 'destroySubject'])->name('destroySubject');
        
    });
    Route::prefix('admin/student')->group(function () {
        Route::get('/list', [StudentController::class, 'index']);
        Route::get('/add', [StudentController::class, 'addStudent'])->name('addStudent');
        Route::post('/add', [StudentController::class, 'addStudentPort'])->name('addStudent');
        Route::get('/edit/{id}', [StudentController::class, 'editStudent'])->name('editStudent');
        Route::post('/edit/{id}', [StudentController::class, 'editStudentPort'])->name('editStudent');
        Route::get('/destroy/{user_id}', [StudentController::class, 'destroyStudent'])->name('destroyStudent');
        Route::get('/search', [StudentController::class, 'searchStudent'])->name('searchStudent');
    });

});
Route::middleware(['RoleGiangVien', 'auth'])->group(function () {
    Route::prefix('lecturer')->group(function () {
        Route::get('/', [LecturerController::class, 'index']);
        Route::get('/propsal/add', [LecturerController::class, 'createPropsal'])->name('createPropsal');
        Route::post('/propsal/add', [LecturerController::class, 'createPropsalPost'])->name('createPropsal');
        Route::get('/propsal/edit/{id}', [LecturerController::class, 'updatePropsal'])->name('updatePropsal');
        Route::put('/propsal/edit/{id}', [LecturerController::class, 'updatePropsalPost'])->name('updatePropsal');
        Route::get('/propsal/destroy/{id}', [LecturerController::class, 'destroyPropsal'])->name('destroyPropsal');
    });
});
Route::middleware(['RoleSinhVien', 'auth'])->group(function () {
    //Route::get('/student', [SinhVienController::class, 'index']);
});
    #Upload
    Route::post('upload/services', [UploadController::class, 'store']);
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
