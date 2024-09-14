@extends('layout.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <a href="{{ route('attendances.index') }}" class="btn btn-primary btn-sm">
                <i>Back</i> 
            </a> 
            <form class="form mt-5" action="{{ route('attendances.update', $attendance->id) }}" method="post">
                @csrf
                @method('put')
                @include('layout.success-message')
                <hr><h3 class="text-center text-dark">Edit Student   Attendance</h3><hr>
                <h3 class="text-center text-dark">Student : {{ $attendance->user->name }}</h3>
                <div class="form-group">
                    <label for="date" class="text-dark">Date:</label><br>
                    <input type="date" name="date" id="date" class="form-control" value="{{ \Carbon\Carbon::parse($attendance->date)->format('Y-m-d') }}">
                </div><br>
                @error('date')
                    <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                @enderror
                
                <div class="input-group mb-3 justify-content-center">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Attendance Status</label>
                    </div>
                    <select class="custom-select text-center" style="width: 300px" id="status" name="status">
                        <option disabled {{ $attendance->status == null ? 'selected' : '' }}>Select</option>
                        <option value="Present" {{ $attendance->status == 'Present' ? 'selected' : '' }}>Present</option>
                        <option value="Leave Request" {{ $attendance->status == 'Leave Request' ? 'selected' : '' }}>
                            Leave Request</option>
                        <option value="Approved" {{ $attendance->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                    </select>
                </div>
                @error('status')
                    <span class="fs-6 text-danger mt-2 d-block justify-content-center">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="remember-me" class="text-dark"></label><br>
                    <input type="submit" name="submit" class="btn btn-dark btn-md" value="Update">
                </div>

            </form>
        </div>
    </div>
@endsection
