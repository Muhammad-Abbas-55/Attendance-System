<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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


Route::get('', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register', [AuthController::class, 'store']);

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('profiles/{profile}/edit', [AuthController::class, 'edit'])->name('profiles.edit');

Route::put('profiles/{profile}', [AuthController::class, 'update'])->name('profiles.update');


/*
|--------------------------------------------------------------------------
| Attendance Routes
|--------------------------------------------------------------------------
*/

Route::get('/attendances_index',[AttendanceController::class, 'index'])->name('attendances.index');

Route::get('/attendances_create',[AttendanceController::class, 'create'])->name('attendances.create');

Route::get('/attendances/{id}',[AttendanceController::class, 'show'])->name('attendances.show');

Route::get('/attendances/{id}/edit',[AttendanceController::class, 'edit'])->name('attendances.edit');

Route::put('attendances/{id}', [AttendanceController::class, 'update'])->name('attendances.update');

Route::get('attendances/delete/{id}', [AttendanceController::class, 'destroy'])->name('attendances.destroy');

Route::get('/leaves_create',[AttendanceController::class, 'leave_create'])->name('leaves.create');

Route::post('/leaves',[AttendanceController::class, 'leave_store'])->name('leaves.store');

Route::post('/attendances', [AttendanceController::class, 'store'])->name('attendances.store');


/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/

Route::get('/students',[StudentController::class, 'index'])->name('students.view');





