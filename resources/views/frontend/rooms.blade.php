@extends('layouts.main')
@section('content')
<section class="breadcrumb-area d-flex align-items-center page_speed_1468011964">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-center">
                    <div class="breadcrumb-title">
                        <h2>Rooms</h2>
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Rooms
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
        <section class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="services-area pt-20 pb-40">
                        {{-- <h3 class="mb-20">8 rooms available</h3> --}}
                        <div class="row">
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
                                                        <input type="hidden" name="room_id"  value="2">
                                                        <input type="hidden" name="start_date" value="10-09-2025">
                                                        <input type="hidden" name="end_date" value="11-09-2025">
                                                        <input type="hidden" name="adults"   value="1">
                                                        <input name="children" type="hidden" value="0">
                                                        <input  name="rooms" type="hidden" value="1"> --}}
                                                        <a href="{{ route('room.show', $roomListing->slug) }}"  class="book-button-custom" type="submit"
                                                            data-animation="fadeInRight" data-delay=".8s"> BOOK NOW FOR ₦{{ number_format($roomListing->price, 2) }}
                                                        </a>
                                                    {{-- </form> --}}
                                                </li>
                                            </ul>
                                        </div>
                                        <h4><a href="{{ route('room.show', $roomListing->slug) }}">{{ $roomListing->room_title }}</a></h4>
                                        <p class="room-item-custom-truncate">
                                        {!!  \Str::limit($roomListing->description, 100) !!}
                                        </p>
                                        <div class="icon">
                                            <ul class="d-flex justify-content-evenly">
                                                {{-- <li><img src="storage/amenities/icon-5.png" alt="Air conditioner"></li>
                                                <li><img src="storage/amenities/icon-5.png" alt="High speed WiFi"></li>
                                                <li><img src="storage/amenities/icon-3.png" alt="Strong Locker"></li>
                                                <li><img src="storage/amenities/icon-2.png" alt="Breakfast"></li>
                                                <li><img src="storage/amenities/icon-2.png" alt="Kitchen"></li>
                                                <li><img src="storage/amenities/icon-6.png" alt="Smart Security"></li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection