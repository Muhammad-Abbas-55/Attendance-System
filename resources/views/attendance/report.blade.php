@extends('layout.layout')
@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-12">
            <hr>
            <h3 class="d-flex justify-content-center">Generate Report of Student Attendance</h3>
            <hr>
            <form action="{{ route('attendances.report') }}" method="get" class="d-flex justify-content-center mb-4">
                @csrf

                <div class="form-group mx-3">
                    <label for="name">Student Name:</label>
                    <select class="form-control" id="name" name="user_id" required>
                        <option disabled selected>Select</option>
                        @foreach ($users as $user)
                            @if ($user->user_type === '0')
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group mx-3">
                    <label for="from_date">From Date:</label>
                    <input type="date" name="from_date" id="from_date" class="form-control" required>
                </div>

                <div class="form-group mx-3">
                    <label for="to_date">To Date:</label>
                    <input type="date" name="to_date" id="to_date" class="form-control" required>
                </div>

                <div class="form-group mx-3">
                    <button type="submit" name="type" value="Report" class="btn btn-primary btn-md mt-4">Generate
                        Report</button>
                </div>
                <div class="form-group mx-3">
                    <button type="submit" name="type" value="Grade" class="btn btn-primary btn-md mt-4">Generate
                        Grade</button>
                </div>
            </form>

            <div class="table-responsive text-center">
                <table class="table col-md-6 mx-auto">
                    <thead>
                        <tr>
                            <th>Student Name</th>

                            @if (isset($attendances[0]->present_count))
                                <th>Presents</th>
                                <th>Absents</th>
                                <th>Leave</th>
                                <th>Grade</th>
                            @else
                                <th>Attendance Date</th>
                                <th>Attendance Status</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($attendances)
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->user->name }}</td>

                                    @if (isset($attendance->present_count))
                                        <td>{{ $attendance->present_count }}</td>
                                        <td>{{ $attendance->absent_count }}</td>
                                        <td>{{ $attendance->leave_count }}</td>
                                        <td>{{ $attendance->grade }}</td>
                                    @else
                                        <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d/M/Y') }}</td>
                                        <td>{{ $attendance->status }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No records found for the selected date range and user.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
