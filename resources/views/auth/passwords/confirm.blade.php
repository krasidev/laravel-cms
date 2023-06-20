@extends('layouts.auth')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-transparent">{{ __('Confirm Password') }}</div>

    <div class="card-body">
        {{ __('Please confirm your password before continuing.') }}

        <form action="{{ route('password.confirm') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="password">{{ __('Password') }}: <span class="text-danger">*</span></label>

                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-outline-primary btn-block">
                {{ __('Confirm Password') }}
            </button>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="btn btn-link btn-block">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </form>
    </div>
</div>
@endsection
