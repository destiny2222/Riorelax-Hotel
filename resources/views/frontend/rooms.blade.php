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
                        <div class="row p-0">
                           @foreach($roomListings as $roomListing)
                            <div class="col-12 col-xl-4 col-md-6">
                                <div class="single-services shadow-block mb-30 position-relative">
                                    <div class="services-thumb hover-zoomin wow fadeInUp animated">
                                        <a href="{{ route('room.show', $roomListing->slug) }}">
                                            <img src="{{ $roomListing->room_image   }}" alt="Pendora Fame">
                                        </a>
                                    </div>
                                    <div class="services-content">
                                        <div class="day-book">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('room.show', $roomListing->slug) }}"  class="book-button-custom" type="submit"
                                                        data-animation="fadeInRight" data-delay=".8s"> BOOK NOW FOR ₦{{ number_format($roomListing->price, 2) }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mb-2 ">
                                            @if ($roomListing->availability_status == 'available')
                                               <p class="availability-span"> Available </p>
                                            @else
                                                <p class="availability-span"> {{ $roomListing->availability_status }} </p>
                                            @endif
                                        </div>
                                        <h4><a href="{{ route('room.show', $roomListing->slug) }}">{{ $roomListing->room_title }}</a></h4>
                                        <p class="room-item-custom-truncate">
                                        {!!  \Str::limit($roomListing->description, 100) !!}
                                        </p>
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
