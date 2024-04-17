<?php get_header(); ?>
<section class="checkout">
    <div class="container-fluid">
        <div class="wrapper">
            <div class="row">
                <?php echo do_shortcode('[woocommerce_checkout]')?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>