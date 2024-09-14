<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        if (Auth::check()) {
            $users = User::orderBy('created_at', 'DESC');
        
            if (Auth::user()->user_type === '0') {
                return view('student_dashboard', compact('users'));
            } 
            elseif (Auth::user()->user_type === '1') {
                return view('admin_dashboard', compact('users'));
            } 
        } else {
        $users = User::all(); 

            return view('main_dashboard', compact('users'))->with('error', 'Please log in to access the dashboard.');
        }
    }
}
