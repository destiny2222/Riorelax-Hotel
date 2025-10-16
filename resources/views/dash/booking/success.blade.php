@extends('layouts.main')
@section('content')
<section class="breadcrumb-area d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-center">
                    <div class="breadcrumb-title">
                        <h2>Booking Successful</h2>
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Success
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

<section class="pt-80 pb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="success-card">
                    <div class="success-card-header text-center mb-40">
                        <div class="success-icon mb-20">
                            <i class="fal fa-check-circle"></i>
                        </div>
                        <h3 class="success-title">Booking Successful!</h3>
                        <p class="success-subtitle">Your booking has been confirmed</p>
                    </div>

                    {{-- <div class="text-center">
                        <img src="{{ session('qrcode') }}" alt="QR Code">
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
