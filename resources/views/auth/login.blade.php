{{-- resources/views/auth/login.blade.php --}}
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email Address') }}</label>
        <input id="email" type="email" class="form-control" name="email" required autofocus>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control" name="password" required>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" name="remember" id="remember">
        <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
    </div>
    <button type="submit" class="btn btn-primary w-100">{{ __('Login') }}</button>
</form>
