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
                        <p> 7, Commercial Avenue, off Ikpokpan Road, GRA, Benin City </p>
                    </div>
                    <div class="single-cta pb-30 mb-30 wow fadeInUp  animated" data-animation="fadeInDown animated"
                        data-delay=".2s" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="float-start f-cta-icon"><i class="fa fa-phone"></i></div>
                        <h5><a href="tel:+2348180000104" class="phone-link" data-contact-url="{{ route('contact') }}" style="color: inherit; text-decoration: none;">+2348180000104</a></h5>
                        <p> 24/7 Customer Service And Returns Support. </p>
                    </div>
                    <div class="single-cta wow fadeInUp  animated" data-animation="fadeInDown animated" data-delay=".2s"
                        style="visibility: visible; animation-name: fadeInUp;">
                        <div class="float-start f-cta-icon"><i class="far fa-envelope-open"></i></div>
                        <h5>Message Us</h5>
                        <p><a href="mailto:info@house7.com.ng" style="color: inherit; text-decoration: none;">info@house7.com.ng</a></p>
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
                    <form method="POST" action="{{ route('contact.store') }}" accept-charset="UTF-8" id="contact-form"
                        class="contact-form validate" novalidate>
                        @csrf
                        <div class="contact-form-row row">
                            <div class="contact-column-6 col-md-6 contact-field-name_wrapper">
                                <div class="contact-form-group">
                                    <label class="form-label form-label required" for="name"> Name </label>
                                    <input class="contact-form-input @error('name') is-invalid @enderror"
                                        placeholder="Your Name" required name="name" type="text" id="name"
                                        value="{{ old('name') }}" minlength="2" maxlength="255"
                                        pattern="[A-Za-z\s]{2,255}" title="Name should contain only letters and spaces, minimum 2 characters">
                                    @error('name')
                                        <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="contact-column-6 col-md-6 contact-field-email_wrapper">
                                <div class="contact-form-group">
                                    <label class="form-label form-label required" for="email"> Email </label>
                                    <input class="contact-form-input @error('email') is-invalid @enderror"
                                        placeholder="Your Email" required name="email" type="email"
                                        id="email" value="{{ old('email') }}" maxlength="255"
                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address">
                                    @error('email')
                                        <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="contact-column-6 col-md-6 contact-field-address_wrapper">
                                <div class="contact-form-group">
                                    <label class="form-label" for="address"> Address </label>
                                    <input class="contact-form-input @error('address') is-invalid @enderror" 
                                        placeholder="Your Address" name="address" type="text" id="address" 
                                        value="{{ old('address') }}" maxlength="500">
                                    @error('address')
                                        <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="contact-column-6 col-md-6 contact-field-phone_wrapper">
                                <div class="contact-form-group">
                                    <label class="form-label" for="phone"> Phone </label>
                                    <input class="contact-form-input @error('phone') is-invalid @enderror" 
                                        placeholder="Your Phone" name="phone" type="tel" id="phone" 
                                        value="{{ old('phone') }}" maxlength="20"
                                        pattern="[\+]?[0-9\s\-\(\)]{10,20}" title="Please enter a valid phone number">
                                    @error('phone')
                                        <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="contact-column-12 col-md-12 contact-field-subject_wrapper">
                                <div class="contact-form-group">
                                    <label class="form-label" for="subject"> Subject </label>
                                    <input class="contact-form-input @error('subject') is-invalid @enderror" 
                                        placeholder="Subject" name="subject" type="text" id="subject" 
                                        value="{{ old('subject') }}" maxlength="255">
                                    @error('subject')
                                        <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="contact-form-group">
                            <label class="form-label form-label required" for="content"> Message </label>
                            <textarea class="contact-form-input form-control @error('message') is-invalid @enderror" 
                                rows="3" placeholder="Your Message" required id="content" name="message" 
                                cols="50" minlength="10" maxlength="1000">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                            @enderror
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

@push('scripts')
<script>
$(document).ready(function() {
    // Enhanced email validation
    function validateEmail(email) {
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailRegex.test(email);
    }

    // Real-time validation for email
    $('#email').on('input blur', function() {
        const email = $(this).val().trim();
        const $field = $(this);
        const $feedback = $field.siblings('.invalid-feedback');
        
        if (email === '') {
            $field.removeClass('is-invalid is-valid');
            $feedback.hide();
        } else if (!validateEmail(email)) {
            $field.removeClass('is-valid').addClass('is-invalid');
            if ($feedback.length === 0) {
                $field.after('<div class="invalid-feedback d-block text-danger">Please enter a valid email address.</div>');
            } else {
                $feedback.text('Please enter a valid email address.').show();
            }
        } else {
            $field.removeClass('is-invalid').addClass('is-valid');
            $feedback.hide();
        }
    });







    // Form submission validation
    $('#contact-form').on('submit', function(e) {
        let isValid = true;
        
        // Validate email format
        const email = $('#email').val().trim();
        if (email && !validateEmail(email)) {
            $('#email').addClass('is-invalid');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            swal('Please correct the errors in the form before submitting.');
            return false;
        }
    });
});
</script>
@endpush

@endsection