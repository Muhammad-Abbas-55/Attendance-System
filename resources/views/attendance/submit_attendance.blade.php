@extends('layout.layout')
@section('content')
    <div class="col-12 d-flex justify-content-center">
        <div class="row">
            <h1 class="text-center">Mark Your Attendance</h1>
            <hr><br>

            <form action="{{ route('attendances.store') }}" method="post">
                @csrf
                @include('layout.success-message')
                <div class="input-group mb-3 justify-content-center">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Mark Your Attendance</label>
                    </div>
                    <select class="custom-select text-center" style="width: 300px" id="status" name="status">
                        <option disabled selected>Select</option>
                        <option value="Present">Present</option>
                    </select>
                </div>
                @error('status')
                    <span class="fs-6 text-danger mt-2 d-block justify-content-center">{{ $message }}</span>
                @enderror

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-dark"> Submit </button>
                </div>
            </form>
        </div>
    </div>
@endsection
