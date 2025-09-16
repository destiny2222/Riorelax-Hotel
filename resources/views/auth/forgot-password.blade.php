@extends('layouts.main')
@section('content')
    <section class="breadcrumb-area d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="breadcrumb-wrap text-center">
                        <div class="breadcrumb-title">
                            <h2>Forgot Password</h2>
                            <div class="breadcrumb-wrap">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Forgot Password
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
            <section class="about-area about-p pt-60 pb-60 p-relative fix">
                <div class="container">
                    <div class="row flex-row-reverse justify-content-center align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="booking-img">
                                <img src="../storage/general/booking-img.png" alt="Forgot password" />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <h1>Forgot password</h1>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <p>
                                        Enter the email address associated with your account and
                                        we’ll send you a link to reset your password
                                    </p>
                                    <form class="form-horizontal" role="form" method="POST"  action="">
                                        
                                        <div class="form-field-wrapper form-group">
                                            <div class="col-lg-12 col-md-12 mb-20">
                                                <div class="input-md form-full-width contact-field p-relative c-name">
                                                    <label class="custom-authentication-label" for="email"><span>E-Mail
                                                            Address</span></label><input class="custom-authentication-input"
                                                        type="email" id="email" name="email" placeholder="Email"
                                                        required="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="col-md-6 col-md-offset-4 mt-20">
                                                <button type="submit" class="btn btn-primary">
                                                    Send Password Reset Link
                                                </button>
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
