@extends('layout.layout')
@section('content')
<h1 class="text-center">Attendance System <br> Main Dashboard</h1> <hr>
    <div class="row">
        <div class="col-3">
            @include('layout.left-sidebar')
        </div>
        <div class="col-6">
            @include('layout.success-message')
        </div>
        <div class="col-3">
            @include('layout.search-bar')
            @include('layout.follow-box')
        </div>
    </div>
@endsection
