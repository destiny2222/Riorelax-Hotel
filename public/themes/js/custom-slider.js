$('.slider-active').slick({
    autoplay: true,
    autoplaySpeed: 5000,
    dots: false,
    fade: true,
    // arrows: true,
    prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-angle-left"></i></button>',
    nextArrow: '<button type="button" class="slick-next"><i class="fas fa-angle-right"></i></button>',
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                dots: true,
                arrows: false
            }
        }
    ]
});


$('.testimonial-active').slick({
    autoplay: true,
    autoplaySpeed: 5000,
    dots: true,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: false
            }
        }
    ]
})