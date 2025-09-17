@extends('layouts.main')
@section('content')
    <section class="breadcrumb-area d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="breadcrumb-wrap text-center">
                        <div class="breadcrumb-title">
                            <h2>Booking</h2>
                            <div class="breadcrumb-wrap">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Booking</li>
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
                    <div class="row">
                        <div class="col-lg-8 col-md-12 col-sm-12">
                            <form action="{{ route('dashboard.booking.payment.process') }}"
                                class="booking-form-main payment-checkout-form mb-50 shadow-block" method="POST">
                                @csrf
                                <input type="hidden" name="amount" value="">
                                <input type="hidden" name="room_id" value="">
                                <input type="hidden" name="start_date" value="">
                                <input type="hidden" name="end_date" value="">
                                <input type="hidden" name="adults" value="">
                                <input name="number_of_children" type="hidden" value="">
                                <input name="rooms" type="hidden" value="">
                                <input type="hidden" name="number_of_guests" value="1">


                                <h3 class="mb-20">Your Information</h3>
                                <div class="room-booking-form p-0">

                                    <p class="mb-20">Required fields are followed by *</p>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-20">
                                                <label for="txt-first-name">First Name <span class="required"
                                                        aria-required="true">*</span></label>
                                                <input type="text" name="first_name" id="txt-first-name"
                                                    class="form-control" required="" value="" aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-20">
                                                <label for="txt-last-name">Last Name <span class="required"
                                                        aria-required="true">*</span></label>
                                                <input type="text" name="last_name" id="txt-last-name"
                                                    class="form-control" required="" value="" aria-required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-20">
                                                <label for="txt-email">Email <span class="required"
                                                        aria-required="true">*</span></label>
                                                <input type="email" name="email" id="txt-email" readonly  class="form-control @error('email') is-invalid @enderror" required=""
                                                    value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-20">
                                                <label for="txt-phone">Phone <span class="required"
                                                        aria-required="true">*</span></label>
                                                <input type="text" name="phone" id="txt-phone" class="form-control"
                                                    required="" value="" aria-required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-20">
                                                <label for="txt-country">Country</label>
                                                <input type="text" name="country" id="txt-country"
                                                    class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-20">
                                                <label for="txt-country">State / Province</label>
                                                <input type="text" name="state" id="txt-state" class="form-control"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-20">
                                                <label for="txt-city">City</label>
                                                <input type="text" name="city" id="txt-city" class="form-control"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-20">
                                                <label for="txt-address">Address</label>
                                                <input type="text" name="address" id="txt-address"
                                                    class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-20">
                                                <label for="txt-zip">Postal / Zip code</label>
                                                <input type="text" name="postal_code" id="txt-zip" class="form-control"  value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group left-icon mb-20">
                                                <label for="arrival_time">Arrival Time</label>
                                                <select name="arrival_time" id="arrival_time" class="form-select">
                                                    <option>I do not know</option>
                                                    <option>12:00 - 1:00 AM</option>
                                                    <option>1:00 - 2:00 AM</option>
                                                    <option>2:00 - 3:00 AM</option>
                                                    <option>3:00 - 4:00 AM</option>
                                                    <option>4:00 - 5:00 AM</option>
                                                    <option>5:00 - 6:00 AM</option>
                                                    <option>6:00 - 7:00 AM</option>
                                                    <option>7:00 - 8:00 AM</option>
                                                    <option>8:00 - 9:00 AM</option>
                                                    <option>9:00 - 10:00 AM</option>
                                                    <option>10:00 - 11:00 AM</option>
                                                    <option>11:00 - 12:00 AM</option>
                                                    <option>12:00 - 1:00 PM</option>
                                                    <option>1:00 - 2:00 PM</option>
                                                    <option>2:00 - 3:00 PM</option>
                                                    <option>3:00 - 4:00 PM</option>
                                                    <option>4:00 - 5:00 PM</option>
                                                    <option>5:00 - 6:00 PM</option>
                                                    <option>6:00 - 7:00 PM</option>
                                                    <option>7:00 - 8:00 PM</option>
                                                    <option>8:00 - 9:00 PM</option>
                                                    <option>9:00 - 10:00 PM</option>
                                                    <option>10:00 - 11:00 PM</option>
                                                    <option>11:00 - 12:00 PM</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-20">
                                        <label for="requests">Payment method</label>
                                        {{-- <ul class="list-group list_payment_method">
                                        <li class="list-group-item payment-method-item">
                                            <input class="magic-radio js_payment_method" id="payment-reservation"
                                                name="payment_method" type="radio" value="reservation" checked
                                                data-bs-toggle="collapse" data-bs-target="#collapse-reservation">
                                            <label for="payment-reservation" class="form-label fw-medium">
                                                Reservation (Half Payment)
                                            </label>

                                            <div id="collapse-reservation" class="collapse mt-1 show">
                                                <p class="text-muted">Pay 50% now to reserve your room. The remaining balance is due upon check-in. Your reservation will be held for 6 hours.</p>
                                            </div>
                                        </li>

                                        <li class="list-group-item payment-method-item">
                                            <input class="magic-radio js_payment_method" id="payment-full"
                                                name="payment_method" type="radio" value="full"
                                                data-bs-toggle="collapse" data-bs-target="#collapse-full">
                                            <label for="payment-full" class="form-label fw-medium">
                                                Full Payment
                                            </label>

                                            <div id="collapse-full" class="collapse mt-1">
                                                <p class="text-muted">Pay the full amount now to confirm your booking.</p>
                                            </div>
                                        </li>

                                        <li class="list-group-item payment-method-item">
                                            <input class="magic-radio js_payment_method" id="payment-no-payment"
                                                name="payment_method" type="radio" value="no_payment"
                                                data-bs-toggle="collapse" data-bs-target="#collapse-no-payment">
                                            <label for="payment-no-payment" class="form-label fw-medium">
                                                No Payment
                                            </label>

                                            <div id="collapse-no-payment" class="collapse mt-1">
                                                <p class="text-muted">Reserve your room now and pay later. Your reservation will be held for 6 hours.</p>
                                            </div>
                                        </li>
                                    </ul> --}}
                                        <ul class="list-group list_payment_method" id="paymentAccordion">

                                            <li class="list-group-item payment-method-item">
                                                <input class="magic-radio js_payment_method" id="payment-reservation"
                                                    name="payment_method" type="radio" value="reservation" 
                                                    data-bs-toggle="collapse" data-bs-target="#collapse-reservation">
                                                <label for="payment-reservation" class="form-label fw-medium">
                                                    Reservation (Half Payment)
                                                </label>

                                                <div id="collapse-reservation" class="collapse mt-1 show"
                                                    data-bs-parent="#paymentAccordion">
                                                    <p class="text-muted">Pay 50% now to reserve your room. The remaining
                                                        balance is due upon check-in. Your reservation will be held for 6
                                                        hours.</p>
                                                </div>
                                            </li>

                                            <li class="list-group-item payment-method-item">
                                                <input class="magic-radio js_payment_method" id="payment-full"
                                                    name="payment_method" type="radio" value="full"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse-full">
                                                <label for="payment-full" class="form-label fw-medium">
                                                    Full Payment
                                                </label>

                                                <div id="collapse-full" class="collapse mt-1"
                                                    data-bs-parent="#paymentAccordion">
                                                    <p class="text-muted">Pay the full amount now to confirm your booking.
                                                    </p>
                                                </div>
                                            </li>

                                            <li class="list-group-item payment-method-item">
                                                <input class="magic-radio js_payment_method" id="payment-no-payment"
                                                    name="payment_method" type="radio" value="no_payment"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse-no-payment">
                                                <label for="payment-no-payment" class="form-label fw-medium">
                                                    No Payment
                                                </label>

                                                <div id="collapse-no-payment" class="collapse mt-1"
                                                    data-bs-parent="#paymentAccordion">
                                                    <p class="text-muted">Reserve your room now and pay later. Your
                                                        reservation will be held for 6 hours.</p>
                                                </div>
                                            </li>

                                        </ul>

                                    </div>

                                    <div class="form-group mb-20 custom-checkbox d-block">
                                        <label for="terms_conditions" class="w-100">
                                            <input type="checkbox" id="terms_conditions" name="terms_conditions"
                                                value="1">
                                            Terms &amp; conditions *
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-filled payment-checkout-btn"
                                            data-processing-text="Processing. Please wait..."
                                            data-error-header="Error">Checkout</button>
                                    </div>
                                </div>
                            </form>

                            <div class="widget-content mb-50 hotel-rules shadow-block">
                                <h3 class="mb-20">Hotel rules</h3>
                                <ul>
                                    <li>No smoking, parties or events.</li>
                                    <li>Check-in time from 2 PM, check-out by 10 AM.</li>
                                    <li>Time to time car parking</li>
                                    <li>Download Our minimal app</li>
                                    <li>Browse regular our website</li>
                                </ul>
                            </div>

                            <div class="widget-content mb-50 shadow-block">
                                <h3 class="mb-20">Cancellation</h3>
                                <p>We’re pleased to offer a full refund of the booking amount for cancellations made
                                    <strong>14 days or more</strong> before the scheduled check-in date. This generous
                                    window provides you with the flexibility to adjust your plans without any financial
                                    repercussions.
                                </p>
                                <p></p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 sidebar">
                            <aside>
                                <div class="wrap">
                                    <img src="{{ $booking->roomListing->room_image }}" alt="{{ $booking->roomListing->room_title }}">

                                    <div class="room-information">
                                        <span>{{ $booking->roomListing->room_title }}</span>
                                    </div>
                                </div>
                                <div class="form-information">
                                    <p class="text-center">YOUR RESERVATION</p>
                                    <div>
                                        <p>Check-In: {{ $booking->check_in }}</p>
                                        <p>Check-Out: {{ $booking->check_out }}</p>
                                        <p>Number of rooms: {{ $booking->rooms }}</p>
                                        <p>Number of adults: {{ $booking->adults }}</p>
                                        <p>Number of children: {{ $booking->children }}</p>
                                        <p>Price: <span class="amount-text">₦{{ $booking->roomListing->price }}</span></p>
                                        {{-- <p>Discount: <span class="discount-text">$0.00</span></p> --}}
                                        {{-- <p>Tax: <span class="tax-text">$18.90</span></p> --}}
                                    </div>
                                </div>
                                <div class="text-center footer">
                                    <p>Total: <span class="total-amount-text">₦{{ $booking->roomListing->price }}</span>
                                    </p>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const radios = document.querySelectorAll(".js_payment_method");
            const collapses = document.querySelectorAll(".payment_collapse_wrap");

            radios.forEach(radio => {
                radio.addEventListener("change", function() {
                    collapses.forEach(c => c.classList.remove("show")); // hide all
                    const selected = radio.closest("li").querySelector(".payment_collapse_wrap");
                    if (selected) selected.classList.add("show"); // show only selected
                });
            });
        });
    </script>
@endpush
