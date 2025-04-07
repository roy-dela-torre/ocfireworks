$(document).ready(function() {
    $('div#brands').owlCarousel({
        nav: false,
        loop: true,
        margin: 30,
        dots: false,
        autoplay: true,
        autoWidth: true,
        center: true,
        autoplaySpeed: 4200,
        autoplayTimeout: 4200,
        slideTransition: 'linear',
        items: 13,
        mouseDrag: false,
        responsive: {
            0: {
                items: 3
            },
            576: {
                items: 4
            },
            768: {
                items: 5
            },
            992: {
                items: 6
            },
            1366: {
                items: 7
            },
            1440: {
                items: 8
            },
            1920: {
                items: 10
            }
        }
    });
    $('.maps img').hover(function() {
        $(this).replaceWith(`<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2979.830235591817!2d-86.12994982392547!3d41.68100967126406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8816cfced2f51055%3A0x31b6dc1f1e028037!2sOCFireworks.com!5e0!3m2!1sen!2sph!4v1715232345741!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`);
    })
});