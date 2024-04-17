<?php get_header(); ?>
<section class="cart">
    <div class="container-fluid">
        <div class="wrapper">
            <div class="row">
                <div class="cart-container">
                    <?php echo do_shortcode('[woocommerce_cart]')?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <?php //echo get_template_part('page-section/product-section', 'product-section'); ?> -->
<?php get_footer(); ?>
