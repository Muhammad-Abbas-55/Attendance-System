@extends('layout.layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6">
            <form class="form mt-5" action="{{ route('profiles.update', Auth::user()->id) }}" method="post"  enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <h3 class="text-center text-dark">Update Profile</h3>
                <div class="form-group">
                    <label for="name" class="text-dark">Name:</label><br>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" id="name" class="form-control">
                </div>
                @error('name')
                    <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                @enderror
                <div class="form-group mt-3">
                    <label for="email" class="text-dark">Email:</label><br>
                    <input type="email" value="{{ Auth::user()->email }}" name="email" id="email" class="form-control">
                </div>
                @error('email')
                    <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                @enderror
                <div class="form-group mt-3">
                    <label for="password" class="text-dark"> Enter New Password:</label><br>
                    <input type="password" name="password" placeholder="Enter New Password" id="password" class="form-control">
                </div>
                @error('password')
                    <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                @enderror
                <div class="form-group mt-3">
                    <label for="confirm-password" class="text-dark">Confirm New Password:</label><br>
                    <input type="password" name="password_confirmation" placeholder="Confirm New Password" id="confirm-password" class="form-control">
                </div>
                @error('password_confirmation')
                    <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                @enderror
                <div class="form-group mt-3">
                    <label for="image" class="text-dark"> Update Profile:</label><br>
                    <input type="file" name="image" class="form-control" >
                </div>
                <div class="form-group mt-3">
                    <label for="image" class="text-dark"> Your Profile:</label><br>
                    <img src="{{ asset('uploads/' . Auth::user()->image) }}" style="width: 200px; height: auto;" alt="Img" />
                </div>
                <div class="form-group">
                    <label for="remember-me" class="text-dark"></label><br>
                    <button type="submit"  class="btn btn-dark btn-md" > Update </button>
                </div>
            </form>
        </div>
    </div>
@endsection
