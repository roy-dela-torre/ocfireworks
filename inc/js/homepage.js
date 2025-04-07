$(document).ready(function () {
    // Initialize Carousels
    const initCarousel = (selector, settings) => $(selector).owlCarousel(settings);

    initCarousel('div#brands', {
        nav: false,
        loop: true,
        margin: 30,
        dots: true,
        items: 13,
        responsive: {
            0: { items: 1 },
            600: { items: 1 },
            1000: { items: 1 }
        }
    });

    initCarousel('#about_us', {
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        autoplaySpeed: 30000,
        autoplayTimeout: 30000,
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            1000: { items: 3 }
        }
    });

    // Handle Product Columns
    const handleProductColumns = (selector) => {
        $(selector).each(function () {
            $(this).find('.yith-wcwl-add-button img').on('click', function () {
                $('.wishlist_modal_btn').trigger('click');
                updateWishlistModal($(this));
            });
        });
    };

    handleProductColumns('section.featured_product .row .product_column');
    handleProductColumns('section.special_product .row .product_column');

    // Banner hover function change banner to gif
    $(document).on('click scroll', function () {
        $('section.banner').addClass('hover').css('background', 'url("https://ocfireworks.innovnational.com/wp-content/themes/ocfireworks/assets/img/homepage/banner.gif") no-repeat bottom center/cover');
    });
});
