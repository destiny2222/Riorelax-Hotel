<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In</title>
    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="/assets/img/icons/2025-02-16/F.png" type="image/x-icon">
    <!-- Start Global Mandatory Style -->
    <!-- Bootstrap -->
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap rtl -->
    <link href="/assets/plugins/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/plugins/themify-icons/themify-icons.css" rel="stylesheet">
    <link href="/assets/css/style.css?v=4" rel="stylesheet" type="text/css">
</head>

<body class="bg-white body-bg">
    <main class="register-content">
        <div class="bg-img-hero position-fixed top-0 right-0 left-0">
            <figure class="position-absolute right-0 bottom-0 left-0 m-0">
                <img src="/assets/img/fig.svg" alt="Image Description">
            </figure>
        </div>
        <div class=" container py-5 py-sm-7">
            <a class="d-flex justify-content-center mb-5 news365-logo" href="">
                <img class="z-index-3" src="/assets/img/2025-02-16/h1.png" alt="Image Description">
            </a>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="">
                        <!-- alert message -->
                    </div>
                    <div class="form-card mb-5">
                        <div class="form-card_body">
                            <form action="{{ route('admin.login') }}" id="loginForm" method="post">
                                @csrf
                                <div class="text-center">
                                    <div class="mb-5">
                                        <h1 class="display-4 mt-0 font-weight-semi-bold">
                                            Sign In</h1>
                                        <p>Sign in Using Your Email Address</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="input-label font-weight-bold" for="inputEmail">Your email</label>
                                    <input type="email" name="field" autocomplete="off" id="inputEmail" placeholder="Email" required="" autofocus="" class="form-control im">
                                </div>
                                <div class="form-group">
                                    <label class="input-label font-weight-bold" for="inputPassword">Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control password" placeholder="Password" name="password" id="inputPassword" required="">
                                        <i onclick="passShow()" class="fa fa-eye-slash"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- capta part -->
                                </div>
                                {{-- <div class="form-group">
                                    <label class="input-label font-weight-bold" for="captcha">
                                    <img id="Imageid" src="/assets/img/captcha/1757620244.6212.jpg" style="width: 343; height: 64; border: 0;" alt=" "></label>
                                    <input type="captcha" placeholder="Captcha" name="captcha" id="captcha" class="form-control fs-16px" autocomplete="off">
                                </div> --}}
                                <a href="forgot-password"><p class="text-right">Forgot Password</p></a>
                                <button type="submit" class="btn btn-lg btn-block btn-success">Log In</button>
                            </form>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- jQuery -->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="/assets/plugins/jQuery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/js/login.js" type="text/javascript"></script>
    <script src="/assets/js/password.js" type="text/javascript"></script>
</body>
</html>