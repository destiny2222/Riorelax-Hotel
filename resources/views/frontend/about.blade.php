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
    <img src="/images/backgrounds/an-img-02.png" alt="" />
  </div>
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="s-about-img p-relative wow fadeInLeft animated" data-animation="fadeInLeft" data-delay=".4s">
          <img src="/images/about-img-02.jpg" alt="" />
          {{-- <div class="about-icon">
            <img src="/images/about-img-03.png" alt="" />
          </div> --}}
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="about-content s-about-content wow fadeInRight animated pl-30" data-animation="fadeInRight"
          data-delay=".4s">
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
          {{-- <div class="about-content3 mt-30">
            <div class="row justify-content-center align-items-center">
              <div class="col-md-12">
                 <ul class="green mb-30">
                      <li>Located in the heart of Benin City, Edo State.</li>
                      <li>Elegant rooms designed for relaxation and comfort.</li>
                      <li>Exceptional Nigerian hospitality and world-class service.</li>
                  </ul>
              </div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
</section>

<section id="skill" class="skill-area p-relative fix">
  <div class="animations-01">
    <img src="/images/backgrounds/an-img-05.png" alt="House7  Experience" />
  </div>
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="skills-content s-about-content">
          <div class="skills-title pb-20">
            <h5>House7 Experience</h5>
            <h2>Why Guests Choose Us</h2>
          </div>
          <p>
            At House7, we redefine comfort and hospitality in the heart of Benin City, Edo State.
            Our goal is to give every guest a memorable stay filled with , safety, and relaxation.  
          </p>
          <div class="skills-content s-about-content mt-20">
            <div class="skills">
              <div class="skill mb-30">
                <div class="skill-name"> Comfort </div>
                <div class="skill-bar">
                  <div class="skill-per" id="95"></div>
                </div>
              </div>
              <div class="skill mb-30">
                <div class="skill-name">Exceptional Service</div>
                <div class="skill-bar">
                  <div class="skill-per" id="90"></div>
                </div>
              </div>
              <div class="skill mb-30">
                <div class="skill-name">Guest Satisfaction</div>
                <div class="skill-bar">
                  <div class="skill-per" id="98"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12 pr-30">
        <div class="skills-img wow fadeInRight animated" data-animation="fadeInRight" data-delay=".4s">
          <img src="/images/skills-img.jpg" alt="House7  Experience" class="img" />
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
          <img src="/images/feature.jpg" alt="House7 in Benin City" class="img" />
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="feature-content s-about-content">
          <div class="feature-title pb-20">
            <h2>House7 – Your Perfect Escape</h2>
          </div>
          <p>
            Nestled in the vibrant city of Benin, House7 offers a seamless blend of modern
             and warm Nigerian hospitality. Whether you’re here for business or leisure,
            our elegant rooms, fine dining, and world-class facilities promise an unforgettable stay. 
            <br /><br />
            From the moment you arrive, you’ll be surrounded by comfort, style, and care.
            Discover why House7 is the preferred choice for travelers seeking relaxation,
            security, and true Edo hospitality.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>





@endsection