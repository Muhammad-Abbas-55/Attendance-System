@extends('layout.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <hr>
            <h1 class= "d-flex justify-content-center">View Student Attendance</h1>
            <hr>
            <h4 class="d-flex justify-content-center text-decoration-underline">Name :{{ $attendances->user->name }}</h4>

            <a href="{{ route('attendances.index') }}" class="btn btn-primary btn-md">
                <i>Back</i>
            </a>
            <div class="table-responsive text-center">
                <table class="table col-md-6 mx-auto">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Attendance Date</th>
                            <th>Attendance Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $attendances->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($attendances->date)->format('d/M/Y') }}</td>
                            <td>{{ $attendances->status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <br><br>



    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-12">
            <hr>
            <h3 class= "d-flex justify-content-center">Attendace of {{ $attendances->user->name }}</h3>
            <hr>
            <div class="table-responsive text-center">
                <table class="table col-md-6 mx-auto">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Attendance Date</th>
                            <th>Attendance Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->attandances as $attendance)
                            <tr>
                                <td>{{ $attendance->user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d/M/Y') }}</td>
                                <td>{{ $attendance->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection
