@extends('layouts.dashboard')
@section('content')
 <div class="card">
        <div class="card-body">
            <h1 class="card-title">User Management</h1>
            <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus me-1"></i> Add New User
            </a>
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
                            <tr id="user-{{ $user->id }}">
                                <td class="text-center align-middle">{{ $user->id }}</td>
                                <td class="align-middle">{{ $user->name }}</td>
                                <td class="align-middle">{{ $user->email }}</td>
                                <td class="align-middle">{{ ucfirst($user->role) }}</td>
                                <td class="align-middle">
                                    @if ($user->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-sm btn-outline-primary mb-1" href="{{ route('users.edit', $user->id) }}">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this user?')"
                                        class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
 </div>
@endsection

<script>
    function toggleModal() {
        const modal = document.getElementById('userModal');
        modal.classList.toggle('hidden');
    }
</script>
