<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all();
        $users = User::all();

        return view('student.students_view', compact('attendances', 'users'));
    }
}
