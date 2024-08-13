// mainslider for homepage

const swiper = new Swiper('.swiper-container', {
    spaceBetween: 0,
    speed: 2000,
    loop: true,
    autoplay: {
        delay: 1500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },

    navigation: {
        nextEl: ".swiper-button-next ",
        prevEl: ".swiper-button-prev",
    },
});

var owl = $('#Department');
owl.owlCarousel({
    items: 4,
    loop: true,
    margin: 10,
    autoplay: true,
    nav: true,
    autoplayTimeout: 3000,
    smartSpeed: 1000,
    autoplayHoverPause: true,
    dots: false,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 2
        },
        1024: {
            items: 3
        },
        1200: {
            items: 4
        }
    }
});

$('select').niceSelect();


// JQUERY
$(document).ready(function() {
    $('#accordion2 header').click(function() {
        $(this).next()
            .slideToggle(200)
            .closest('.question')
            .toggleClass('active')
            .siblings()
            .removeClass('active')
            .find('main')
            .slideUp(200);
    })
});

// $(this).next().slideToggle(200).closest('.question').toggleClass('active').siblings().removeClass('active').find('main').slideUp(200);


var owl = $('.facilitiesSlider');
owl.owlCarousel({
    items: 2,
    loop: true,
    margin: 10,
    autoplay: true,
    nav: true,
    autoplayTimeout: 3000,
    smartSpeed: 1000,
    autoplayHoverPause: true,
    dots: false,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 2
        },
        1024: {
            items: 2
        },
        1200: {
            items: 2
        }
    }
});


var owl = $('#testimonial');
owl.owlCarousel({
    items: 1,
    loop: true,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true
});



var owl = $('#specialityslider');
owl.owlCarousel({
    items: 2,
    loop: true,
    margin: 10,
    autoplay: true,
    nav: true,
    autoplayTimeout: 3000,
    smartSpeed: 1000,
    autoplayHoverPause: true,
    dots: false,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 2
        },
        1024: {
            items: 2
        },
        1200: {
            items: 2
        }
    }
});



// Start Our Testimonial Section

var owl = $('#our-testimonial');
owl.owlCarousel({
    items: 1,
    loop: true,
    autoplay: true,
    autoplayHoverPause: true,
    smartSpeed: 3000,
    autoplayTimeout: 4000,
});

//Our Partners Crousel
$("#partners").owlCarousel({
    loop: true,
    responsiveClass: true,
    margin: 10,
    autoplay: true,
    slideSpeed: 60,
    smartSpeed: 1000,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 2,
            loop: true
        },
        600: {
            items: 5,
            loop: true
        },
        1000: {
            items: 5,
            loop: true
        }
    }
});


// Start Light gallery script
$(document).ready(function() {
    $("#Gallery").lightGallery({
        thumbnail: true
    });
});