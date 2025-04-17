@extends('layouts.app')

@section('content')
<div class="container mt-5">

  {{-- Flash message after registration --}}
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif

  <div class="card">
    <div class="card-body text-center">
      <h4>Verify Your Email Address</h4>
      <p>
        A verification link has been sent to <strong>{{ auth()->user()->email }}</strong>.
        Please check your inbox (and spam folder) and click the link.
      </p>

      @if (session('resent'))
        <div class="alert alert-success">A new verification link has been sent to your email address.</div>
      @endif

      <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link">
          Didn’t receive the email? Click here to request another.
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
