@extends('layouts.backend')

@section('title', __('menu.backend.profile.edit'))

@section('content')
<div id="accordionProfile" class="accordion">
    @php
        $collapseUpdatePassword = $errors->has('current_password') || $errors->has('password');
        $collapseUpdateExpanded = !$collapseUpdatePassword;
    @endphp
    <div class="card shadow-sm">
        <div class="card-header bg-transparent d-flex align-items-center" data-toggle="collapse" data-target="#collapseUpdate" aria-expanded="{{ $collapseUpdateExpanded ? 'true' : 'false' }}" aria-controls="collapseUpdate">
            {{ __('menu.backend.profile.edit') }}
            <i class="plus-minus-rotate flex-shrink-0 ml-auto collapsed"></i>
        </div>

        <div id="collapseUpdate" class="collapse @if($collapseUpdateExpanded) show @endif" data-parent="#accordionProfile">
            <div class="card-body">
                <form action="{{ route('backend.profile.update') }}" method="post" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="name">{{ __('content.backend.profile.labels.name') }}: <span class="text-danger">*</span></label>

                                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" id="name" class="form-control @error('name') is-invalid @enderror">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="email">{{ __('content.backend.profile.labels.email') }}: <span class="text-danger">*</span></label>

                                <input type="text" name="email" value="{{ old('email', auth()->user()->email) }}" id="email" class="form-control @error('email') is-invalid @enderror">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="dropdown-divider mt-0 mb-3">

                    <button type="submit" class="btn btn-primary">{{ __('content.backend.profile.buttons.update') }}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-header bg-transparent d-flex align-items-center" data-toggle="collapse" data-target="#collapseUpdatePassword" aria-expanded="{{ $collapseUpdatePassword ? 'true' : 'false' }}" aria-controls="collapseUpdatePassword">
            {{ __('menu.backend.profile.edit-password') }}
            <i class="plus-minus-rotate flex-shrink-0 ml-auto collapsed"></i>
        </div>

        <div id="collapseUpdatePassword" class="collapse @if($collapseUpdatePassword) show @endif" data-parent="#accordionProfile">
            <div class="card-body">
                <form action="{{ route('backend.profile.update-password') }}" method="post" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="current_password">{{ __('content.backend.profile.labels.current_password') }}:</label>

                                <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror">

                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="password">{{ __('content.backend.profile.labels.password') }}:</label>

                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="password-confirm">{{ __('content.backend.profile.labels.password_confirmation') }}:</label>

                                <input type="password" name="password_confirmation" id="password-confirm" class="form-control">
                            </div>
                        </div>
                    </div>

                    <hr class="dropdown-divider mt-0 mb-3">

                    <button type="submit" class="btn btn-primary">{{ __('content.backend.profile.buttons.update-password') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
