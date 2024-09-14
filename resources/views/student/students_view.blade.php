@extends('layout.layout')
@section('content')
    <div class="col-12 d-flex justify-content-center">
        <div class="row">
            <h1 class="text-center">View Students Detail</h1>
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
                    <th>Student Email</th>
                    <th>Profile</th>
                </tr>
            </thead>
            <tbody>
                <?php $index = 1; ?>
                @foreach ($users as $user)
                    @if ($user->user_type === '0')
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><img src="{{ asset('uploads/' . $user->image) }}" style="width: 100px; height: 100px;"
                                alt="Img" /></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
