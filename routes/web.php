<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\Lecturer\LecturerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\Student\StudentRegisterController;
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
    Route::prefix('admin/proposal')->group(function () {
        Route::get('/listProposal', [ProposalController::class, 'listProposal']);
        Route::get('/approveProposal/{id}', [ProposalController::class, 'approveProposal'])->name('approveProposal');
        Route::post('/approveProposal/{id}', [ProposalController::class, 'approveProposalPort'])->name('approveProposal');
        Route::get('/destroyProposal/{id}', [ProposalController::class, 'destroyProposalAdmin'])->name('destroyProposalAdmin');
        Route::get('/detail/{id}', [ProposalController::class, 'detailPorposal'])->name('detailPorposal');
        Route::get('/searchProposal', [ProposalController::class, 'searchProposal'])->name('searchProposal');
    });

});
Route::middleware(['RoleGiangVien', 'auth'])->group(function () {
    Route::prefix('lecturer')->group(function () {
        Route::get('/', [LecturerController::class, 'index']);
        Route::get('/profile', [LecturerController::class, 'profile']);
        Route::get('/proposal/add', [LecturerController::class, 'createPorposal'])->name('createPorposal');
        Route::post('/proposal/add', [LecturerController::class, 'createPorposalPort'])->name('createPorposal');
        Route::get('/proposal/edit/{id}', [LecturerController::class, 'updateProposal'])->name('updateProposal');
        Route::put('/proposal/edit/{id}', [LecturerController::class, 'updateProposalPost'])->name('updateProposal');
        Route::get('/proposal/destroy/{id}', [LecturerController::class, 'destroyProposal'])->name('destroyProposal');
        Route::get('/proposal/detail/{id}', [LecturerController::class, 'detailPorposal'])->name('detailPorposal');
        Route::get('/proposal/search', [LecturerController::class, 'searchProposal'])->name('searchProposal');
    });
});
Route::middleware(['RoleSinhVien', 'auth'])->group(function () {
    Route::prefix('student')->group(function (){
        Route::get('/', [StudentRegisterController::class, 'index']);
    });
    
});
    #Upload
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
