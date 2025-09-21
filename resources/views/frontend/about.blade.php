@extends('layouts.main')
@section('content')
<section class="breadcrumb-area d-flex align-items-center ">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-xl-12 col-lg-12">
        <div class="breadcrumb-wrap text-center">
          <div class="breadcrumb-title">
            <h2>About Us</h2>
            <div class="breadcrumb-wrap">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="/">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    About Us
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

<section class="about-area about-p pt-90 pb-90 p-relative fix">
  <div class="animations-02">
    <img src="/images/backgrounds/an-img-02.png" alt="Most Safe &amp; Rated Hotel In London." />
  </div>
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="s-about-img p-relative wow fadeInLeft animated" data-animation="fadeInLeft" data-delay=".4s">
          <img src="/images/about-img-02.png" alt="Most Safe &amp; Rated Hotel In London." />
          <div class="about-icon">
            <img src="/images/about-img-03.png" alt="Most Safe &amp; Rated Hotel In London." />
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="about-content s-about-content wow fadeInRight animated pl-30" data-animation="fadeInRight"
          data-delay=".4s">
          <div class="about-title second-title pb-25">
            <h5>About Us</h5>
            <h2>Most Safe &amp; Rated Hotel In London.</h2>
          </div>
          <p>
            At About Us, we take pride in offering the most secure and
            top-rated hotels in London. Your safety and comfort are our
            priorities, which is why our meticulous selection process
            ensures each hotel meets stringent quality standards. Whether
            you’re visiting for business or leisure, trust us to provide
            you with a stay that combines the utmost security and
            exceptional service.<br /><br />Experience London like never
            before with our curated list of accommodations that boast
            prime locations and unmatched safety measures. From charming
            boutique hotels to Luxuryous city-center options, we’ve done
            the groundwork to present you with a variety of choices that
            guarantee a worry-free stay. Choose About Us for a memorable
            trip enriched with both the allure of London.
          </p>
          <div class="about-content3 mt-30">
            <div class="row justify-content-center align-items-center">
              <div class="col-md-12">
                <ul class="green mb-30">
                  <li>
                    Discover the epitome of safe haven in our top-rated
                    London hotels.
                  </li>
                  <li>
                    Immerse yourself in the heart of London’s charm.
                  </li>
                  <li>
                    Experience the perfect blend of luxury and comfort.
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="skill" class="skill-area p-relative fix ">
  <div class="animations-01">
    <img src="/images/backgrounds/an-img-05.png" alt="We Offer Wide Selection of Hotel" />
  </div>
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="skills-content s-about-content">
          <div class="skills-title pb-20">
            <h5>Rio We Use</h5>
            <h2>We Offer Wide Selection of Hotel</h2>
          </div>
          <p>
            Explore a variety of handpicked hotels with Rio We Use. Your
            ideal stay is just a click away. Book now for an unforgettable
            experience.
          </p>
          <div class="skills-content s-about-content mt-20">
            <div class="skills">
              <div class="skill mb-30">
                <div class="skill-name">Quality Production</div>
                <div class="skill-bar">
                  <div class="skill-per" id="80"></div>
                </div>
              </div>
              <div class="skill mb-30">
                <div class="skill-name">Maintenance Services</div>
                <div class="skill-bar">
                  <div class="skill-per" id="90"></div>
                </div>
              </div>
              <div class="skill mb-30">
                <div class="skill-name">Product Management</div>
                <div class="skill-bar">
                  <div class="skill-per" id="70"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12 pr-30">
        <div class="skills-img wow fadeInRight animated" data-animation="fadeInRight" data-delay=".4s">
          <img src="/images/skills-img.png" alt="We Offer Wide Selection of Hotel" class="img" />
        </div>
      </div>
    </div>
  </div>
</section>
<section class="feature-area2 p-relative fix ">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-6 col-md-12 col-sm-12 pr-30">
        <div class="feature-img">
          <img src="/images/feature.png" alt="Pearl Of The Adriatic." class="img" />
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="feature-content s-about-content">
          <div class="feature-title pb-20">
            <h5>Luxury Hotel &amp; Resort</h5>
            <h2>Pearl Of The Adriatic.</h2>
          </div>
          <p>
            Indulge in the ultimate lavish escape at our Luxury Hotel
            &amp; Resort, renowned as the Pearl of the Adriatic. Immerse
            yourself in unparalleled elegance and breathtaking coastal
            beauty for an unforgettable retreat. <br /><br />Nestled along
            the stunning Adriatic coast, our Luxury Hotel &amp; Resort
            stands as a beacon of opulence and tranquility. With panoramic
            views of the sparkling waters and world-class amenities at
            your fingertips, every moment becomes a precious gem.
            Experience unrivaled hospitality and immerse yourself in the
            allure of the Pearl of the Adriatic.
          </p>
          <div class="slider-btn mt-15">
            <a href="/about" class="btn ss-btn smoth-scroll">DISCOVER MORE</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection