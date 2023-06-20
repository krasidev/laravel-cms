@extends('layouts.auth')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-transparent">{{ __('Reset Password') }}</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">{{ __('Email Address') }}: <span class="text-danger">*</span></label>

                <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control @error('email') is-invalid @enderror" autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-outline-primary btn-block">
                {{ __('Send Password Reset Link') }}
            </button>
        </form>
    </div>
</div>
@endsection
