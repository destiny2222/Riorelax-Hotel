@extends('layouts.main')
<style>
    .password-field {
        position: relative;
    }
    
    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        padding: 5px;
        color: #666;
        z-index: 10;
    }
    
    .password-toggle:hover {
        color: #333;
    }
    
    .password-toggle svg {
        display: block;
    }
    
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
    
    .alert-success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }
    
    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }
</style>
@section('content')
<section class="breadcrumb-area d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-center">
                    <div class="breadcrumb-title">
                        <h2>Profile</h2>
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pt-40 pb-40">
    <div class="container">
        <div class="customer-page crop-avatar">
            <div class="container">
                <div class="customer-body">
                    <div class="row body-border">
                        <div class="col-md-3">
                            <div class="profile-sidebar">
                                @include('dash.sidebar')
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="profile-content">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h1 class="customer-page-title text-center">Change password</h1>
                                    </div>
                                    <div class="panel-body custom-edit-account-form">
                                        @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                @foreach ($errors->all() as $error)
                                                    <div>{{ $error }}</div>
                                                @endforeach
                                            </div>
                                        @endif
                                        
                                        <form method="POST" action="{{ route('dashboard.change-password-post') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-20">
                                                        <label for="old_password"
                                                            class="input-group-prepend mb-10 mt-20">Old Password:
                                                        </label>
                                                        <div class="password-field position-relative">
                                                            <input id="old_password" type="password" class="form-control" name="current_password" placeholder="Current Password">
                                                            <button type="button" class="password-toggle" onclick="togglePassword('old_password')">
                                                                <svg id="old_password-eye-open" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                </svg>
                                                                <svg id="old_password-eye-closed" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                                    <path d="m1 1 22 22" stroke="currentColor" stroke-width="2"/>
                                                                    <path d="M6.71 6.71C4.52 8.73 3 12 3 12s4 8 9 8c1.49 0 2.87-.37 4.07-.94" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                    <path d="M14.12 14.12C13.47 14.67 12.76 15 12 15c-1.66 0-3-1.34-3-3 0-.76.33-1.47.88-2.12" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                    <path d="M17.29 17.29C16.13 17.63 14.83 18 12 18c-5 0-9-8-9-8s1.48-3.27 3.71-5.29" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                    <path d="M9.88 9.88C10.53 9.33 11.24 9 12 9c1.66 0 3 1.34 3 3 0 .76-.33 1.47-.88 2.12" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-20">
                                                        <label for="password" class="input-group-prepend mb-10 mt-20">New Password:</label>
                                                        <div class="password-field position-relative">
                                                            <input id="password" type="password" class="form-control" name="new_password" placeholder="New Password">
                                                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                                                <svg id="password-eye-open" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                </svg>
                                                                <svg id="password-eye-closed" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                                    <path d="m1 1 22 22" stroke="currentColor" stroke-width="2"/>
                                                                    <path d="M6.71 6.71C4.52 8.73 3 12 3 12s4 8 9 8c1.49 0 2.87-.37 4.07-.94" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                    <path d="M14.12 14.12C13.47 14.67 12.76 15 12 15c-1.66 0-3-1.34-3-3 0-.76.33-1.47.88-2.12" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                    <path d="M17.29 17.29C16.13 17.63 14.83 18 12 18c-5 0-9-8-9-8s1.48-3.27 3.71-5.29" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                    <path d="M9.88 9.88C10.53 9.33 11.24 9 12 9c1.66 0 3 1.34 3 3 0 .76-.33 1.47-.88 2.12" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-20">
                                                        <label for="password_confirmation" class="input-group-prepend mb-10 mt-20">Password Confirmation:</label>
                                                        <div class="password-field position-relative">
                                                            <input id="password_confirmation" type="password" class="form-control" name="new_password_confirmation" placeholder="Password Confirmation">
                                                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                                                <svg id="password_confirmation-eye-open" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                </svg>
                                                                <svg id="password_confirmation-eye-closed" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                                    <path d="m1 1 22 22" stroke="currentColor" stroke-width="2"/>
                                                                    <path d="M6.71 6.71C4.52 8.73 3 12 3 12s4 8 9 8c1.49 0 2.87-.37 4.07-.94" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                    <path d="M14.12 14.12C13.47 14.67 12.76 15 12 15c-1.66 0-3-1.34-3-3 0-.76.33-1.47.88-2.12" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                    <path d="M17.29 17.29C16.13 17.63 14.83 18 12 18c-5 0-9-8-9-8s1.48-3.27 3.71-5.29" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                    <path d="M9.88 9.88C10.53 9.33 11.24 9 12 9c1.66 0 3 1.34 3 3 0 .76-.33 1.47-.88 2.12" stroke="currentColor" stroke-width="2" fill="none"/>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col s12 mt-20">
                                                <button type="submit" class="btn btn-primary btn-sm">Change password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const eyeOpen = document.getElementById(fieldId + '-eye-open');
            const eyeClosed = document.getElementById(fieldId + '-eye-closed');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'block';
            } else {
                passwordField.type = 'password';
                eyeOpen.style.display = 'block';
                eyeClosed.style.display = 'none';
            }
        }
    </script>
@endpush