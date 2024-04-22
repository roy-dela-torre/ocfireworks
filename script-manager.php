<script src="<?php echo get_stylesheet_directory_uri(); ?>/inc/js/jquery.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/inc/js/functions.js"></script>
<?php $js_path = get_stylesheet_directory_uri().'/inc/js/'?>
<script>
     function setEqualHeightForSection(sectionSelector, secondSelector) {
        var elementsToResize = $(sectionSelector).find(secondSelector);
        var tallestHeight = 0;
        elementsToResize.each(function () {
            var height = $(this).height();
            if (height > tallestHeight) {
                tallestHeight = height;
            }
        });
        elementsToResize.css('height', tallestHeight);
    }
</script>
<?php if(is_front_page()):?>
    <script src="<?php echo $js_path; ?>owl.carousel.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
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
                        items:3
                    },
                    576: {
                        items:4
                    },
                    768: {
                        items:5
                    },
                    992: {
                        items:6
                    },
                    1366:{
                        items:7
                    },
                    1440:{
                        items:8
                    },
                    1920:{
                        items:10
                    }
                }
            });

            $('#about_us').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:3
                    }
                }
            })
            $('header li.menu-item-has-children>a').append(`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
            <path d="M11.9831 16.5C11.7201 16.4981 11.4603 16.4426 11.2195 16.3369C10.9788 16.2312 10.7622 16.0776 10.5831 15.8854L5.25311 10.1972C5.0796 10.0028 4.98914 9.74835 5.00104 9.48827C5.01294 9.2282 5.12625 8.98306 5.31679 8.80519C5.50733 8.62732 5.76001 8.5308 6.02089 8.53624C6.28177 8.54167 6.53018 8.64864 6.71311 8.8343L11.9831 14.4626L17.2531 8.8343C17.3418 8.73488 17.4496 8.65418 17.57 8.59695C17.6904 8.53972 17.8211 8.50711 17.9544 8.50104C18.0877 8.49497 18.2208 8.51557 18.346 8.56161C18.4711 8.60766 18.5858 8.67823 18.6832 8.76917C18.7806 8.86011 18.8588 8.96957 18.9132 9.09112C18.9676 9.21266 18.997 9.34383 18.9998 9.47691C19.0026 9.60998 18.9786 9.74226 18.9294 9.86597C18.8802 9.98968 18.8066 10.1023 18.7131 10.1972L13.3871 15.8844C13.2076 16.0772 12.9905 16.2313 12.749 16.3372C12.5075 16.4431 12.2469 16.4985 11.9831 16.5Z" fill="#212121"/>
            </svg>`);
        })
    </script>
<?php elseif(is_page('about-us')):?>
<?php elseif(is_cart()):?>
    <script type="text/javascript">
        $(document).ready(function(){
           
        })
    </script>
<?php elseif(is_archive()):?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('section.product_main li').each(function(){
                $(this).click(function(){
                    $(this).find('a').click()
                    $(this).find('input[type="radio"]').click()
                    $(this).find('input[type="radio"]').prop('checked', true);
                })
            })
            setInterval(() => {
                setEqualHeightForSection('section.product_main','h3')
            }, 500);
        })
    </script>
<?php elseif(is_page('contact-us')):?>
    <script>
        $(document).ready(function(){
            $('.map img').click(function(){
                $(this).replaceWith(`<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2979.81454097319!2d-86.12738829999999!3d41.6813486!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8816cfced1933acd%3A0xdf1e5c9119ca9b1e!2s13421%20McKinley%20Hwy%2C%20Mishawaka%2C%20IN%2046545%2C%20USA!5e0!3m2!1sen!2sph!4v1713774385763!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>`)
            })
        })
    </script>
<?php endif;?>