@extends('layout.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <a href="{{ route('attendances.index') }}" class="btn btn-primary btn-sm">
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
                            <td>{{ $attendance->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d/M/Y') }}</td>
                            <td>{{ $attendance->status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
