@extends('layouts.main')
@section('content')
<section class="breadcrumb-area d-flex align-items-center ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-center">
                    <div class="breadcrumb-title">
                        <h2>{{ $roomListing->room_title }}</h2>
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ $roomListing->room_title }}
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
        <div class="about-area5 about-p p-relative room-details">
            <div class="container pt-60 pb-40">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-4 order-1 order-lg-2">
                        <aside class="sidebar services-sidebar">
                            <div class="sidebar-widget categories">
                                <div class="widget-content">
                                    <h2 class="widget-title">Booking form</h2>
                                    <div class="booking">
                                        <div class="contact-bg">
                                            <form action="{{ route('dashboard.booking.store') }}" method="POST"
                                                class="contact-form mt-30 form-booking">
                                                @csrf
                                                <input type="hidden" name="room_listing_id"
                                                    value="{{ $roomListing->id }}" />
                                                <div class="row booking-area">
                                                    <div class="col-lg-12">
                                                        <div class="contact-field p-relative c-name mb-20">
                                                            <label for="room-detail-booking-form-start-date">
                                                                <i class="fal fa-badge-check"></i>
                                                                Check In Date
                                                            </label>
                                                            <input type="text" id="room-detail-booking-form-start-date"
                                                                class="departure-date date-picker" autocomplete="off"
                                                                data-date-format="dd-mm-yyyy"
                                                                placeholder="select check in date" data-locale="en"
                                                                name="check_in" value="{{ $availabilityData['start_date'] ?? '' }}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="contact-field p-relative c-subject mb-20">
                                                            <label for="room-detail-booking-form-end-date"><i
                                                                    class="fal fa-times-octagon"></i>
                                                                Check Out Date
                                                            </label>
                                                            <input type="text" id="room-detail-booking-form-end-date"
                                                                class="arrival-date date-picker" autocomplete="off"
                                                                data-date-format="dd-mm-yyyy"
                                                                placeholder="select check out date" data-locale="en"
                                                                name="check_out" value="{{ $availabilityData['end_date'] ?? '' }}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div
                                                            class="contact-field p-relative c-subject input-group input-group-two left-icon mb-20">
                                                            <label for="adults"><i
                                                                    class="fal fa-users"></i>Adults</label>
                                                            <div class="input-quantity">
                                                                <button type="button" class="main-btn btn"
                                                                    data-bb-toggle="decrement-room"> -</button>
                                                                <input type="number" id="adults" name="adults"
                                                                    readonly="" value="{{ $availabilityData['adults'] ?? 1 }}" min="1" max="10" />
                                                                <button type="button" class="main-btn btn"
                                                                    data-bb-toggle="increment-room">
                                                                    +
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div
                                                            class="contact-field p-relative c-subject input-group input-group-two left-icon mb-20">
                                                            <label for="children"><i
                                                                    class="fal fa-child"></i>Children</label>
                                                            <div class="input-quantity">
                                                                <button type="button" class="main-btn btn"
                                                                    data-bb-toggle="decrement-room"> -</button>
                                                                <input type="number" id="children" name="children"
                                                                    readonly="" value="{{ $availabilityData['children'] ?? 0 }}" min="0" max="10" />
                                                                <button type="button" class="main-btn btn"
                                                                    data-bb-toggle="increment-room">
                                                                    +
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div
                                                            class="contact-field p-relative c-subject input-group input-group-two left-icon mb-20">
                                                            <label for="rooms"><i class="fal fa-hotel"></i>Rooms</label>
                                                            <div class="input-quantity">
                                                                <button type="button" class="main-btn btn"
                                                                    data-bb-toggle="decrement-room"> -</button>
                                                                <input type="number" id="rooms" name="rooms" readonly=""
                                                                    value="{{ $availabilityData['rooms'] ?? 1 }}" min="1" max="10" />
                                                                <button type="button" class="main-btn btn"
                                                                    data-bb-toggle="increment-room">
                                                                    +
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @guest
                                                    <div class="col-lg-12">
                                                        <div class="contact-field p-relative c-name mb-20">
                                                            <label for="name">
                                                                <i class="fal fa-user"></i>
                                                                Name
                                                            </label>
                                                            <input type="text" id="name" name="name"
                                                                class="form-control" placeholder="Enter your name"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="contact-field p-relative c-name mb-20">
                                                            <label for="email">
                                                                <i class="fal fa-envelope"></i>
                                                                Email (Optional)
                                                            </label>
                                                            <input type="email" id="email" name="email"
                                                                class="form-control"
                                                                placeholder="Enter your email (optional)">
                                                        </div>
                                                    </div>
                                                    @endguest
                                                    <div class="col-lg-12">
                                                        <div class="slider-btn mt-15">
                                                            <button type="submit" class="btn ss-btn"
                                                                data-animation="fadeInRight" data-delay=".8s">
                                                                <span>Book Now</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="service-detail-contact wow fadeup-animation" data-wow-delay="1.1s">
                                <h3 class="h3-title">If You Need Any Help Contact Us</h3>
                                <a href="tel:+2347055353419" title="Call now">+234 705 535 3419</a>
                            </div>
                        </aside>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 order-2 order-lg-1">
                        <div class="service-detail">
                            <div class="thumb">
                                <div class="room-details-slider">
                                    @foreach($roomListing->room_images as $image)
                                    <a href="{{ $image }}">
                                        <img src="{{ $image }}" alt="{{ $roomListing->room_title }}" />
                                    </a>
                                    @endforeach
                                </div>

                                <div class="room-details-slider-nav">
                                    @foreach($roomListing->room_images as $image)
                                    <img src="{{ $image }}" alt="{{ $roomListing->room_title }}" />
                                    @endforeach
                                </div>
                            </div>
                            <div class="content-box">
                                <div class="row align-items-center mb-50">
                                    <div class="col-12">
                                        <div class="price">
                                            <h2>{{ $roomListing->room_title }}</h2>
                                            <span>₦{{ number_format($roomListing->price, 2) }} <small>/
                                                    night</small></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="ck-content">
                                    {!! $roomListing->description !!}
                                </div>
                                {{-- <div class="room-block-content shadow-block mt-50 amenities-list">
                                        <h3>Amenities</h3>
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-6 col-12 d-flex align-items-center mb-3">
                                                <img width="20px" class="d-block" src="" lt="Air conditioner" />
                                                <span class="ms-2">Air conditioner</span>
                                            </div>
                                        </div>
                                    </div> --}}
                                <div class="room-block-content shadow-block">
                                    <div class="accordion" id="hotelPolicyAccordion">

                                            <!-- Check-in -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingCheckin">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseCheckin"
                                                        aria-expanded="true" aria-controls="collapseCheckin">
                                                        <i class="bi bi-box-arrow-in-right me-2"></i> Check-in
                                                    </button>
                                                </h2>
                                                <div id="collapseCheckin" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingCheckin"
                                                    data-bs-parent="#hotelPolicyAccordion">
                                                    <div class="accordion-body">
                                                        From <strong>2:00 PM</strong> to <strong>12:00 AM</strong><br>
                                                        Guests are required to show a photo ID and credit card at
                                                        check-in.<br>
                                                        You need to let the property know what time you'll be arriving
                                                        in advance.
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Check-out -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingCheckout">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseCheckout"
                                                        aria-expanded="false" aria-controls="collapseCheckout">
                                                        <i class="bi bi-box-arrow-left me-2"></i> Check-out
                                                    </button>
                                                </h2>
                                                <div id="collapseCheckout" class="accordion-collapse collapse"
                                                    aria-labelledby="headingCheckout"
                                                    data-bs-parent="#hotelPolicyAccordion">
                                                    <div class="accordion-body">
                                                        From <strong>8:00 AM</strong> to <strong>12:00 PM</strong>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Cancellation -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingCancel">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseCancel"
                                                        aria-expanded="false" aria-controls="collapseCancel">
                                                        <i class="bi bi-info-circle me-2"></i> Cancellation / Prepayment
                                                    </button>
                                                </h2>
                                                <div id="collapseCancel" class="accordion-collapse collapse"
                                                    aria-labelledby="headingCancel"
                                                    data-bs-parent="#hotelPolicyAccordion">
                                                    <div class="accordion-body">
                                                        Cancellation and prepayment policies vary according to
                                                        accommodation type.
                                                        <a href="#">Enter your stay dates</a> and check the conditions
                                                        of your selected option.
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Children & Beds -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingChildren">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseChildren"
                                                        aria-expanded="false" aria-controls="collapseChildren">
                                                        <i class="bi bi-people me-2"></i> Children & Beds
                                                    </button>
                                                </h2>
                                                <div id="collapseChildren" class="accordion-collapse collapse"
                                                    aria-labelledby="headingChildren"
                                                    data-bs-parent="#hotelPolicyAccordion">
                                                    <div class="accordion-body">
                                                        <h6>Child policies</h6>
                                                        <p>Children of all ages are welcome.<br>Children 4 and above
                                                            will be charged as adults at this property.</p>

                                                        <h6>Crib and extra bed policies</h6>
                                                        <ul class="list-group mb-2">
                                                            <li class="list-group-item d-flex justify-content-between">
                                                                <span>0 - 2 years</span>
                                                                <span><i class="bi bi-basket2 me-2"></i> Crib upon
                                                                    request - <strong>Free</strong></span>
                                                            </li>
                                                        </ul>
                                                        <p>The number of cribs allowed depends on the option you choose.
                                                            There are no extra beds available at this property.
                                                            All cribs are subject to availability.</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Age restriction -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingAge">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseAge"
                                                        aria-expanded="false" aria-controls="collapseAge">
                                                        <i class="bi bi-person-badge me-2"></i> Age restriction
                                                    </button>
                                                </h2>
                                                <div id="collapseAge" class="accordion-collapse collapse"
                                                    aria-labelledby="headingAge" data-bs-parent="#hotelPolicyAccordion">
                                                    <div class="accordion-body">The minimum age for check-in is 18</div>
                                                </div>
                                            </div>

                                            <!-- Pets -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingPets">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapsePets"
                                                        aria-expanded="false" aria-controls="collapsePets">
                                                        <i class="bi bi-paw me-2"></i> Pets
                                                    </button>
                                                </h2>
                                                <div id="collapsePets" class="accordion-collapse collapse"
                                                    aria-labelledby="headingPets"
                                                    data-bs-parent="#hotelPolicyAccordion">
                                                    <div class="accordion-body">
                                                        ✅ Pets are allowed. No extra charges.
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Groups -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingGroups">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseGroups"
                                                        aria-expanded="false" aria-controls="collapseGroups">
                                                        <i class="bi bi-people-fill me-2"></i> Groups
                                                    </button>
                                                </h2>
                                                <div id="collapseGroups" class="accordion-collapse collapse"
                                                    aria-labelledby="headingGroups"
                                                    data-bs-parent="#hotelPolicyAccordion">
                                                    <div class="accordion-body">
                                                        When booking more than 3 rooms, different policies and
                                                        additional fees may apply.
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Payments -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingPayment">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapsePayment"
                                                        aria-expanded="false" aria-controls="collapsePayment">
                                                        <i class="bi bi-credit-card me-2"></i> Accepted payment methods
                                                    </button>
                                                </h2>
                                                <div id="collapsePayment" class="accordion-collapse collapse"
                                                    aria-labelledby="headingPayment"
                                                    data-bs-parent="#hotelPolicyAccordion">
                                                    <div class="accordion-body">
                                                        <img src="https://img.icons8.com/color/48/visa.png" alt="Visa"
                                                            width="40">
                                                        <img src="https://img.icons8.com/color/48/mastercard.png"
                                                            alt="MasterCard" width="40">
                                                        <img src="https://img.icons8.com/color/48/amex.png" alt="Amex"
                                                            width="40">
                                                        <img src="https://img.icons8.com/color/48/cash.png" alt="Cash"
                                                            width="40">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Smoking -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingSmoking">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseSmoking"
                                                        aria-expanded="false" aria-controls="collapseSmoking">
                                                        <i class="bi bi-slash-circle me-2"></i> Smoking
                                                    </button>
                                                </h2>
                                                <div id="collapseSmoking" class="accordion-collapse collapse"
                                                    aria-labelledby="headingSmoking"
                                                    data-bs-parent="#hotelPolicyAccordion">
                                                    <div class="accordion-body">🚭 Smoking is not allowed.</div>
                                                </div>
                                            </div>

                                        </div>
                                </div>
                                <div class="room-block-content shadow-block mt-50">
                                    <div>
                                        {{-- <div class="mb-20">
                                                <h3 class="text-xl">Write a review</h3>
                                                <form action="{{ route('dashboard.comment.store') }}" method="post"
                                        class="space-y-3 review-form">
                                        @csrf
                                        <input type="hidden" name="room_id" value="{{ $roomListing->id }}" />
                                        <input type="hidden" name="rating" value="1">
                                        <div class="text-start mb-20">
                                        </div>
                                    </div>
                                    @guest
                                    <textarea placeholder="Enter your message" class="form-control" name="comment"
                                        id="review" cols="30" disabled rows="10"></textarea>
                                    <p class="text-danger">
                                        Please log in to write review!
                                    </p>
                                    @else
                                    <textarea placeholder="Enter your message" class="form-control" name="comment"
                                        id="review" cols="30" rows="10"></textarea>
                                    @endguest
                                </div>
                                @guest
                                <button type="submit" class="custom-submit-review-btn mb-20 mt-5" disabled="">
                                    Submit review
                                </button>
                                @else
                                <button type="submit" class="custom-submit-review-btn mb-20 mt-5">
                                    Submit review
                                </button>
                                @endguest
                                </form>
                            </div> --}}
                            {{-- <div class="pt-8 mt-8 border-top">
                                                <div class="d-flex justify-content-between mt-10 mb-20 reviews-block">
                                                    <h4 class="">
                                                        <span class="reviews-count">5 Review(s)</span>
                                                    </h4>
                                                    <div class="loading-spinner d-none"></div>
                                                    <div class="d-flex items-center">
                                                        <p class="">4.8 out of 5</p>
                                                        <div class="rating-wrap ms-1">
                                                            <div class="rating">
                                                                <div class="review-rate "></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="reviews-list mb-20 mt-10"  data-url="">

                                                </div>
                                            </div> --}}
                        </div>
                    </div>
                    <div class="content-box related-room">
                        <h3>Related Rooms</h3>
                        <div class="row">
                            @foreach ($relatedRooms as $relatedRoom)
                            <div class="col-lg-6 mb-20">
                                <div class="single-services shadow-block mb-30 ser-m">
                                    <div class="services-thumb hover-zoomin wow fadeInUp animated">
                                        <a href="{{ route('room.show', $relatedRoom->slug) }}">
                                            <img src="{{ $relatedRoom->room_image }}" alt=" Hall Of Fame" />
                                        </a>
                                    </div>
                                    <div class="services-content">
                                        <div class="day-book">
                                            <ul>
                                                <li>
                                                    {{-- <form action=""  method="POST">
                                                                        <input type="hidden" name="room_id" value="1" />
                                                                        <input type="hidden" name="start_date" value="10-09-2025" />
                                                                        <input type="hidden"  name="end_date" value="11-09-2025" />
                                                                        <input  type="hidden" name="adults" value="1" />
                                                                        <input name="children"  type="hidden" value="0" />
                                                                        <input name="rooms" type="hidden" value="1" /> --}}
                                                    <a href="{{ route('room.show', $relatedRoom->slug) }}"
                                                        class="book-button-custom" type="submit"
                                                        data-animation="fadeInRight" data-delay=".8s">
                                                        BOOK NOW FOR ₦{{ number_format($relatedRoom->price, 2) }}
                                                    </a>
                                                    {{-- </form> --}}
                                                </li>
                                            </ul>
                                        </div>
                                        <h4>
                                            <a
                                                href="{{ route('room.show', $relatedRoom->slug) }}">{{ $relatedRoom->room_title }}</a>
                                        </h4>
                                        <p class="room-item-custom-truncate">
                                            {!! \Str::limit($relatedRoom->description, 100) !!}
                                        </p>
                                        {{-- <div class="icon">
                                                                <ul class="d-flex justify-content-evenly">
                                                                    <li>
                                                                        <img src="" alt="Air conditioner" />
                                                                    </li>
                                                                </ul>
                                                            </div> --}}
                                    </div>
                                </div>
                            </div>
                            @endforeach

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
    $('.room-details-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.room-details-slider-nav'
    });
    $('.room-details-slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.room-details-slider',
        dots: false,
        arrows: false,
        centerMode: false,
        focusOnSelect: true
    });
    // Increment and Decrement functionality
    $(document).ready(function() {
        // Handle increment buttons
        $('[data-bb-toggle="increment-room"]').on('click', function() {
            var inputField = $(this).siblings('input[type="number"]');
            var currentValue = parseInt(inputField.val());
            var maxValue = parseInt(inputField.attr('max'));
            if (currentValue < maxValue) {
                inputField.val(currentValue + 1);
            }
        });
        // Handle decrement buttons
        $('[data-bb-toggle="decrement-room"]').on('click', function() {
            var inputField = $(this).siblings('input[type="number"]');
            var currentValue = parseInt(inputField.val());
            var minValue = parseInt(inputField.attr('min'));
            if (currentValue > minValue) {
                inputField.val(currentValue - 1);
            }
        });
    });
</script>
@endpush
