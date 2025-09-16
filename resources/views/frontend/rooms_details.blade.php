@extends('layouts.main')
@section('content')
    <section class="breadcrumb-area d-flex align-items-center ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="breadcrumb-wrap text-center">
                        <div class="breadcrumb-title">
                            <h2>Pacific Room</h2>
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
                        <div class="col-sm-12 col-md-12 col-lg-4 order-2">
                            <aside class="sidebar services-sidebar">
                                <div class="sidebar-widget categories">
                                    <div class="widget-content">
                                        <h2 class="widget-title">Booking form</h2>
                                        <div class="booking">
                                            <div class="contact-bg">
                                                <form action="{{ route('dashboard.booking.store') }}" method="POST"  class="contact-form mt-30 form-booking">
                                                    @csrf
                                                    <input type="hidden" name="room_listing_id"  value="{{ $roomListing->id }}" />
                                                    <div class="row booking-area">
                                                        <div class="col-lg-12">
                                                            <div class="contact-field p-relative c-name mb-20">
                                                                <label for="room-detail-booking-form-start-date">
                                                                    <i class="fal fa-badge-check"></i>
                                                                    Check In Date
                                                                </label>
                                                                <input type="text"  id="room-detail-booking-form-start-date"   class="departure-date date-picker" autocomplete="off"
                                                                    data-date-format="dd-mm-yyyy" placeholder="10-09-2025"  data-locale="en"  name="check_in" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="contact-field p-relative c-subject mb-20">
                                                                <label for="room-detail-booking-form-end-date"><i  class="fal fa-times-octagon"></i>
                                                                    Check  Out Date
                                                                </label>
                                                                <input type="text" id="room-detail-booking-form-end-date" class="arrival-date date-picker" autocomplete="off"
                                                                    data-date-format="dd-mm-yyyy" placeholder="11-09-2025" data-locale="en"  name="check_out" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="contact-field p-relative c-subject input-group input-group-two left-icon mb-20">
                                                                <label for="adults"><i class="fal fa-users"></i>Adults</label>
                                                                <div class="input-quantity">
                                                                    <button type="button" class="main-btn btn"  data-bb-toggle="decrement-room">  -</button>
                                                                    <input type="number" id="adults"   name="adults" readonly="" value="1"  min="1" max="10" />
                                                                    <button  type="button" class="main-btn btn" data-bb-toggle="increment-room">
                                                                        +
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div
                                                                class="contact-field p-relative c-subject input-group input-group-two left-icon mb-20">
                                                                <label for="children"><i  class="fal fa-child"></i>Children</label>
                                                                <div class="input-quantity">
                                                                    <button type="button" class="main-btn btn"  data-bb-toggle="decrement-room"> -</button>
                                                                    <input type="number" id="children" name="children" readonly="" value="0"  min="0" max="10" />
                                                                    <button  type="button" class="main-btn btn"  data-bb-toggle="increment-room">
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
                                                                    <button type="button" class="main-btn btn" data-bb-toggle="decrement-room">  -</button>
                                                                    <input type="number" id="rooms"  name="rooms" readonly="" value="1"   min="1" max="10" />
                                                                    <button type="button" class="main-btn btn" data-bb-toggle="increment-room">
                                                                        +
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="slider-btn mt-15">
                                                                <button type="submit" class="btn ss-btn"  data-animation="fadeInRight" data-delay=".8s">
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
                                    <a href="tel:917052101786" title="Call now">917052101786</a>
                                </div>
                            </aside>
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 order-1">
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
                                                <span>${{ $roomListing->price }} <small>/ night</small></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ck-content">
                                        {!!  $roomListing->description !!}
                                    </div>
                                    <div class="room-block-content shadow-block mt-50 amenities-list">
                                        <h3>Amenities</h3>
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-6 col-12 d-flex align-items-center mb-3">
                                                <img width="20px" class="d-block" src="" lt="Air conditioner" />
                                                <span class="ms-2">Air conditioner</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="room-block-content shadow-block">
                                        <div class="hotel-rules-box">
                                            <h3>Hotel Rules</h3>
                                            <ul>
                                                <li>No smoking, parties or events.</li>
                                                <li>Check-in time from 2 PM, check-out by 10 AM.</li>
                                                <li>Time to time car parking</li>
                                                <li>Download Our minimal app</li>
                                                <li>Browse regular our website</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="room-block-content shadow-block">
                                        <h3>Cancellation</h3>
                                        <p>
                                            We’re pleased to offer a full refund of the booking
                                            amount for cancellations made
                                            <strong>14 days or more</strong> before the scheduled
                                            check-in date. This generous window provides you with
                                            the flexibility to adjust your plans without any
                                            financial repercussions.
                                        </p>
                                        <p></p>
                                    </div>
                                    <div class="room-block-content shadow-block mt-50">
                                        <div>
                                            <div>
                                                <h3 class="text-xl">Write a review</h3>
                                                <form action="{{ route('dashboard.comment.store') }}" method="post" class="space-y-3 review-form">
                                                    @csrf
                                                    <input type="hidden" name="room_id"  value="{{ $roomListing->id }}" />
                                                    <input type="hidden" name="rating" value="1">
                                                    <div class="text-start mb-20">
                                                        {{-- <div class="br-wrapper br-theme-css-stars">
                                                            <select name="star" id="select-star" style="display: none;">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5" selected="">5</option>
                                                            </select>
                                                            <div class="br-widget">
                                                                <a href="#" data-rating-value="1" data-rating-text="1" class="br-selected"></a>
                                                                <a  href="#" data-rating-value="2" data-rating-text="2" class="br-selected"></a>
                                                                <a href="#"  data-rating-value="3" data-rating-text="3" class="br-selected"></a>
                                                                <a href="#" data-rating-value="4" data-rating-text="4" class="br-selected"></a>
                                                                <a href="#" data-rating-value="5" data-rating-text="5"  class="br-selected br-current"></a>
                                                                <div class="br-current-rating">5</div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                    <textarea placeholder="Enter your message" class="form-control" name="review" id="review" cols="30" rows="10" disabled=""></textarea>
                                                    </div>
                                                    <p class="text-danger">
                                                        Please log in to write review!
                                                    </p>
                                                    <button type="submit" class="custom-submit-review-btn mb-20"
                                                        disabled="">
                                                        Submit review
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="pt-8 mt-8 border-top">
                                                <div class="d-flex justify-content-between mt-10 mb-20 reviews-block">
                                                    <h4 class="">
                                                        <span class="reviews-count">5 Review(s)</span>
                                                    </h4>
                                                    <div class="loading-spinner d-none"></div>
                                                    <div class="d-flex items-center">
                                                        <p class="">4.8 out of 5</p>
                                                        <div class="rating-wrap ms-1">
                                                            <div class="rating">
                                                                <div class="review-rate page_speed_1653396412"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="reviews-list mb-20 mt-10"
                                                    data-url="https://riorelax.archielite.com/customer/ajax/review/pacific-room?">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content-box related-room">
                                        <h3>Related Rooms</h3>
                                        <div class="row">
                                            <div class="col-lg-6 mb-20">
                                                <div class="single-services shadow-block mb-30 ser-m">
                                                    <div class="services-thumb hover-zoomin wow fadeInUp animated">
                                                        <a href="">
                                                            <img src="" alt="Luxury Hall Of Fame" />
                                                        </a>
                                                    </div>
                                                    <div class="services-content">
                                                        <div class="day-book">
                                                            <ul>
                                                                <li>
                                                                    <form action=""  method="POST">
                                                                       <input type="hidden" name="room_id" value="1" />
                                                                       <input type="hidden" name="start_date" value="10-09-2025" />
                                                                       <input type="hidden"  name="end_date" value="11-09-2025" />
                                                                       <input  type="hidden" name="adults" value="1" />
                                                                       <input name="children"  type="hidden" value="0" />
                                                                       <input name="rooms" type="hidden" value="1" />
                                                                       <button  class="book-button-custom" type="submit" data-animation="fadeInRight" data-delay=".8s">
                                                                            BOOK NOW FOR $189.00
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <h4>
                                                            <a href="">Luxury Hall Of Fame</a>
                                                        </h4>
                                                        <p class="room-item-custom-truncate"
                                                            title="Our spacious room offers a cozy ambiance, modern amenities, and stunning city views.">
                                                            Our spacious room offers a cozy ambiance, modern
                                                            amenities, and stunning city views.
                                                        </p>
                                                        <div class="icon">
                                                            <ul class="d-flex justify-content-evenly">
                                                                <li>
                                                                    <img src="" alt="Air conditioner" />
                                                                </li>
                                                            </ul>
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
