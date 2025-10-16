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
                                    <button class="faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                        What are the check-in and check-out times?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                <div class="card-body">
                                    Check-in time is at 2:00 PM and check-out is at 12:00 AM. Early check-in or late check-out may be available upon request, subject to availability and potential fees.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="faq-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                        Is parking available at the hotel?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                                <div class="card-body">
                                    Yes, we offer complimentary self-parking for all our guests. Valet parking is also available for a daily fee.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                        Do you allow pets?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample" style="">
                                <div class="card-body">
                                    We are a pet-friendly hotel! A non-refundable pet fee is required. Please inform us at the time of booking if you plan to bring a pet.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h2 class="mb-0">
                                    <button class="faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                        What are the restaurant's opening hours?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="card-body">
                                    Our on-site restaurant, The Royal Diner, is open for breakfast from 6:30 AM to 10:30 AM, for lunch from 12:00 PM to 2:30 PM, and for dinner from 6:00 PM to 10:00 PM.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="faq-wrap">
                    <div class="accordion" id="accordionExample1">
                        <div class="card">
                            <div class="card-header" id="headingfive">
                                <h2 class="mb-0">
                                    <button class="faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefive">
                                        Is there a swimming pool? What are its hours?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-bs-parent="#accordionExample1" style="">
                                <div class="card-body">
                                    Yes, we have a beautiful outdoor swimming pool. It is open daily from 8:00 AM to 8:00 PM for all registered guests.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingSix">
                                <h2 class="mb-0">
                                    <button class="faq-btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix">
                                        Do you offer airport shuttle services?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseSix" class="collapse show" aria-labelledby="headingSix" data-bs-parent="#accordionExample" style="">
                                <div class="card-body">
                                    We provide a complimentary airport shuttle service to and from the nearest airport. Please contact our concierge to schedule your pickup or drop-off.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingSeveen">
                                <h2 class="mb-0">
                                    <button class="faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeveen">
                                        Is Wi-Fi available in the rooms?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseSeveen" class="collapse" aria-labelledby="headingSeveen" data-bs-parent="#accordionExample" style="">
                                <div class="card-body">
                                    Yes, complimentary high-speed Wi-Fi is available in all guest rooms and public areas of the hotel.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingEighte">
                                <h2 class="mb-0">
                                    <button class="faq-btn collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEighte">
                                        What is your cancellation policy?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseEighte" class="collapse" aria-labelledby="headingEighte" data-bs-parent="#accordionExample">
                                <div class="card-body">
                                    Cancellations must be made at least 24 hours prior to your arrival date to avoid a penalty of one night's room and tax. Policies may vary for special promotions or group bookings.
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
