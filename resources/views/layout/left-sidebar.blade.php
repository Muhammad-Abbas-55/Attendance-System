<div class="card overflow-hidden">
    @if (Auth::check())
        @if (Auth::user()->user_type === '0')
            <div class="card-body pt-3">
                <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <span class="bg-gray">Student Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('attendances.create') }}">
                            <span>Mark Attendance</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('leaves.create') }}">
                            <span>Mark Leave</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('attendances.index') }}">
                            <span>View Attendance</span>
                        </a>
                    </li>
                </ul>
            </div>
        @elseif (Auth::user()->user_type === '1')
            <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <span class="bg-gray">Admin Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('attendances.index') }}">
                        <span>View all Attendance</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('students.view') }}">
                        <span>View all Students</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('report.index') }}">
                        <span>Generate Report</span>
                    </a>
                </li>
            </ul>
        @endif
    @endif

    <div class="card-footer text-center py-2">
        @if (Auth::check())
            @php
                $userId = Auth::user()->id;
            @endphp
            <a class="btn btn-link btn-sm" href="{{ route('profiles.edit', $userId) }}">View Profile</a>
        @else
            <p>You need to <a href="{{ route('login') }}">log in</a> to view your profile.</p>
        @endif
    </div>
</div>
