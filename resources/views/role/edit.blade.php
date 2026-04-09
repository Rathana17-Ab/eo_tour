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

    <form action="{{ route('role.update',$role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $role->name }}"
                   class="form-control">
        </div>
        <div class="form-group">
                    <strong>Permission:</strong>

                    <div class="row mt-2">

                        @foreach ($permission as $value)
                            <div class="col-md-4 mb-2"> <!-- 3 per row -->
                                <div class="form-check form-switch">

                                    <input class="form-check-input" type="checkbox" name="permission[]"
                                        value="{{ $value->id }}" id="permission{{ $value->id }}" {{-- Auto-check if permission exists in role --}}
                                        {{ in_array($value->id, old('permission', $role->permissions->pluck('id')->toArray())) ? 'checked' : '' }}>

                                    <label class="form-check-label" for="permission{{ $value->id }}">
                                        {{ $value->name }}
                                    </label>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('role.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection