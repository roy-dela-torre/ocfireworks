<script src="<?php echo get_stylesheet_directory_uri(); ?>/inc/js/jquery.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/inc/js/functions.js"></script>
<?php $js_path = get_stylesheet_directory_uri().'/inc/js/'?>
<?php if(is_front_page()):?>
    <script src="<?php echo $js_path; ?>owl.carousel.min.js"></script>
    <script>
        $(document).ready(function(){
            $('div#brands').owlCarousel({
                nav: false,
                loop: true,
                margin: 30,
                dots: true,
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
        })
    </script>
<?php elseif(is_page('about-us')):?>
<?php elseif(is_page('contact-us')):?>
<?php endif;?>