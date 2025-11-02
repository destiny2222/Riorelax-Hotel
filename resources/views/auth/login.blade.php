@extends('layouts.main')
<style>
    .password-field {
        position: relative;
    }
    
    .password-toggle {
        position: absolute;
        right: 15px;
        top: 70%;
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
</style>
@section('content')
    <section class="breadcrumb-area d-flex align-items-center page_speed_830152622">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-center">
                    <div class="breadcrumb-title">
                        <h2>Login</h2>
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Login
                                    </li>
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
        <section class="about-area about-p pt-120 pb-120 p-relative fix">
            <div class="container">
                <div class="row flex-row-reverse justify-content-center align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="booking-img">
                            <img src="/images/about-img-03.jpg" alt="Login" />
                        </div>
                    </div>
                    <div class="col-xxl-5 col-xl-12 col-lg-12">
                        <div data-animation="fadeInRight" data-delay=".4s"
                            class="about-content s-about-content wow fadeInRight animated page_speed_306510310">
                            <div class="about-title second-title pb-25">
                                <h1>Welcome back</h1>
                            </div>
                            <div class="form-border-box">
                                <form method="POST" action="{{ route('login.post') }}">
                                    @csrf
                                    <h2 class="normal pb-25"><span>Login</span></h2>
                                    <div class="form-field-wrapper form-group">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="input-md form-full-width contact-field p-relative c-name mb-20">
                                                <label class="custom-authentication-label"
                                                    for="email"><span>Email</span></label>
                                                <input class="custom-authentication-input" type="email" id="email" 
                                                name="email" placeholder="example@gmail.com" required=""
                                                    value="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-field-wrapper form-group">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="input-md form-full-width contact-field p-relative c-name mb-20 password-field">
                                                <label class="custom-authentication-label"
                                                    for="password"><span>Password</span></label>
                                                <input class="custom-authentication-input" type="password" id="password"
                                                    name="password" required="" />
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
                                    <div class="d-flex">
                                        <div class="col-lg-6 col-6 mt-15">
                                            <div class="form-group mb-25">
                                                <label class="cb-container"><input type="checkbox" value="1"
                                                        name="remember" id="remember-check" checked="" /><span
                                                        class="text-small">Remember me</span><span
                                                        class="checkmark"></span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-6 mt-15">
                                            <div class="form-group mb-25 text-end">
                                                <a class="font-xs color-grey-500" href="{{ route('password.request') }}">
                                                    Forgot password?
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-field-wrapper">
                                        <button type="submit" class="submit btn btn-md btn-black">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-20">
                            <span class="color-grey-500 d-inline-block align-middle font-sm">
                                Don't have an account? </span><a
                                class="d-inline-block align-middle color-success ms-1 custom-register-label"
                                href="{{ route('register') }}">Sign up now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>



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
@endsection