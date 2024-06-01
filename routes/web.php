<?php

use App\Http\Controllers\ParametersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\Lecturer\LecturerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\DurationController;
use App\Http\Controllers\InstructController;
use App\Http\Controllers\Student\StudentRegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


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
    return view('auth.dangNhap');
});

Route::get('/admin/register', [AdminController::class, 'showRegistrationForm'])->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register.post');
Route::get('/dangKi', [AuthController::class, 'showStudentRegisterForm'])->name('student.register');
Route::post('/dangKi', [AuthController::class, 'createStudent'])->name('student.register.post');
Route::get('/dangNhap', [AuthController::class, 'login'])->name('login');
Route::post('/dangNhap', [AuthController::class, 'loginPost'])->name('login');
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

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
    Route::prefix('admin/parameters')->group(function () {
        Route::get('/', [ParametersController::class, 'index']);
        Route::get('/edit/{id}', [ParametersController::class, 'editParameters'])->name('editParameters');
        Route::PUT('/edit/{id}', [ParametersController::class, 'editParametersPost'])->name('editParameters');
    });
    Route::prefix('admin/duration')->group(function () {
        Route::get('/', [DurationController::class, 'indexDuration']);
        Route::get('/edit/{id}', [DurationController::class, 'editDuration'])->name('editDuration');
        Route::PUT('/edit/{id}', [DurationController::class, 'editDurationPost'])->name('editDuration');
    });
    Route::prefix('admin/department')->group(function () {
        Route::get('/home', [DepartmentController::class, 'homeDepartment']);
        Route::get('/add', [DepartmentController::class, 'addDepartment'])->name('addDepartment');
        Route::post('/add', [DepartmentController::class, 'addDepartmentPort'])->name('addDepartment');
        Route::get('/edit/{id}', [DepartmentController::class, 'editDepartment'])->name('editDepartment');
        Route::post('/edit/{id}', [DepartmentController::class, 'editDepartmentPort'])->name('editDepartment');
        Route::get('/destroy/{id}', [DepartmentController::class, 'deleteDepartment'])->name('deleteDepartment');
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
        Route::post('/import', [StudentController::class, 'importStudent'])->name('importStudent');
        // Route::get('/test-email',[StudentController::class, 'testMail'])->name('testMail');
        Route::get('/send-notification', [StudentController::class, 'showNotificationForm'])->name('send.notification');
        Route::post('/send-notification', [StudentController::class, 'sendNotification'])->name('send.notification');
    });
    Route::prefix('admin/proposal')->group(function () {
        Route::get('/listProposal', [ProposalController::class, 'listProposal']);
        Route::get('/approveProposal/{id}', [ProposalController::class, 'approveProposal'])->name('approveProposal');
        Route::post('/feedback/{id}', [ProposalController::class, 'feedbackProposalPort'])->name('feedbackProposalPort');
        Route::get('/detail/{id}', [ProposalController::class, 'detailPorposal'])->name('detailPorposal');
        Route::get('/searchProposal', [ProposalController::class, 'searchProposal'])->name('searchProposal');
    });
    Route::prefix('admin/instruct')->group(function () {
        Route::get('/listInstruct', [InstructController::class, 'listInstruct']);
        Route::get('/export-registered-topics', [InstructController::class, 'exportIntructDataExport'])->name('exportIntructDataExport');
    });
});
Route::middleware(['RoleGiangVien', 'auth'])->group(function () {
    Route::prefix('lecturer')->group(function () {
        Route::get('/', [LecturerController::class, 'index']);
        Route::get('/profile', [LecturerController::class, 'profileLecturer'])->name('profileLecturer');
        Route::get('/updateProfileLecturer', [LecturerController::class, 'updateProfileLecturer'])->name('updateProfileLecturer');
        Route::post('/updateProfileLecturer', [LecturerController::class, 'updateProfileLecturerPort'])->name('updateProfileLecturer');
        Route::get('/change-password', [LecturerController::class, 'changePasswordLecturer'])->name('changePasswordLecturer');
        Route::post('/change-password', [LecturerController::class, 'changePasswordLecturerPort'])->name('changePasswordLecturer');
        Route::get('/proposal/add', [LecturerController::class, 'createPorposal'])->name('createPorposal');
        Route::post('/proposal/add', [LecturerController::class, 'createPorposalPort'])->name('createPorposal');
        Route::get('/proposal/edit/{id}', [LecturerController::class, 'updateProposal'])->name('updateProposal');
        Route::put('/proposal/edit/{id}', [LecturerController::class, 'updateProposalPost'])->name('updateProposal');
        Route::get('/proposal/destroy/{id}', [LecturerController::class, 'destroyProposal'])->name('destroyProposal');
        Route::get('/proposal/detail/{id}', [LecturerController::class, 'detailPorposal'])->name('detailPorposal');
        Route::get('/proposal/listProposal', [LecturerController::class, 'listProposal']);
        Route::get('/proposal/search', [LecturerController::class, 'searchProposal'])->name('searchProposal');
        Route::get('/proposal/searchListProposal', [LecturerController::class, 'searchListProposal'])->name('searchProposalListProposal');
    });
});
Route::middleware(['RoleSinhVien', 'auth'])->group(function () {
    Route::prefix('student')->group(function () {
        Route::get('/', [StudentRegisterController::class, 'index']);
        Route::get('/profile', [StudentRegisterController::class, 'profileStudent'])->name('profileStudent');
        
        Route::get('/updateProfileStudent', [StudentRegisterController::class, 'updateProfileStudent'])->name('updateProfileStudent');
        Route::post('/updateProfileStudent', [StudentRegisterController::class, 'updateProfileStudentPort'])->name('updateProfileStudent');
        Route::get('/change-password', [StudentRegisterController::class, 'changePasswordStudent'])->name('changePasswordStudent');
        Route::post('/change-password', [StudentRegisterController::class, 'changePasswordStudentPort'])->name('changePasswordStudent');
        Route::get('/register/{topic_id}', [StudentRegisterController::class, 'studentRegister'])->name('studentRegister');
        Route::get('/unregister/{topic_id}', [StudentRegisterController::class, 'studentUnregister'])->name('studentUnregister');
        Route::get('/proposal/detail/{id}', [StudentRegisterController::class, 'detailPorposalStudent'])->name('detailPorposalStudent');
    });
});
#Upload
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
