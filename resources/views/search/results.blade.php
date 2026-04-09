@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h4 class="mb-4">Results for: <strong>{{ $q }}</strong></h4>

        {{-- TOURS --}}
        @if ($tours->count())
            <div class="card mb-4">
                <div class="card-header"><i class="fa fa-map-marker me-2"></i>Tours</div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Destination</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tours as $tour)
                                <tr>
                                    <td>{{ $tour->name }}</td>
                                    <td>{{ $tour->destination }}</td>
                                    <td><a href="{{ route('tour.index') }}#tour-{{ $tour->id }}"
                                            class="btn btn-sm btn-primary">View</a></td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        {{-- BOOKINGS --}}
        @if ($bookings->count())
            <div class="card mb-4">
                <div class="card-header"><i class="fa fa-calendar me-2"></i>Bookings</div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Tour</th>
                                <th>Customer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->tour->name ?? '-' }}</td>
                                    <td>{{ $booking->user->name ?? '-' }}</td>
                                    <td><a href="{{ route('booking.index') }}#booking-{{ $booking->id }}"
                                            class="btn btn-sm btn-primary">View</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        {{-- USERS --}}
        @if ($users->count())
            <div class="card mb-4">
                <div class="card-header"><i class="fa fa-users me-2"></i>Users</div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><a href="{{ route('users.index') }}#user-{{ $user->id }}"
                                            class="btn btn-sm btn-primary">View</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if ($permissions->isNotEmpty())
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">Permissions Found</div>
                <ul class="list-group list-group-flush">
                    @foreach ($permissions as $permission)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('permissions.edit', $permission->id) }}">
                                {{ $permission->name }}
                            </a>
                            <span class="badge bg-primary rounded-pill">ID: {{ $permission->id }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- NO RESULTS --}}
        @if ($tours->isEmpty() && $bookings->isEmpty() && $users->isEmpty() && $permissions->isEmpty())
            <div class="alert alert-info">
                No results found for <strong>{{ $q }}</strong>.
            </div>
        @endif

        <div class="mt-4">
            {{ $tours->links() }}
        </div>
    </div>
@endsection
