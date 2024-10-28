@extends('layouts.app')

@section('title', 'Users')

@section('content')

<style>
    .custom-card {
        background-color: #f8f9fa; /* Light background for the card */
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .custom-card-header {
        background-color: #007bff; /* Bootstrap primary color */
        color: white;
        font-size: 1.5rem; /* Larger font size for header */
        padding: 10px 15px; /* Adjusted padding */
        border-top-left-radius: 10px; /* Rounded corners */
        border-top-right-radius: 10px; /* Rounded corners */
    }

    .btn-primary {
        background-color: #007bff; /* Button color */
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Darker shade on hover */
        border-color: #0056b3;
    }

    .invalid-feedback {
        font-size: 0.9rem; /* Slightly smaller font for error messages */
    }
</style>

<div class="container">
    <div class="row">
        <h1 class="text-secondary mb-4">
            <i class="fa-solid fa-user mr-2"></i>
            Users
        </h1>
    </div>

    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header custom-card-header">{{ __('Add User') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                                    <option value="" disabled selected>{{ __('Select Role') }}</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>{{ __('Admin') }}</option>
                                    <option value="verifier" {{ old('role') == 'verifier' ? 'selected' : '' }}>{{ __('Verifier') }}</option>
                                    <option value="publisher" {{ old('role') == 'publisher' ? 'selected' : '' }}>{{ __('Publisher') }}</option>
                                </select>

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add User') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection