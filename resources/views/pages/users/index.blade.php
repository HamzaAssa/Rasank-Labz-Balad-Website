@extends('layouts.app')

@section('title', 'Users')

@section('content')

<style>
    .custom-card {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        padding: 20px;
    }

    .custom-modal-header {
        background-color: #007bff; /* Blue header */
        color: #ffffff; /* White text */
        padding: 15px;
        border-radius: 8px 8px 0 0;
        text-align: center;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .custom-modal-header i {
        margin-right: 10px;
    }

    .form-group {
        display: flex;
        align-items: center;
        padding: 10px 0;
    }

    .form-label {
        font-weight: bold;
        color: #6c757d;
        flex: 1;
        text-align: right;
        margin-right: 15px;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #ced4da;
        padding: 12px;
    }

    .btn-submit {
        background-color: #007bff; /* Blue button */
        color: #ffffff; /* White text */
        border: none;
        width: 100%;
        padding: 12px;
        font-weight: bold;
        font-size: 1rem;
        border-radius: 8px;
        margin-top: 20px;
        transition: background-color 0.2s;
    }

    .btn-submit:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }

    .data-table-container {
        margin-top: 40px;
    }
</style>

<div class="container">
    <div class="row mb-4">
        <h1 class="text-secondary">
            <i class="fa-solid fa-user mr-2"></i> Users
        </h1>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-md-10 text-end">
            <!-- Button to trigger Add User modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fa fa-user-plus"></i> Add User
            </button>
        </div>
    </div>

    <div class="data-table-container row bg-body">
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td class="d-flex justify-content-center">
                            <button class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#updateModal" type="button">
                                Update
                            </button>
                            <button class="btn btn-danger submit mx-1" data-action="{{ route('delete_unverified_words') }}" data-bs-target="#deleteModal" data-bs-toggle="modal">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #f8f9fa;">
            <div class="custom-modal-header">
                <i class="fa fa-user-plus"></i>
                <span>{{ __('Add User') }}</span>
            </div>

            <form method="POST" action="{{ route('register') }}" class="p-4">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <div class="flex-grow-1">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                               name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="role" class="form-label">{{ __('Role') }}</label>
                    <div class="flex-grow-1">
                        <select id="role" class="form-select @error('role') is-invalid @enderror" name="role" required>
                            <option value="" disabled selected>{{ __('Select Role') }}</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="verifier" {{ old('role') == 'verifier' ? 'selected' : '' }}>Verifier</option>
                            <option value="publisher" {{ old('role') == 'publisher' ? 'selected' : '' }}>Publisher</option>
                        </select>
                        @error('role')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <div class="flex-grow-1">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <div class="flex-grow-1">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                               name="password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <div class="flex-grow-1">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-submit">{{ __('Add User') }}</button>
            </form>
        </div>
    </div>
</div>

@endsection
