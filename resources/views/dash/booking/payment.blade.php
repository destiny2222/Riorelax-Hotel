@extends('layouts.main')
@section('content')
    {{-- <section class="breadcrumb-area d-flex align-items-center">
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
    </section> --}}

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
                                                    class="form-control" required="" value="{{ auth()->user()->first_name ?? '' }}" aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-20">
                                                <label for="txt-last-name">Last Name <span class="required"
                                                        aria-required="true">*</span></label>
                                                <input type="text" name="last_name" id="txt-last-name"
                                                    class="form-control" required="" value="{{ auth()->user()->last_name ?? '' }}" aria-required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-20">
                                                <label for="txt-email">Email</label>
                                                <input type="email" name="email" id="txt-email" class="form-control"
                                                    value="{{ auth()->user()->email ?? '' }}">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-20">
                                                <label for="txt-phone">Phone</label>
                                                <input type="text" name="phone" id="txt-phone" class="form-control"
                                                    value="{{ auth()->user()->phone ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-info mb-20">
                                                <small>
                                                    <i class="fas fa-info-circle me-2" aria-hidden="true"></i>
                                                    <strong>Note:</strong> An OTP will be sent to verify your booking. If both phone and email are provided, SMS to the phone number will be used. If only one contact method is provided, that method will be used.
                                                </small>
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
                                                <input type="text" name="postal_code" id="txt-zip"
                                                    class="form-control" value="">
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

                                    @auth
                                        @if($discountCode && $discountCode->is_active)
                                        <div class="form-group mb-20">
                                            <label for="discount_code">Family & Friends Discount Code</label>
                                            <div class="input-group">
                                                <input type="text" name="discount_code" id="discount_code" 
                                                       class="form-control" value="{{ $discountCode->code }}" readonly>
                                                <span class="input-group-text bg-success text-white">60% OFF</span>
                                            </div>
                                            <small class="text-muted">
                                                @if($discountCode->canBeUsed())
                                                    <span class="text-success">✓ Available to use</span>
                                                @else
                                                    <span class="text-danger">Can be used again on {{ $discountCode->last_used_at->addDays(7)->format('M d, Y') }}</span>
                                                @endif
                                            </small>
                                        </div>
                                        @endif

                                        @if($walletPoints > 0)
                                        <div class="form-group mb-20">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="use_wallet_points" 
                                                       id="use_wallet_points" value="1">
                                                <label class="form-check-label" for="use_wallet_points">
                                                    Use Wallet Points (Available: ₦{{ number_format($walletPoints, 2) }})
                                                </label>
                                            </div>
                                            <input type="number" name="wallet_points_to_use" id="wallet_points_to_use" 
                                                   class="form-control mt-2" placeholder="Enter amount to use" 
                                                   max="{{ $walletPoints }}" min="0" step="0.01" style="display: none;">
                                        </div>
                                        @endif
                                    @endauth

                                    <div class="form-group mb-20">
                                        <label for="requests">Payment Plan 
                                            <i class="fas fa-info-circle text-primary ms-2" 
                                               data-bs-toggle="modal" 
                                               data-bs-target="#policyModal" 
                                               style="cursor: pointer;" 
                                               title="View Policies"></i>
                                        </label>
                                        <ul class="list-group list_payment_method" id="paymentPlanAccordion">
                                            <li class="list-group-item payment-method-item">
                                                <input class="magic-radio js_payment_plan" id="payment-reservation"
                                                    name="payment_plan" type="radio" value="reservation"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse-reservation"
                                                    checked>
                                                <label for="payment-reservation" class="form-label fw-medium">
                                                    Pay 50% Now (Reservation)
                                                </label>
                                            </li>

                                            <li class="list-group-item payment-method-item">
                                                <input class="magic-radio js_payment_plan" id="payment-full"
                                                    name="payment_plan" type="radio" value="full"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse-full">
                                                <label for="payment-full" class="form-label fw-medium">
                                                    Pay in Full
                                                </label>
                                            </li>
                                            <li class="list-group-item payment-method-item">
                                                <input class="magic-radio js_payment_plan" id="payment-no-payment"
                                                    name="payment_plan" type="radio" value="no_payment"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse-no-payment">
                                                <label for="payment-no-payment" class="form-label fw-medium">
                                                    Pay at Hotel
                                                </label>
                                                
                                            </li>
                                        </ul>
                                    </div>
                                    @guest
                                        <div class="alert alert-info">
                                            <small>
                                                <strong>Guest Booking:</strong> You're booking as a guest. We'll send your
                                                booking confirmation to the email or phone provided.
                                                You can <a style="color: #644222;font-size:15px;" href="{{ route('register') }}">sign up</a>  to manage
                                                your bookings.
                                            </small>
                                        </div>
                                    @endguest
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-filled payment-checkout-btn"
                                            data-processing-text="Processing. Please wait..."
                                            data-error-header="Error">Reservation</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 sidebar">
                            <aside>
                                <div class="wrap">
                                    <img src="{{ $booking->roomListing->room_image }}"
                                        alt="{{ $booking->roomListing->room_title }}">

                                    <div class="room-information">
                                        <span>{{ $booking->roomListing->room_title }}</span>
                                    </div>
                                </div>
                                <div class="form-information">
                                    <p class="text-center">YOUR RESERVATION</p>
                                    <div>
                                        <p>Check-In: {{ $booking->check_in_date }}</p>
                                        <p>Check-Out: {{ $booking->check_out_date }}</p>
                                        <p>Number of rooms: {{ $booking->rooms }}</p>
                                        <p>Number of adults: {{ $booking->adults }}</p>
                                        <p>Number of children: {{ $booking->children }}</p>
                                        
                                        <!-- Price Breakdown -->
                                        <hr class="my-3">
                                        @if($booking->subtotal)
                                            <!-- Show detailed breakdown if discount calculations exist -->
                                            @php
                                                $checkIn = \Carbon\Carbon::parse($booking->check_in_date);
                                                $checkOut = \Carbon\Carbon::parse($booking->check_out_date);
                                                $nights = $checkIn->diffInDays($checkOut);
                                                $roomDays = $booking->room_days ?? ($booking->rooms * $nights);
                                            @endphp
                                            
                                            <p>Room Rate: <span class="amount-text">₦{{ number_format($booking->roomListing->price, 2) }} per night</span></p>
                                            <p>Duration: <span class="amount-text">{{ $nights }} {{ $nights > 1 ? 'nights' : 'night' }} × {{ $booking->rooms }} {{ $booking->rooms > 1 ? 'rooms' : 'room' }} = {{ $roomDays }} room-days</span></p>
                                            <p>Subtotal: <span class="amount-text">₦{{ number_format($booking->subtotal, 2) }}</span></p>
                                            
                                            @if($booking->discount_amount > 0)
                                                <div class="discount-info">
                                                    <p class="mb-1">
                                                        <i class="fas fa-tag text-success"></i> 
                                                        <strong class="text-success">{{ $booking->discount_percentage }}% Discount Applied!</strong>
                                                    </p>
                                                    <p class="mb-1 discount-text">
                                                        Discount Amount: -₦{{ number_format($booking->discount_amount, 2) }}
                                                    </p>
                                                    <small class="text-white">
                                                        <i class="fas fa-info-circle"></i> You qualify for {{ $booking->discount_percentage }}% discount for booking {{ $roomDays }} room-days (5+ required)
                                                    </small>
                                                </div>
                                            @elseif($roomDays < 5)
                                                <div class="alert alert-info" style="font-size: 0.85em; padding: 8px 12px; margin: 10px 0;">
                                                    <i class="fas fa-lightbulb"></i> 
                                                    <strong>Tip:</strong> Book {{ 5 - $roomDays }} more room-days to get 10% discount! 
                                                    <small class="d-block">Current: {{ $roomDays }} room-days | Needed: 5+ room-days</small>
                                                </div>
                                            @endif
                                        @else
                                            <!-- Fallback for simple price display -->
                                            <p>Price: <span class="amount-text">₦{{ number_format($booking->roomListing->price, 2) }}</span></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-center footer">
                                    <p>Total: <span class="total-amount-text">₦{{ number_format($booking->total_amount ?? $booking->roomListing->price, 2) }}</span></p>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </section>

    <!-- Policy Information Modal -->
    <div class="modal fade" id="policyModal" tabindex="-1" aria-labelledby="policyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="policyModalLabel">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Hotel Policies & Information
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <!-- Child Policy -->
                            <div class="policy-section mb-4">
                                <h6 class="fw-bold text-primary">
                                    <i class="fas fa-child me-2"></i>Child Policy
                                </h6>
                                <ul class="list-unstyled ps-3">
                                    <li>• Children of all ages are welcome.</li>
                                    <li>• Children 12 and above will be charged as adults at this property.</li>
                                </ul>
                            </div>

                            <!-- Check In Policy -->
                            <div class="policy-section mb-4">
                                <h6 class="fw-bold text-primary">
                                    <i class="fas fa-clock me-2"></i>Check In Policy
                                </h6>
                                <ul class="list-unstyled ps-3">
                                    <li>• Guests are required to present a legal photo ID at check-in.</li>
                                    <li>• You may need to let the property know what time you'll be arriving in advance.</li>
                                </ul>
                            </div>

                            <!-- Refund Policy -->
                            <div class="policy-section mb-4">
                                <h6 class="fw-bold text-primary">
                                    <i class="fas fa-money-bill-wave me-2"></i>Refund Policy
                                </h6>
                                <ul class="list-unstyled ps-3">
                                    <li>• Guests are eligible for a <strong>90% refund</strong> if a refund request is submitted at least <strong>24 hours</strong> before the scheduled check-in time.</li>
                                    <li>• If the notice is between <strong>12 and 23 hours</strong>, a <strong>50% refund</strong> will be applicable.</li>
                                    <li>• If the notice is <strong>less than 12 hours</strong>, <strong>no refund</strong> will be applicable.</li>
                                    <li>• All approved refunds will be processed within <strong>72 hours</strong>.</li>
                                    <li>• Refund requests must be in writing and may be made both online and in person.</li>
                                </ul>
                            </div>

                            <!-- Discount Policy -->
                            <div class="policy-section mb-4">
                                <h6 class="fw-bold text-primary">
                                    <i class="fas fa-percentage me-2"></i>Discount Policy
                                </h6>
                                <p class="ps-3 mb-2">Guests are entitled to a <strong>10% discount</strong> when booking five room-days or more.</p>
                                <p class="ps-3 mb-2">This means the discount applies if you:</p>
                                <ul class="list-unstyled ps-4">
                                    <li>• Stay in one room for 5 consecutive days, or</li>
                                    <li>• Book 5 rooms for one day.</li>
                                </ul>
                            </div>

                            <!-- Pet Policy -->
                            <div class="policy-section mb-3">
                                <h6 class="fw-bold text-primary">
                                    <i class="fas fa-paw me-2"></i>Pet Policy
                                </h6>
                                <ul class="list-unstyled ps-3">
                                    <li>• We value the privacy, comfort, and convenience of all our guests.</li>
                                    <li>• At this time, pets are not allowed on the property, in order to maintain a peaceful and respectful environment for everyone.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .policy-section {
            border-left: 3px solid #007bff;
            padding-left: 15px;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        
        .policy-section h6 {
            margin-bottom: 10px;
        }
        
        .policy-section ul li {
            margin-bottom: 5px;
            line-height: 1.5;
        }
        
        .fa-info-circle:hover {
            transform: scale(1.1);
            transition: transform 0.2s ease;
        }
        
        .modal-lg {
            max-width: 800px;
        }
        
        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
        }
        
        .discount-info {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            padding: 12px;
            margin: 10px 0;
        }
        
        .price-breakdown {
            border-top: 1px solid #dee2e6;
            padding-top: 15px;
            margin-top: 15px;
        }
        
        .discount-text {
            color: #28a745 !important;
            font-weight: 600;
        }
        
        .amount-text {
            color: #007bff;
            font-weight: 500;
        }
        
        .total-amount-text {
            color: #dc3545;
            font-weight: 700;
            font-size: 1.1em;
        }
        
        .alert-info {
            background-color: #e7f3ff;
            border-color: #b3d9ff;
            color: #0c5460;
        }
        
        .form-information p {
            margin-bottom: 8px;
        }
        
        .form-information hr {
            margin: 15px 0;
            border-color: #dee2e6;
        }
    </style>
@endpush
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

            // Handle wallet points checkbox
            const useWalletCheckbox = document.getElementById('use_wallet_points');
            const walletPointsInput = document.getElementById('wallet_points_to_use');
            
            if (useWalletCheckbox && walletPointsInput) {
                useWalletCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        walletPointsInput.style.display = 'block';
                    } else {
                        walletPointsInput.style.display = 'none';
                        walletPointsInput.value = '';
                    }
                });
            }
        });
    </script>
@endpush
