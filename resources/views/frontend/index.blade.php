@extends('layouts.main')
@section('content')

<div class="ck-content">
    <section id="home" class="slider-area fix p-relative">
        <div class="slider-active ">
            <div class="single-slider slider-bg d-flex align-items-center slider-bg-01">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-7 col-md-7">
                            <div class="slider-content s-slider-content mt-80 text-center">
                                <h2 data-animation="fadeInUp" data-delay=".4s">Enjoy A Luxury Experience</h2>
                                <p data-animation="fadeInUp" data-delay=".6s">Donec vitae libero non enim placerat
                                    eleifend aliquam erat volutpat. Curabitur diam ex, dapibus purus sapien, cursus
                                    sed nisl tristique, commodo gravida lectus non.</p>
                                <div class="slider-btn mt-30 mb-105"><a href="/contact"
                                        class="btn ss-btn active mr-15" data-animation="fadeInLeft" data-delay=".4s">
                                        Discover More </a><a href="#"
                                        data-animation="fadeInUp" data-delay=".8s" tabindex="0"
                                        class="video-i popup-video "><i class="fas fa-play"></i>
                                        Intro video </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-slider slider-bg d-flex align-items-center slider-bg-02">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-7 col-md-7">
                            <div class="slider-content s-slider-content mt-80 text-center">
                                <h2 data-animation="fadeInUp" data-delay=".4s">Enjoy A Luxury Experience</h2>
                                <p data-animation="fadeInUp" data-delay=".6s">Donec vitae libero non enim placerat
                                    eleifend aliquam erat volutpat. Curabitur diam ex, dapibus purus sapien, cursus
                                    sed nisl tristique, commodo gravida lectus non.</p>
                                <div class="slider-btn mt-30 mb-105"><a href="/contact"
                                        class="btn ss-btn active mr-15" data-animation="fadeInLeft" data-delay=".4s">
                                        Discover More </a><a href="#"
                                        data-animation="fadeInUp" data-delay=".8s" tabindex="0"
                                        class="video-i popup-video "><i class="fas fa-play"></i>
                                        Intro video </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="booking-area homepage p-relative">
        <div class="container">
            <form action="{{ route('check-availability') }}" method="GET" class="contact-form mt-30 form-booking">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-6 mb-30">
                        <div class="contact-field p-relative c-name">
                            <label for="availability-form-start-date"><i class="fal fa-badge-check"></i>Check In Date</label>
                            <input id="availability-form-start-date" autocomplete="off" type="text"  class="departure-date date-picker" data-date-format="dd-mm-yyyy"
                                placeholder="select check in date" data-locale="en" value="" name="start_date">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-30">
                        <div class="contact-field p-relative c-name">
                            <label for="availability-form-end-date"><i class="fal fa-times-octagon"></i>Check Out Date</label>
                            <input type="text" id="availability-form-end-date" autocomplete="off" class="arrival-date date-picker"
                                data-date-format="dd-mm-yyyy" placeholder="select check out date" data-locale="en"  value="" name="end_date">
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
    <section class="about-area about-p pt-90 pb-90 p-relative fix">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="s-about-img p-relative wow fadeInLeft animated" data-animation="fadeInLeft"
                        data-delay=".4s"><img src="/images/about-img-02.jpg"
                            alt="Most Safe &amp; Rated Hotel In London.">
                        <div class="about-icon"><img src="/images/about-img-03.png"
                                alt="Most Safe &amp; Rated Hotel In London."></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="about-content s-about-content wow fadeInRight animated pl-30"
                        data-animation="fadeInRight" data-delay=".4s">
                        <div class="about-title second-title pb-25">
                            <h5>About Us</h5>
                            <h2>Most Safe &amp; Rated Hotel In London.</h2>
                        </div>
                        <p> At About Us, we take pride in offering the most secure and top-rated hotels in London.
                            Your safety and comfort are our priorities, which is why our meticulous selection
                            process ensures each hotel meets stringent quality standards. Whether you’re visiting
                            for business or leisure, trust us to provide you with a stay that combines the utmost
                            security and exceptional service.<br><br>Experience London like never before with our
                            curated list of accommodations that boast prime locations and unmatched safety measures.
                            From charming boutique hotels to Luxuryous city-center options, we’ve done the
                            groundwork to present you with a variety of choices that guarantee a worry-free stay.
                            Choose About Us for a memorable trip enriched with both the allure of London. </p>
                        <div class="about-content3 mt-30">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-12">
                                    <ul class="green mb-30">
                                        <li>Discover the epitome of safe haven in our top-rated London hotels.</li>
                                        <li>Immerse yourself in the heart of London’s charm.</li>
                                        <li>Experience the perfect blend of luxury and comfort.</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <div class="slider-btn"><a href="/about"
                                            class="btn ss-btn smoth-scroll">DISCOVER MORE</a></div>
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
                        <h5>Explore</h5>
                        <h2>The Hotel</h2>
                        <p>Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque
                            viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper
                            dolor iaculis vel</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-08-item mb-30">
                        <div class="services-icon2"><img src="/images/amenities/icon-5.png" alt="Air conditioner">
                        </div>
                        <div class="services-08-thumb"><img src="/images/amenities/icon-5.png" alt="Air conditioner">
                        </div>
                        <div class="services-08-content">
                            <h3>Air conditioner</h3>
                            <p
                                title="Pariatur incidunt soluta quod veritatis. Aut et a et qui et. Qui soluta non est eaque omnis magnam nihil vero.">
                                Pariatur incidunt soluta quod veritatis. Aut et a et qui et. Qui soluta non est...
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-08-item mb-30">
                        <div class="services-icon2"><img src="/images/amenities/icon-5.png" alt="High speed WiFi">
                        </div>
                        <div class="services-08-thumb"><img src="/images/amenities/icon-5.png" alt="High speed WiFi">
                        </div>
                        <div class="services-08-content">
                            <h3>High speed WiFi</h3>
                            <p title="Enim id eos ipsam et porro. Sint rerum sed commodi cupiditate neque in debitis.">
                                Enim id eos ipsam et porro. Sint rerum sed commodi cupiditate neque in debitis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-08-item mb-30">
                        <div class="services-icon2"><img src="/images/amenities/icon-3.png" alt="Strong Locker">
                        </div>
                        <div class="services-08-thumb"><img src="/images/amenities/icon-3.png" alt="Strong Locker">
                        </div>
                        <div class="services-08-content">
                            <h3>Strong Locker</h3>
                            <p
                                title="Doloremque repudiandae unde eum quis autem. Sint voluptatem eaque rem ducimus. Quos harum quos qui.">
                                Doloremque repudiandae unde eum quis autem. Sint voluptatem eaque rem ducimus. Q...
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-08-item mb-30">
                        <div class="services-icon2"><img src="/images/amenities/icon-2.png" alt="Breakfast"></div>
                        <div class="services-08-thumb"><img src="/images/amenities/icon-2.png" alt="Breakfast">
                        </div>
                        <div class="services-08-content">
                            <h3>Breakfast</h3>
                            <p
                                title="Fugit necessitatibus quasi omnis. Voluptatum ea optio velit amet. Asperiores est sunt id necessitatibus est error.">
                                Fugit necessitatibus quasi omnis. Voluptatum ea optio velit amet. Asperiores est...
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-08-item mb-30">
                        <div class="services-icon2"><img src="/images/amenities/icon-2.png" alt="Kitchen"></div>
                        <div class="services-08-thumb"><img src="/images/amenities/icon-2.png" alt="Kitchen"></div>
                        <div class="services-08-content">
                            <h3>Kitchen</h3>
                            <p
                                title="Aut odit et aut ut id. Harum non corporis sequi ex quae. Illum inventore totam sapiente.">
                                Aut odit et aut ut id. Harum non corporis sequi ex quae. Illum inventore totam s...
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services-08-item mb-30">
                        <div class="services-icon2"><img src="/images/amenities/icon-6.png" alt="Smart Security">
                        </div>
                        <div class="services-08-thumb"><img src="/images/amenities/icon-6.png" alt="Smart Security">
                        </div>
                        <div class="services-08-content">
                            <h3>Smart Security</h3>
                            <p
                                title="Ut ut aliquam repudiandae ex occaecati. Totam ut ullam rerum. Aut atque voluptas praesentium in.">
                                Ut ut aliquam repudiandae ex occaecati. Totam ut ullam rerum. Aut atque voluptas...
                            </p>
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
                        <h5>The Pleasure Of Luxury</h5>
                        <h2>Rooms &amp; Suites</h2>
                        <p>Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque
                            viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper
                            dolor iaculis vel</p>
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

    <section class="feature-area2 p-relative fix ">
        <div class="animations-02"><img src="/images/backgrounds/an-img-02.png" alt="Background image"></div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 col-md-12 col-sm-12 pr-30">
                    <div class="feature-img"><img src="/images/general/feature.jpg" alt="Image" class="img"></div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="feature-content s-about-content">
                        <div class="feature-title pb-20">
                            <h5>Luxury Hotel &amp; Resort</h5>
                            <h2>Pearl Of The Adriatic.</h2>
                        </div>
                        <p>Vestibulum non ornare nunc. Maecenas a metus in est iaculis pretium. Aliquam ullamcorper
                            nibh lacus, ac suscipit ipsum consequat porttitor.Aenean vehicula ligula eu rhoncus
                            porttitor. Duis vel lacinia quam. Nunc rutrum porta ex, in imperdiet tortor feugiat at.
                            Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus vitae lorem at,
                            egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh, quis posuere
                            felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius ante
                            eget.</p><a href="/contact" class="btn ss-btn smoth-scroll">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="pricing" class="pricing-area pt-90 pb-60 fix p-relative">
        <div class="animations-01"><img src="/images/backgrounds/an-img-01.png" alt="Background image 1"></div>
        <div class="animations-02"><img src="/images/backgrounds/an-img-02.png" alt="Background image 2"></div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-4 col-md-12">
                    <div class="section-title mb-20">
                        <h5>Best Prices</h5>
                        <h2>Extra Services</h2>
                    </div>
                    <p>Proin consectetur non dolor vitae pulvinar. Pellentesque sollicitudin dolor eget neque
                        viverra, sed interdum metus interdum. Cras lobortis pulvinar dolor, sit amet ullamcorper
                        dolor iaculis vel Cras finibus laoreet felis et hendrerit. Integer ligula lorem, finibus
                        vitae lorem at, egestas consectetur urna. Integer id ultricies elit. Maecenas sodales nibh,
                        quis posuere felis. In commodo mi lectus venenatis metus eget fringilla. Suspendisse varius
                        ante eget.</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-box pricing-box2 mb-60">
                        <div class="pricing-head">
                            <h3>Room cleaning</h3>
                            <p>Perfect for early-stage startups</p>
                            <div class="month">Monthly</div>
                            <div class="price-count">
                                <h2>₦39.99</h2>
                            </div>
                            <hr>
                        </div>
                        <div class="pricing-body mt-20 mb-30 text-start">
                            <ul>
                                <li>Hotel quis justo at lorem</li>
                                <li> Fusce sodales urna et tempus</li>
                                <li> Vestibulum blandit lorem quis</li>
                            </ul>
                        </div>
                        <div class="pricing-btn"><a href="/contact" class="btn ss-btn">Get Started<i
                                    class="fal fa-angle-right"></i></a></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-box pricing-box2 mb-60">
                        <div class="pricing-head">
                            <h3>Drinks included</h3>
                            <p>Perfect for early-stage startups</p>
                            <div class="month">Monthly</div>
                            <div class="price-count">
                                <h2>₦59.99</h2>
                            </div>
                            <hr>
                        </div>
                        <div class="pricing-body mt-20 mb-30 text-start">
                            <ul>
                                <li>Hotel quis justo at lorem</li>
                                <li> Fusce sodales urna et tempus</li>
                                <li> Vestibulum blandit lorem quis</li>
                            </ul>
                        </div>
                        <div class="pricing-btn"><a href="/contact" class="btn ss-btn">Get Started <i
                                    class="fal fa-angle-right"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="booking pt-90 pb-90 p-relative fix">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="contact-bg02">
                        <div class="section-title center-align">
                            <h5>Make Reservation</h5>
                            <h2>Book A Room</h2>
                        </div>
                        <form action="{{ route('booking') }}" method="post"
                            class="contact-form mt-30 form-booking">
                            @csrf
                            <input type="hidden" name="children" value="1">
                            <input type="hidden" name="rooms" value="1">
                            <input type="hidden" name="name" value="john">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="contact-field p-relative c-name mb-20"><label
                                            for="booking-form-start-date"><i class="fal fa-badge-check"></i>Check In
                                            Date</label><input type="text" id="booking-form-start-date"
                                            autocomplete="off" class="departure-date date-picker"
                                            data-date-format="dd-mm-yyyy" placeholder="select check in date" data-locale="en"
                                            value="" name="check_in"></div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="contact-field p-relative c-subject mb-20"><label
                                            for="booking-form-end-date"><i class="fal fa-times-octagon"></i>Check
                                            Out Date</label><input type="text" id="booking-form-end-date"
                                            autocomplete="off" class="arrival-date date-picker"
                                            data-date-format="dd-mm-yyyy" placeholder="select check out date" data-locale="en"
                                            value="" name="check_out"></div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="contact-field p-relative c-subject mb-20"><label for="adults"><i
                                                class="fal fa-users"></i>Guests</label><select name="adults"
                                            id="adults">
                                            <option value="1" >1 Guest</option>
                                            <option value="2" >2 Guests</option>
                                            <option value="3" >3 Guests</option>
                                            <option value="4" >4 Guests</option>
                                            <option value="5" >5 Guests</option>
                                            <option value="6" >6 Guests</option>
                                            <option value="7" >7 Guests</option>
                                            <option value="8" >8 Guests</option>
                                            <option value="9" >9 Guests</option>
                                            <option value="10" >10 Guests</option>
                                        </select></div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="contact-field p-relative c-option mb-20">
                                        <label for="room"><i class="fal fa-concierge-bell"></i>Room</label>
                                        <select name="room_listing_id" id="room">
                                            @foreach ($roomListings as $roomListing)
                                                <option value="{{ $roomListing->id }}">{{ $roomListing->room_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="slider-btn mt-15">
                                        <button type="submit" class="btn ss-btn"  data-animation="fadeInRight" data-delay=".8s">
                                            <span>Book now</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="booking-img"><img src="/images/general/booking-img.png" alt="Image"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="video-area pt-150 pb-150 p-relative ">
        <div class="content-lines-wrapper2">
            <div class="content-lines-inner2">
                <div class="content-lines2"></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="s-video-wrap">
                        <div class="s-video-content"><a href="#"
                                class="popup-video"><img src="/themes/images/play-button.png" alt="Button play"></a>
                        </div>
                    </div>
                    <div class="section-title center-align text-center">
                        <h2>Take A Tour Of Luxury</h2>
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
