@extends('layouts.main')
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
                                        <li class="breadcrumb-item"><a href="https://riorelax.archielite.com">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Account information</li>
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
                                            <h1 class="text-center">Account information</h1>
                                        </div>
                                        <div class="mt-30">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card p-3 shadow-sm">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Account Information</h5>
                                                            <p class="mb-0"><strong> Name </strong>: <i>{{ Auth::user()->first_name }}  {{ Auth::user()->last_name }}</i></p>
                                                            <p class="mb-0"><strong> Email </strong>: <i>{{ Auth::user()->email }} </i></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card p-3 shadow-sm ">
                                                        <div class="card-body">
                                                            <h5 class="card-title">Account Wallets</h5>
                                                            <p class="card-text">Your account is wallet <strong>{{ Auth::user()->wallets ?? 0 }}</strong></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" aria-labelledby="avatar-modal-label"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form class="avatar-form" method="post" action="" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="avatar-modal-label">
                                        <i class="til_img"></i>
                                        <strong>Profile Image</strong>
                                    </h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="avatar-body">
                                        <div class="avatar-upload">
                                            <input class="avatar-src" name="avatar_src"  type="hidden">
                                                <input class="avatar-data" name="avatar_data"  type="hidden">
                                            <label for="avatarInput">New image</label>
                                            <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                                        </div>
                                        <div tabindex="-1" role="img" aria-label="Loading" class="loading "></div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="avatar-wrapper"></div>
                                                <div class="error-message text-danger page_speed_1224334290"></div>
                                            </div>
                                            <div class="col-md-3 avatar-preview-wrapper">
                                                <div class="avatar-preview preview-lg">
                                                    <img src=" "  alt="avatar">
                                                </div>
                                                <div class="avatar-preview preview-md">
                                                    <img src="" alt="avatar">
                                                </div>
                                                <div class="avatar-preview preview-sm">
                                                    <img src="" alt="avatar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer"><button class="btn btn-secondary" type="button"
                                        data-bs-dismiss="modal">Close</button><button class="btn btn-primary avatar-save"
                                        type="submit">Save</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
