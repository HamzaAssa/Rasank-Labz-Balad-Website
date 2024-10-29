<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm Password | Rasaank Labz Balad</title>
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #343a40; /* Dark background */
            color: #ffffff; /* Light text for better readability */
            height: 100vh; /* Full viewport height */
            display: flex; /* Use flexbox for centering */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            margin: 0; /* Remove default margin */
        }
        .card {
            background-color: #007bff; /* Blue card background color */
            border: none; /* Remove default border */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Add subtle shadow */
            color: #ffffff; /* White text color */
        }
        .btn-primary {
            background-color: #ffffff; /* White button color */
            color: #007bff; /* Blue text for button */
            border: none; /* Remove border for buttons */
        }
        .btn-primary:hover {
            background-color: #e2e6ea; /* Light gray on hover */
        }
        .form-control {
            background-color: #0056b3; /* Darker blue for input background */
            color: #ffffff; /* White text for inputs */
        }
        .form-control:focus {
            background-color: #0069d9; /* Brighter blue on focus */
            color: #ffffff; /* White text on focus */
            border-color: #ffffff; /* White border on focus */
        }
        .invalid-feedback {
            color: #dc3545; /* Error message color */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>{{ __('Confirm Password') }}</h3>
                    </div>

                    <div class="card-body">
                        <p>{{ __('Please confirm your password before continuing.') }}</p>

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Confirm Password') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
