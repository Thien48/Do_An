<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\GiangVienController;

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

Route::middleware(['RoleAdmin','auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::get('/lecturer/add', [AdminController::class,'createLecturer'])->name('createLecturer');
        Route::post('/lecturer/add', [AdminController::class,'createLecturerPost'])->name('createLecturer');
        Route::put('/lecturer/{id}/edit', [AdminController::class,'updateLecturer'])->name('updateLecturer');
        
    });
    
    
});
Route::middleware(['RoleGiangVien','auth'])->group(function () {
    Route::get('/giangVien', [GiangVienController::class, 'index']);
    
});
Route::middleware(['RoleSinhVien','auth'])->group(function () {
    Route::get('/sinhVien', [SinhVienController::class, 'index']);
    
});
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');