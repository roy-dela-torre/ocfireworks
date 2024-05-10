<?php get_header(); 
/*Template Name: Checkout*/
?>
<section class="checkout">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <?php echo do_shortcode('[woocommerce_checkout]')?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>