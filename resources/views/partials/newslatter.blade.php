<section class="newslater-area p-relative pt-90 pb-90">
    <div class="animations-01">
        <img src="/images/an-img-07.png"
            alt="Get Best Offers On The Hotel"></div>
    <div class="container">
        <div class="row justify-content-center align-items-center text-center">
            <div class="col-xl-9 col-lg-9">
                <div class="section-title center-align mb-40 text-center wow fadeInDown  animated"
                    data-animation="fadeInDown" data-delay=".4s"
                    style="visibility: visible; animation-name: fadeInDown;">
                    <h5>Newsletter</h5>
                    <h2> Get Best Offers On The Hotel </h2>
                    <p>With the subscription, enjoy your favourite Hotels without having to think about it</p>
                </div>
                <form name="ajax-form" id="newsletter-form" dir="ltr" action="" method="POST"
                    class="newslater newsletter-form validate">
                    @csrf
                    <div class="form-group">
                        <input class="form-control @error('email') is-invalid @enderror" 
                               id="newsletter-email" name="email" type="email" 
                               placeholder="Your Email Address" required
                               value="{{ old('email') }}"
                               pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                               title="Please enter a valid email address">
                        @error('email')
                            <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-custom" id="send2">Subscribe Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>