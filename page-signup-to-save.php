<?php get_header(); 
/*Template Name: Sign up to save*/
?>
<section class="signup_to_save">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6">
                    <div class="signup_form">
                        <h1><?php echo the_title(); ?></h1>
                        <p class="mb-0">Get your promo code and secure your spot for a dazzling fireworks display. Sign up now!</p>
                        <?php echo do_shortcode('[contact-form-7 id="483c1c5" title="Sign up to Save!"]'); ?>
                    </div>
                </div>
                <div class="col-xl-6 ps-xl-5">
                    <div class="image">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/Sign up to Save.jpg" alt="Sign up to Save!">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>