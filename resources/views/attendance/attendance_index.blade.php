@extends('layout.layout')
@section('content')
    @if (Auth::user()->user_type === '0')
        <div class="col-12 d-flex justify-content-center">
            <div class="row">
                <h1 class="text-center">View your Attendance</h1>
                <hr>
            </div>
        </div>
        <h4 class="text-center">Student : {{ Auth::user()->name }}</h4>
        <hr>
        <div class="table-responsive text-center">
            <table class="table col-md-3 mx-auto">
                <thead>
                    <tr>
                        <th>Ser</th>
                        <th> Attendance Date</th>
                        <th>Attendance Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 1; ?>
                    @foreach ($attendances as $attendance)
                        @if ($attendance->user_id === Auth::id())
                            <!-- Check if attendance belongs to the authenticated user -->
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d/M/Y') }}</td>
                                <td>{{ $attendance->status }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif



    @if (Auth::user()->user_type === '1')
        <div class="col-12 d-flex justify-content-center">
            <div class="row">
                <h1 class="text-center">View Student Attendances</h1>
                <hr>
            </div>
        </div>
        <h4 class="text-center">Admin : {{ Auth::user()->name }}</h4>
        <hr>
        <div class="table-responsive text-center">
            <table class="table col-md-3 mx-auto">
                <thead>
                    <tr>
                        <th>Ser</th>
                        <th>Student Name</th>
                        <th>Attendance Date</th>
                        <th>Attendance Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 1; ?>
                    @foreach ($attendances as $attendance)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $attendance->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d/M/Y') }}</td>
                            <td>{{ $attendance->status }}</td>
                            <td>
                                <a href="{{ route('attendances.show', $attendance->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('attendances.destroy', $attendance->id) }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
