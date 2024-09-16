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
        $attendances = Attendance::orderBy('created_at', 'DESC')->paginate(5);
        $users = User::all();

        return view('attendance.attendance_index', [
            'attendances' => $attendances,
            'users' => $users
        ]);
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
        $attendances = Attendance::find($id);
        $user = User::find($attendances->user_id);
        // dd($user->attandances);
        return view('attendance.show', compact('attendances', 'user'));
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




    public function attendance_student()
    {

        $attendance = Attendance::all();
        $users = User::where('user_type', 0)->get();

        return view('attendance.add_attendance', compact('attendance', 'users'));
    }

    public function attendance_add(Request $request)
    {
        // dd($request);
        $data = request()->validate([
            'status' => 'required',
        ]);

        $data = new Attendance([
            'status' => $request->get('status'),
            'user_id' =>  $request->get('name'),
            'date' => now()->toDateString(),
        ]);

        $user_id = $request->get('name');
        $requestedDate = now()->toDateString();

        $attendance = Attendance::where('user_id', $user_id)
            ->whereDate('date', $requestedDate)
            ->first();

        if ($attendance) {
            return back()->with('success', 'Attendance already marked for this date');
        } else {
            $data->save();
            return redirect()->route('attendances.student')->with('success', 'Attendance Marked Successfully');
        }
    }

    public function report_index(Request $request)
    {
        $attendances = Attendance::orderBy('created_at', 'DESC')->get();
        $user = User::all();

        return view('attendance.report', [
            'attendances' => $attendances,
            'users' => $user,
        ]);
    }

    public function report(Request $request)
    {

        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'user_id' => 'required|exists:users,id'
        ]);

        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $userId = $request->input('user_id');
        $type = $request->input('type');
        $users = User::all();

        if ($type === 'Report') {
            // Generate the attendance report
            $attendances = Attendance::where('user_id', $userId)
                ->whereBetween('date', [$fromDate, $toDate])
                ->with('user')
                ->get();

            return view('attendance.report', compact('attendances', 'users'));
        } elseif ($type === 'Grade') {          // Generate the attendance Grade
            $attendances = Attendance::select('user_id')
                ->selectRaw("
            SUM(CASE WHEN status = 'Present' THEN 1 ELSE 0 END) as present_count,
            SUM(CASE WHEN status = 'Absent' THEN 1 ELSE 0 END) as absent_count,
            SUM(CASE WHEN status = 'Leave' THEN 1 ELSE 0 END) as leave_count
        ")
                ->where('user_id', $userId)
                ->whereBetween('date', [$fromDate, $toDate])
                ->with('user')
                ->groupBy('user_id')
                ->get();

            // Calculate grade based on attendance counts
            foreach ($attendances as $attendance) {
                $presentCount = $attendance->present_count;

                if ($presentCount >= 5) {
                    $attendance->grade = 'A';
                } elseif ($presentCount >= 4) {
                    $attendance->grade = 'B';
                } elseif ($presentCount >= 3) {
                    $attendance->grade = 'C';
                } elseif ($presentCount >= 2) {
                    $attendance->grade = 'D';
                } else {
                    $attendance->grade = 'F';
                }
            }
            return view('attendance.report', compact('attendances', 'fromDate', 'toDate', 'users'));
        }
    }
}
