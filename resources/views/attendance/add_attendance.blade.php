@extends('layout.layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-6">
        <form class="form mt-5" action="{{ route('attendances.add') }}" method="post">
            @csrf
            @include('layout.success-message')
            <hr><h3 class="text-center text-dark">Add Student Attendance</h3><hr>
            <a href="{{ route('attendances.index') }}" class="btn btn-primary btn-sm">
                <i>Back</i> 
            </a> 

            <div class="input-group mb-3 justify-content-center">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Select Student</label>
                </div>
                <select class="custom-select text-center" style="width: 300px" id="name" name="name">
                    <option disabled selected >Select</option>
                    @foreach ($users as $user) 
                        <option value="{{ $user->id}}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            
            <div class="input-group mb-3 justify-content-center">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Attendance Status</label>
                </div>
                <select class="custom-select text-center" style="width: 300px" id="status" name="status">
                    <option disabled selected>Select</option>
                    <option value="Present">Present</option>
                    <option value="Absent">Absent</option>
                    <option value="Leave Request">Leave Request</option>
                    <option value="Leave">Leave Approved</option>
                </select>
            </div>
            @error('status')
                <span class="fs-6 text-danger mt-2 d-block justify-content-center">{{ $message }}</span>
            @enderror

            <div class="form-group d-flex justify-content-center">
                <button type="submit" class="btn btn-dark btn-md justify-content-center">submit</button>
            </div>

        </form>
    </div>
</div>
@endsection
