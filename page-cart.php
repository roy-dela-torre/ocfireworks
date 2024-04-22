<?php get_header(); ?>
<section class="cart">
    <div class="container-fluid">
        <div class="wrapper">
            <div class="row">
                <h1 class="text-center">My Cart</h1>
                <div class="cart-container">
                    <?php echo do_shortcode('[woocommerce_cart]')?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
<script>
    $(document).ready(function(){
       $('#delete_cart_item').click(function(){
            $('input.input-text.qty.text').val(0).change()
            setTimeout(() => {
                $('button.red_button.update_cart.button').click()
            }, 1000);
       })
       $('section.cart .cart-container .woocommerce').addClass('row')

       
       $('.cart_totals.calculated_shipping button.red_button.button').click(function(){
        var coupon_value = $('.cart_totals.calculated_shipping input#coupon_code').val()
        $('form.woocommerce-cart-form input#coupon_code').val(coupon_value).change()
        $('form.woocommerce-cart-form .coupon button.button').click()
       })
    })
</script>