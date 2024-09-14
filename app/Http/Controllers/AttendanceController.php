<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Attribute;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public function index()
    {
        $attendances = Attendance::all();
        $users = User::all();
        return view('attendance.attendance_index', compact('attendances', 'users'));
    }



    public function create()
    {
        $attendance = Attendance::all();

        return view('attendance.submit_attendance', compact('attendance'));
    }


    public function leave_create()
    {
        $attendance = Attendance::all();

        return view('attendance.submit_leave', compact('attendance'));
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'status' => 'required',
        ]);

        $data = new Attendance([
            'status' => request()->get('status'),
            'user_id' => auth()->user()->id,
            'date' => now()->toDateString(),
        ]);


        $user_id = auth()->user()->id;
        $requestedDate = now()->toDateString();

        $attendance = Attendance::where('user_id', $user_id)
            ->whereDate('date', $requestedDate)
            ->first();

        if ($attendance) {
            return back()->with('success', 'Attendance already marked for this date');
        } else {
            $data->save();
            return redirect()->route('attendances.create')->with('success', 'Attendance Marked Successfully');
        }
    }


    public function leave_store(Request $request)
    {
        // dd('hello');
        $data = request()->validate([
            'status' => 'required',
        ]);

        // $validated['user_id'] = auth()->user()->id;

        $data = new Attendance([
            'status' => request()->get('status'),
            'user_id' => auth()->user()->id,
            'date' => now()->toDateString(),
        ]);


        $user_id = auth()->user()->id;
        $requestedDate = now()->toDateString();

        $attendance = Attendance::where('user_id', $user_id)
            ->whereDate('date', $requestedDate)
            ->first();

        if ($attendance) {
            return back()->with('success', 'Attendance already marked for this date');

        } else {
            $data->save();
            return redirect()->route('leaves.create')->with('success', 'Applied for Leave Successfully');

        }
    }


    public function show($id)
    {      
        $attendance = Attendance::find($id);
        return view('attendance.show', compact('attendance'));
    }


    public function edit($id)
    {
        $attendance = Attendance::find($id);
        
        return view('attendance.edit', compact('attendance'));
    }


    public function update($id)
    {
        $data = request()->validate([
            'date' => 'required',
            'status' => 'required',
        ]);

        $attendance = Attendance::find($id);
        $attendance->update($data);

        return redirect()->route('attendances.index', $attendance->id)->with('success', 'Attendance Updated successfully');
    }


    public function destroy($id)
    {
        $attendance = Attendance::find($id);
        $attendance->delete();

        return redirect()->route('attendances.index')->with('success', 'Attendance deleted successfully');
    }

}
