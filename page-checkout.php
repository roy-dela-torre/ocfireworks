<?php get_header();
/*Template Name: Checkout*/
?>
<?php if (!is_user_logged_in()) { ?>
    <script>
        window.location.href = '<?php echo get_home_url(); ?>/my-account/';
    </script>
<?php } ?>
<section class="checkout">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <h1 class="red_text">Checkout</h1>
                    <p>Vorem ipsum dolor sit amet consectetur adipiscing elit.</p>
                </div>
                <?php echo do_shortcode('[woocommerce_checkout]') ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('button.use_different_address').click(function(event) {
            event.preventDefault();
            $('h3#ship-to-different-address span').click()
        });

        // $('#save_changes').click(function(){
        //     $('button#place_order').click()
        // })

        $('span.view a').click()



    })
</script>