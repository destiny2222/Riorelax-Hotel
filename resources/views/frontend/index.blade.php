@extends('layouts.main')
@section('content')

<div class="ck-content">
    <section id="home" class="slider-area fix p-relative">
        <div class="slider-active ">
            <!-- Slide 1 -->
            <div class="single-slider slider-bg d-flex align-items-center slider-bg-01">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-7 col-md-7">
                            <div class="slider-content s-slider-content mt-80 text-center">
                                <h2 data-animation="fadeInUp" data-delay=".4s">Welcome to House7</h2>
                                <p data-animation="fadeInUp" data-delay=".6s">
                                    Experience comfort, elegance, and relaxation at House7. 
                                    Your perfect stay awaits with exceptional service.
                                </p>
                                <div class="slider-btn mt-30 mb-105">
                                    <a href="#booking-form" class="btn ss-btn active mr-15" data-animation="fadeInLeft" data-delay=".4s">
                                        Book Your Stay
                                    </a>
                                    {{-- <a href="#" data-animation="fadeInUp" data-delay=".8s" tabindex="0" class="video-i popup-video ">
                                        <i class="fas fa-play"></i> Watch Intro
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="single-slider slider-bg d-flex align-items-center slider-bg-02">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-7 col-md-7">
                            <div class="slider-content s-slider-content mt-80 text-center">
                                <h2 data-animation="fadeInUp" data-delay=".4s"> Comfort Redefined at House7</h2>
                                <p data-animation="fadeInUp" data-delay=".6s">
                                    Whether for business or leisure, House7 offers a unique blend of style, 
                                    comfort, and hospitality to make your stay unforgettable.
                                </p>
                                <div class="slider-btn mt-30 mb-105">
                                    <a href="#about" class="btn ss-btn active mr-15" data-animation="fadeInLeft" data-delay=".4s">
                                        Discover More
                                    </a>
                                    {{-- <a href="#booking-form" data-animation="fadeInUp" data-delay=".8s" tabindex="0" class="video-i popup-video ">
                                        <i class="fas fa-play"></i> Virtual Tour
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <div class="booking-area homepage p-relative" id="booking-form">
        <div class="container">
            <form action="{{ route('check-availability') }}" method="GET" class="contact-form mt-30 form-booking">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-6 mb-30">
                        <div class="contact-field p-relative c-name">
                            <label for="availability-form-start-date"><i class="fal fa-badge-check"></i>Check In Date</label>
                            <input id="availability-form-start-date" autocomplete="off" type="text"  class="departure-date date-picker" data-date-format="dd-mm-yyyy"
                                placeholder="select check in date" data-locale="en" value="" name="check_in_date">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-30">
                        <div class="contact-field p-relative c-name">
                            <label for="availability-form-end-date"><i class="fal fa-times-octagon"></i>Check Out Date</label>
                            <input type="text" id="availability-form-end-date" autocomplete="off" class="arrival-date date-picker"
                                data-date-format="dd-mm-yyyy" placeholder="select check out date" data-locale="en"  value="" name="check_out_date">
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 mb-30">
                        <div class="contact-field p-relative c-name form-guests-and-rooms-wrapper">
                            <label for="adults"><i class="fal fa-users"></i>Guests and Rooms</label>
                            <button  data-bb-toggle="toggle-guests-and-rooms" class="text-truncate" type="button" data-target="#toggle-guests-and-rooms">
                                <span data-bb-toggle="filter-adults-count"class="me-1">1</span> 
                                Adult(s) , <span data-bb-toggle="filter-children-count"  class="ms-1 me-1">0</span> 
                                Child(ren), <span data-bb-toggle="filter-rooms-count" class="me-1 ms-1">1</span> Room(s) 
                            </button>
                            <div class="custom-dropdown dropdown-menu p-3" id="toggle-guests-and-rooms">
                                <div class="inputs-filed">
                                    <label for="adults">Adults</label>
                                    <div class="input-quantity">
                                        <button type="button" class="main-btn btn" data-bb-toggle="decrement-room">-</button>
                                        <input type="number" id="adults"  name="adults"  value="1" min="1" max="10">
                                        <button type="button"   class="main-btn btn" data-bb-toggle="increment-room">+</button>
                                    </div>
                                </div>
                                <div class="inputs-filed mt-30">
                                    <label for="children">Children</label>
                                    <div class="input-quantity">
                                        <button type="button" class="main-btn btn"  data-bb-toggle="decrement-room">-</button>
                                        <input type="number" id="children"  name="children"  value="0" min="0" max="10">
                                        <button type="button"  class="main-btn btn" data-bb-toggle="increment-room">+</button>
                                    </div>
                                </div>
                                <div class="inputs-filed mt-30">
                                    <label for="rooms">Rooms</label>
                                    <div class="input-quantity">
                                        <button type="button" class="main-btn btn" data-bb-toggle="decrement-room">-</button>
                                        <input type="number" id="rooms"  name="rooms"  value="1" min="1" max="10">
                                        <button type="button" class="main-btn btn" data-bb-toggle="increment-room">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="slider-btn">
                            <button type="submit" class="btn ss-btn" data-animation="fadeInRight"  data-delay=".8s"> 
                                Check Availability 
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <section class="about-area about-p pt-90 pb-90 p-relative fix" id="about">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="s-about-img p-relative wow fadeInLeft animated" data-animation="fadeInLeft"
                        data-delay=".4s"><img src="/images/about-img-02.jpg"
                            alt="">
                        {{-- <div class="about-icon"><img src="/images/about-img-03.jpg" width="500" height="500"
                                alt=""></div> --}}
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="about-content s-about-content wow fadeInRight animated pl-30"
                        data-animation="fadeInRight" data-delay=".4s">
                        <div class="about-title second-title pb-25">
                            <h5>About House7</h5>
                            <h2>Your Home of Comfort in Benin City</h2>
                        </div>
                        <p>
                            House 7, Donnet Place, is new concept in the Hospitality Industry located in the very exquisite and serene Commercial Avenue of the GRA in Benin City, Edo State.
                            We offer tastefully furnished rooms, suites and apartments in a very tranquil and peaceful environment with lush greenery. 
                            We take pride in offering a perfect blend of modern , comfort, and warm Nigerian hospitality. 
                            Whether you’re here for business, leisure, or a weekend getaway, House7 provides a serene atmosphere 
                            and exceptional service to make your stay unforgettable. <br><br>
                            From elegantly designed rooms to top-notch facilities, House7 is more than just a place to stay.
                            We invite you to come and experience a “homely home away from home” at House 7!!.
                        </p>
                        <div class="about-content3 mt-30">
                            <div class="row justify-content-center align-items-center">
                                {{-- <div class="col-md-12">
                                    <ul class="green mb-30">
                                        <li>Located in the heart of Benin City, Edo State.</li>
                                        <li>Elegant rooms designed for relaxation and comfort.</li>
                                        <li>Exceptional Nigerian hospitality and world-class service.</li>
                                    </ul>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="slider-btn">
                                        <a href="/about" class="btn ss-btn smoth-scroll">DISCOVER MORE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="service-details2" class="pt-90 pb-90 p-relative ">
        <div class="animations-01"><img src="/images/backgrounds/an-img-01.png" alt="Background image"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title center-align mb-50 text-center">
                        <h2>House7  Amenities</h2>
                        <p>
                            At House7 in Benin City, we offer modern facilities designed to give you comfort, security, and 
                            a truly relaxing stay. Whether you are here for business or leisure, our amenities ensure a 
                            memorable experience.
                        </p>
                    </div>
                </div>

                <!-- Air Conditioner -->
                <div class="col-lg-4 col-md-6">
                    <div class="services-08-item mb-30">
                        <div class="services-icon2"><img src="/images/amenities/icon-5.png" alt="Air Conditioner"></div>
                        <div class="services-08-thumb"><img src="/images/amenities/icon-5.png" alt="Air Conditioner"></div>
                        <div class="services-08-content">
                            <h3>Air Conditioner</h3>
                            <p>Stay cool and refreshed with fully air-conditioned rooms designed for your comfort.</p>
                        </div>
                    </div>
                </div>

                <!-- High Speed WiFi -->
                <div class="col-lg-4 col-md-6">
                    <div class="services-08-item mb-30">
                        <div class="services-icon2"><img src="/images/amenities/icon-5.png" alt="High Speed WiFi"></div>
                        <div class="services-08-thumb"><img src="/images/amenities/icon-5.png" alt="High Speed WiFi"></div>
                        <div class="services-08-content">
                            <h3>High Speed WiFi</h3>
                            <p>Enjoy seamless internet access throughout  work, streaming, and connection.</p>
                        </div>
                    </div>
                </div>

                <!-- Strong Locker -->
                <div class="col-lg-4 col-md-6">
                    <div class="services-08-item mb-30">
                        <div class="services-icon2"><img src="/images/amenities/icon-3.png" alt="Strong Locker"></div>
                        <div class="services-08-thumb"><img src="/images/amenities/icon-3.png" alt="Strong Locker"></div>
                        <div class="services-08-content">
                            <h3>Government & Security Proximity</h3>
                            <p>
                                Located just 300 meters from the Police Headquarters and within close reach to the Government House, DSS, and the 44 Brigade Headquarters of the Nigerian Army
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Breakfast -->
                <div class="col-lg-4 col-md-6">
                    <div class="services-08-item mb-30">
                        <div class="services-icon2"><img src="/images/amenities/icon-2.png" alt="Breakfast"></div>
                        <div class="services-08-thumb"><img src="/images/amenities/icon-2.png" alt="Breakfast"></div>
                        <div class="services-08-content">
                            <h3>Close to Airport</h3>
                            <p>Reach your destination with ease — less than 5 minutes’ drive from the airport.</p>
                        </div>
                    </div>
                </div>

                <!-- Kitchen -->
                <div class="col-lg-4 col-md-6">
                    <div class="services-08-item mb-30">
                        <div class="services-icon2"><img src="/images/amenities/icon-2.png" alt="Kitchen"></div>
                        <div class="services-08-thumb"><img src="/images/amenities/icon-2.png" alt="Kitchen"></div>
                        <div class="services-08-content">
                            <h3>Modern Kitchen</h3>
                            <p>Enjoy access to a modern kitchen setup with quality dining services available.</p>
                        </div>
                    </div>
                </div>

                <!-- Smart Security -->
                <div class="col-lg-4 col-md-6">
                    <div class="services-08-item mb-30">
                        <div class="services-icon2"><img src="/images/amenities/icon-6.png" alt="Smart Security"></div>
                        <div class="services-08-thumb"><img src="/images/amenities/icon-6.png" alt="Smart Security"></div>
                        <div class="services-08-content">
                            <h3>Smart Security</h3>
                            <p>Feel safe with our 24/7 smart security systems and professional staff assistance.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="services-area pt-90 pb-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="section-title center-align mb-50 text-center">
                        <h5>The Pleasure of Comfort & Style</h5>
                        <h2>Our Rooms & Suites</h2>
                        <p>
                            At House7 in Benin City, we offer beautifully designed rooms and suites that combine 
                            modern elegance with warm hospitality. Each space is thoughtfully crafted to provide 
                            ultimate comfort, whether you’re here for business, leisure, or a weekend escape.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row services-active">
                @foreach($roomListings as $roomListing)
                <div class="col-xl-4 col-md-6">
                    <div class="single-services shadow-block mb-30">
                        <div class="services-thumb hover-zoomin wow fadeInUp animated">
                            <a href="{{ route('room.show', $roomListing->slug) }}">
                                <img src="{{ $roomListing->room_image   }}" alt="Pendora Fame">
                            </a>
                        </div>
                        <div class="services-content">
                            <div class="day-book">
                                <ul>
                                    <li>
                                        {{-- <form action="" method="POST">
                                            <input type="hidden" name="room_id" value="2">
                                            <input type="hidden" name="start_date" value="10-09-2025">
                                            <input type="hidden" name="end_date" value="11-09-2025">
                                            <input type="hidden" name="adults" value="1">
                                            <input name="children" type="hidden" value="0">
                                            <input name="rooms" type="hidden" value="1"> --}}
                                            <a href="{{ route('room.show', $roomListing->slug) }}" class="book-button-custom" type="submit"
                                                data-animation="fadeInRight" data-delay=".8s"> BOOK NOW FOR
                                                ₦{{ number_format($roomListing->price, 2) }}
                                            </a>
                                        {{-- </form> --}}
                                    </li>
                                </ul>
                            </div>
                            <h4><a
                                    href="{{ route('room.show', $roomListing->slug) }}">{{ $roomListing->room_title }}</a>
                            </h4>
                            <div class="mb-2 ">
                                @if ($roomListing->availability_status == 'available')
                                    <p class="availability-span"> Available </p>
                                @else
                                    <p class="availability-span"> {{ $roomListing->availability_status }} </p>
                                @endif
                            </div>
                            <p class="room-item-custom-truncate">
                                {!! \Str::limit($roomListing->description, 100) !!}
                            </p>
                            <div class="icon">
                                <ul class="d-flex justify-content-evenly">
                                    {{-- <li><img src="/images/amenities/icon-5.png" alt="Air conditioner"></li>
                                        <li><img src="/images/amenities/icon-5.png" alt="High speed WiFi"></li>
                                        <li><img src="/images/amenities/icon-3.png" alt="Strong Locker"></li>
                                        <li><img src="/images/amenities/icon-2.png" alt="Breakfast"></li>
                                        <li><img src="/images/amenities/icon-2.png" alt="Kitchen"></li>
                                        <li><img src="/images/amenities/icon-6.png" alt="Smart Security"></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="feature-area2 p-relative fix"> 
        <div class="animations-02">
            <img src="/images/backgrounds/an-img-02.png" alt="Background image">
        </div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                
                <!-- Image from RoomListing -->
                <div class="col-lg-6 col-md-12 col-sm-12 pr-30">
                    <div class="feature-img">
                        <img src="{{ $latestRoom->room_image ?? '/images/general/feature.jpg' }}" 
                            alt="{{ $latestRoom->room_title ?? 'Room Image' }}" 
                            class="img">
                    </div>
                </div>

                <!-- Content from RoomListing -->
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="feature-content s-about-content">
                        <div class="feature-title pb-20">
                            <h5>{{ $latestRoom->room_type ?? '  Resort' }}</h5>
                            <h2>{{ $latestRoom->room_title ?? 'House7 ' }}</h2>
                        </div>
                        <p>
                            {!! $latestRoom->description ?? 'Experience  and comfort at House7 in Benin City.' !!}
                        </p>
                        <a href="{{ route('room.show', $latestRoom->slug ?? '') }}" class="btn ss-btn smoth-scroll">Discover More</a>
                    </div>
                </div>

            </div>
        </div>
    </section>


   




</div>

@endsection
@push('scripts')
    <script src="{{ asset('themes/js/dropdown.js') }}"></script>
@endpush
