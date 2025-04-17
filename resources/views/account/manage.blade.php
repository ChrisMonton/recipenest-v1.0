@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Manage Account</h2>

    @if(session('success'))
       <div class="alert alert-success">
         {{ session('success') }}
       </div>
    @endif

    <form method="POST" action="{{ route('account.update') }}">
        @csrf
        @method('PUT')

        <!-- Name field (if you use a combined name field) -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
              <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Alternatively, if you use first name and surname separately, create two inputs -->

        <!-- Email field -->
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
              <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password fields -->
        <div class="mb-3">
            <label for="password" class="form-label">New Password (leave blank if unchanged)</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
              <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Update Account</button>
    </form>
</div>
@endsection
