<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\GiangVienController;
use App\Http\Controllers\DepartmentController;
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
        Route::post('/department/add', [AdminController::class, 'createLecturerPost'])->name('createLecturer');
        Route::get('/', [AdminController::class, 'index']);
        Route::get('/lecturer/add', [AdminController::class, 'createLecturer'])->name('createLecturer');
        Route::post('/lecturer/add', [AdminController::class, 'createLecturerPost'])->name('createLecturer');
        Route::get('/lecturer/edit/{id}', [AdminController::class, 'updateLecturer'])->name('updateLecturer');
        Route::put('/lecturer/edit/{id}', [AdminController::class, 'updateLecturerPost'])->name('updateLecturer');
        Route::get('/lecturer/destroy/{user_id}', [AdminController::class, 'destroyLecturer'])->name('destroyLecturer');
    });
    Route::prefix('admin/department')->group(function () {
        Route::get('/home', [DepartmentController::class, 'homeDepartment']);
        Route::get('/add', [DepartmentController::class, 'addDepartment'])->name('addDepartment');
        Route::post('/add', [DepartmentController::class, 'addDepartmentPort'])->name('addDepartment');
        Route::get('/edit/{id}', [DepartmentController::class, 'editDepartment'])->name('editDepartment');
        Route::post('/edit/{id}', [DepartmentController::class, 'editDepartmentPort'])->name('editDepartment');
        Route::delete('/destroy', [DepartmentController::class, 'deleteDepartment']);
    });
    Route::prefix('admin/student')->group(function () {
        Route::get('/home', [DepartmentController::class, 'homeDepartment']);
        Route::get('/add', [DepartmentController::class, 'addDepartment'])->name('addDepartment');
        Route::post('/add', [DepartmentController::class, 'addDepartmentPort'])->name('addDepartment');
        Route::get('/edit/{id}', [DepartmentController::class, 'editDepartment'])->name('editDepartment');
        Route::post('/edit/{id}', [DepartmentController::class, 'editDepartmentPort'])->name('editDepartment');
        Route::delete('/destroy', [DepartmentController::class, 'deleteDepartment']);
    });
    #Upload
    Route::post('upload/services', [UploadController::class, 'store']);
});
Route::middleware(['RoleGiangVien', 'auth'])->group(function () {
    //Route::get('/lecturer', [GiangVienController::class, 'index']);
});
Route::middleware(['RoleSinhVien', 'auth'])->group(function () {
    //Route::get('/student', [SinhVienController::class, 'index']);
});
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
