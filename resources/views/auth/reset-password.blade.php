@extends('layouts.main')

@section('content')
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area d-flex  p-relative align-items-center"
        style="background-image:url({{ asset('assets/img/bg/bdrc-bg.png') }})">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="breadcrumb-wrap text-left">
                        <div class="breadcrumb-title">
                            <h2>Reset Password</h2>
                            <div class="breadcrumb-wrap">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
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
            <section class="about-area about-p pt-60 pb-60 p-relative fix">
                <div class="container">
                    <div class="row flex-row-reverse justify-content-center align-items-center">
                        <div class="col-md-12 col-lg-10 mx-auto">
                            <h1>Reset Password</h1>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <p>
                                        Enter your new password below
                                    </p>
                                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.update') }}">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        
                                        <div class="form-field-wrapper form-group">
                                            <div class="col-lg-12 col-md-12 mb-20">
                                                <div class="input-md form-full-width contact-field p-relative c-name">
                                                    <label class="custom-authentication-label" for="email"><span>E-Mail
                                                            Address</span></label><input class="custom-authentication-input"
                                                        type="email" id="email" name="email" placeholder="Email"
                                                        required="" value="{{ $email ?? old('email') }}" readonly />
                                                    @error('email')
                                                        <div class="text-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-field-wrapper form-group">
                                            <div class="col-lg-12 col-md-12 mb-20">
                                                <div class="input-md form-full-width contact-field p-relative c-name">
                                                    <label class="custom-authentication-label" for="password"><span>New Password</span></label>
                                                    <input class="custom-authentication-input"
                                                        type="password" id="password" name="password" placeholder="New Password"
                                                        required="" />
                                                    @error('password')
                                                        <div class="text-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-field-wrapper form-group">
                                            <div class="col-lg-12 col-md-12 mb-20">
                                                <div class="input-md form-full-width contact-field p-relative c-name">
                                                    <label class="custom-authentication-label" for="password_confirmation"><span>Confirm Password</span></label>
                                                    <input class="custom-authentication-input"
                                                        type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password"
                                                        required="" />
                                                    @error('password_confirmation')
                                                        <div class="text-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <div class="col-md-12 mt-20">
                                                <button type="submit" class="btn btn-md btn-black">
                                                    Reset Password
                                                </button>
                                                <div class="mt-3">
                                                    <a href="{{ route('login') }}" class="color-grey-500">Back to Login</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection