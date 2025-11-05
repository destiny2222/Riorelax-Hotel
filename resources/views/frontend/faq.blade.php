@extends('layouts.main')
@section('content')
    <section class="breadcrumb-area d-flex align-items-center page_speed_1468011964">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="breadcrumb-wrap text-center">
                        <div class="breadcrumb-title">
                            <h2>Faq</h2>
                            <div class="breadcrumb-wrap">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="/">Home</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Faq
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

    <section id="faq" class="faq-area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="faq-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="faq-btn collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne">
                                            What are the check-in and check-out times?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        Check-in time is at 2:00 PM and check-out is at 12:00 Noon. Early check-in or late
                                        check-out may be available upon request, subject to availability and potential fees.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="faq-btn" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo">
                                            Is parking available at the hotel?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        Yes, we offer complimentary self-parking for all our guests.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="faq-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="faq-btn collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree">
                                            Do you allow pets?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-bs-parent="#accordionExample" style="">
                                    <div class="card-body">
                                        We value the privacy, comfort, and convenience of all our guests. At this time, pets
                                        are not allowed on the property, in order to maintain a peaceful and respectful
                                        environment for everyone.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFour">
                                    <h2 class="mb-0">
                                        <button class="faq-btn collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseFour">
                                            What are the restaurant's opening hours?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                    data-bs-parent="#accordionExample">
                                    <div class="card-body">
                                        Our on-site restaurant is open for breakfast, lunch and dinner from 6:30 AM to 10:00
                                        PM daily.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="faq-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingfive">
                                    <h2 class="mb-0">
                                        <button class="faq-btn collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapsefive">
                                            Is Wi-Fi available in the rooms?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapsefive" class="collapse" aria-labelledby="headingfive"
                                    data-bs-parent="#accordionExample1" style="">
                                    <div class="card-body">
                                        Yes, complimentary high-speed Wi-Fi is available in all guest rooms and public areas
                                        within House 7.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="faq-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingSix">
                                    <h2 class="mb-0">
                                        <button class="faq-btn" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSix">
                                            What is your refund policy?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                                    data-bs-parent="#accordionExample1" style="">
                                    <div class="card-body">
                                        <ul>
                                            <li>Guests are eligible for a 90% refund if a refund request is submitted at
                                                least 24 hours before the scheduled check-in time.</li>
                                            <li>If the notice is between 12 and 23 hours, a 50% refund will be applicable.
                                            </li>
                                            <li>If the notice is less than 12 hours, no refund will be applicable.</li>
                                            <li>All approved refunds will be processed within 72 hours.</li>
                                            <li>Refund requests must be in writing and may be made both online and in
                                                person.</li>
                                        </ul>
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
