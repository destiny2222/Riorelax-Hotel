@extends('layouts.main')
@section('content')
<section class="breadcrumb-area d-flex align-items-center ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-center">
                    <div class="breadcrumb-title">
                        <h2>Contact Us</h2>
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="contact" class="contact-area after-none contact-bg pt-90 pb-90 p-relative fix">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-4 order-1">
                <div class="contact-info">
                    <div class="single-cta pb-30 mb-30 wow fadeInUp  animated" data-animation="fadeInDown animated"
                        data-delay=".2s" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="float-start f-cta-icon"><i class="far fa-map"></i></div>
                        <h5>Office Address</h5>
                        <p> 380 St Kilda Road, Melbourne <br>VIC 3004, Australia </p>
                    </div>
                    <div class="single-cta pb-30 mb-30 wow fadeInUp  animated" data-animation="fadeInDown animated"
                        data-delay=".2s" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="float-start f-cta-icon"><i class="far fa-clock"></i></div>
                        <h5>Working Hours</h5>
                        <p> Monday to Friday 09:00 to 18:30 <br>Saturday 15:30 </p>
                    </div>
                    <div class="single-cta pb-30 mb-30 wow fadeInUp  animated" data-animation="fadeInDown animated"
                        data-delay=".2s" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="float-start f-cta-icon"><i class="fa fa-phone"></i></div>
                        <h5>(+1) 123 456 78</h5>
                        <p> 24/7 Customer Service And Returns Support. </p>
                    </div>
                    <div class="single-cta wow fadeInUp  animated" data-animation="fadeInDown animated" data-delay=".2s"
                        style="visibility: visible; animation-name: fadeInUp;">
                        <div class="float-start f-cta-icon"><i class="far fa-envelope-open"></i></div>
                        <h5>Message Us</h5>
                        <p> support@example.com <br>info@example.com </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 order-2">
                <div class="contact-bg02">
                    <div class="section-title center-align mb-40 text-center wow fadeInDown  animated"
                        data-animation="fadeInDown" data-delay=".4s"
                        style="visibility: visible; animation-name: fadeInDown;">
                        <h2> Get In Touch </h2>
                    </div>
                    <form method="POST" action="{{ route('contact.store') }}" accept-charset="UTF-8" id="botble-contact-forms-fronts-contact-form"
                        class="contact-form dirty-check" novalidate="novalidate">
                        @csrf
                        <div class="contact-form-row row">
                            <div class="contact-column-6 col-md-6 contact-field-name_wrapper">
                                <div class="contact-form-group"><label class="form-label form-label required"
                                        for="name"> Name </label><input class="contact-form-input"
                                        placeholder="Your Name" required="required" name="name" type="text" id="name"
                                        aria-required="true"></div>
                            </div>
                            <div class="contact-column-6 col-md-6 contact-field-email_wrapper">
                                <div class="contact-form-group"><label class="form-label form-label required"
                                        for="email"> Email </label><input class="contact-form-input"
                                        placeholder="Your Email" required="required" name="email" type="email"
                                        id="email" aria-required="true"></div>
                            </div>
                            <div class="contact-column-6 col-md-6 contact-field-address_wrapper">
                                <div class="contact-form-group"><label class="form-label" for="address"> Address
                                    </label><input class="contact-form-input" placeholder="Your Address" name="address"
                                        type="text" id="address"></div>
                            </div>
                            <div class="contact-column-6 col-md-6 contact-field-phone_wrapper">
                                <div class="contact-form-group"><label class="form-label" for="phone"> Phone
                                    </label><input class="contact-form-input" placeholder="Your Phone" name="phone"
                                        type="text" id="phone"></div>
                            </div>
                            <div class="contact-column-12 col-md-12 contact-field-subject_wrapper">
                                <div class="contact-form-group"><label class="form-label" for="subject"> Subject
                                    </label><input class="contact-form-input" placeholder="Subject" name="subject"
                                        type="text" id="subject"></div>
                            </div>
                        </div>
                        <div class="contact-form-group">
                            <label class="form-label form-label required" for="content"> Message </label>
                            <textarea class="contact-form-input form-control " rows="3" placeholder="Your Message"  required="required" id="content" name="message" cols="50"
                                aria-required="true"></textarea>
                            </div>
                        <div class="contact-form-group">
                            <input type="hidden" name="agree_terms_and_policy"  value="0">
                                <label class="required form-check">
                                    <input type="checkbox"  id="agree_terms_and_policy_243f28785407323f2c450d79cc588bc4"
                                    name="agree_terms_and_policy" class="form-check-input contact-form-input"
                                    required="required" value="1" aria-required="true">
                                    <span class="form-check-label"> I agree to the Terms and Privacy Policy </span>
                                </label>
                        </div>
                        <div class="contact-form-group">
                            <button class="contact-button text-white" type="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection