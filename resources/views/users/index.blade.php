@extends('layouts.dashboard')
@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="mb-4 text-center">User Management</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">
                Create New User
            </a>
            {{-- Search Form --}}
            {{-- input name="search" ត្រូវ match Controller --}}
            <form action="{{ route('users.index') }}" method="GET" class="mb-3">
                <div class="input-group" style="max-width: 400px;">
                    <input type="text" name="search" class="form-control" placeholder="Search users..."
                        value="{{ $search ?? '' }}">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fas fa-search"></i> Search
                    </button>
                    @if (!empty($search))
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Clear
                        </a>
                    @endif
                </div>
            </form>

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">ID</th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Name</th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Email</th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Role</th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Status</th>
                                <th class="text-center align-middle" style="background:#0d6efd; color:#fff;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-center align-middle">{{ $user->id }}</td>
                                    <td class="align-middle">{{ $user->name }}</td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">
                                        {{-- ✅ មិនប្រើ inner foreach --}}
                                        {{ ucfirst($user->roles->first()->name ?? 'No Role') }}
                                    </td>
                                    <td class="align-middle">
                                        @if ($user->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <a class="btn btn-warning btn-sm"
                                            href="{{ route('users.edit', $user->id) }}">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this user?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $users->appends(['q' => request('q')])->links() }}
                </div>
            </div>
        </div>
    </div>


    <script>
        function toggleModal() {
            const modal = document.getElementById('userModal');
            modal.classList.toggle('hidden');
        }
    </script>
@endsection
