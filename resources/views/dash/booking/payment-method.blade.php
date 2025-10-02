@extends('layouts.main')
@section('content')
    <section class="breadcrumb-area d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="breadcrumb-wrap text-center">
                        <div class="breadcrumb-title">
                            <h2>Choose Payment Method</h2>
                            <div class="breadcrumb-wrap">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Booking</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Payment Method</li>
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
            <section class="checkout-booking-page">
                <div class="container pt-120 pb-40 checkout-booking">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-12 col-sm-12">
                            <form action="{{ route('dashboard.booking.payment.method.process') }}"
                                class="booking-form-main payment-checkout-form mb-50 shadow-block" method="POST">
                                @csrf
                                <div class="form-group mb-20">
                                    <label for="requests">Payment Method</label>
                                    <ul class="list-group list_payment_method">
                                        <li class="list-group-item payment-method-item">
                                            <input class="magic-radio" id="payment-bankcard" name="payment_method" type="radio" value="BankCard" checked>
                                            <label for="payment-bankcard" class="form-label fw-medium">
                                                Bank Card
                                            </label>
                                        </li>
                                        <li class="list-group-item payment-method-item">
                                            <input class="magic-radio" id="payment-banktransfer" name="payment_method" type="radio" value="BankTransfer">
                                            <label for="payment-banktransfer" class="form-label fw-medium">
                                                Bank Transfer
                                            </label>
                                        </li>
                                        <li class="list-group-item payment-method-item">
                                            <input class="magic-radio" id="payment-ussd" name="payment_method" type="radio" value="USSD">
                                            <label for="payment-ussd" class="form-label fw-medium">
                                                USSD
                                            </label>
                                        </li>
                                        <li class="list-group-item payment-method-item">
                                            <input class="magic-radio" id="payment-bankaccount" name="payment_method" type="radio" value="BankAccount">
                                            <label for="payment-bankaccount" class="form-label fw-medium">
                                                Bank Account
                                            </label>
                                        </li>
                                        <li class="list-group-item payment-method-item">
                                            <input class="magic-radio" id="payment-pos" name="payment_method" type="radio" value="POS">
                                            <label for="payment-pos" class="form-label fw-medium">
                                                POS
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-filled payment-checkout-btn">Continue</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection
