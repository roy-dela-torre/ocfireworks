<?php get_header();
/*Template Name: Professional Fireworks*/
?>
<section class="professional_firewrorks">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6">
                    <div class="signup_form">
                        <h2 class="text-white"><?php echo the_title(); ?></h2>
                        <p class="mb-0">Licensed Professionals Only. OC Fireworks offers a dazzling selection of high-quality fireworks for professional use. Browse our extensive inventory and contact us to verify your licensing before placing an order.</p>
                        <?php echo do_shortcode('[contact-form-7 id="8480d1d" title="Professional Fireworks"]'); ?>
                    </div>
                </div>
                <div class="col-xl-6 ps-xl-5">
                    <div class="image">
                        <h1 class="red_text">1.4G Proline</h1>
                        <p>They are finally here. Fireworks so awesome you need professional training to purchase them. In order to view or access these items, you must provide a shooter's license, PGI Display Operators Course certification, or another verifiable certificate demonstrating professionalism with fireworks. 1.4G Proline items are for professional use only and not intended for the general public.</p>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/PROFESSIONAL FIREWORKS.jpg" alt="PROFESSIONAL FIREWORKS">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer();?>