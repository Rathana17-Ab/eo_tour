@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Edit Permission</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('role.update',$roles->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $roles->name }}"
                   class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('role.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection