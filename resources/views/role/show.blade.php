@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Role Details</h2>

    <div class="card">
        <div class="card-body">
            <h4>ID: {{ $permission->id }}</h4>
            <h4>Name: {{ $permission->name }}</h4>
            <h6>Created: {{ $permission->created_at }}</h6>
        </div>
    </div>

    <br>
    <a href="{{ route('role.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection