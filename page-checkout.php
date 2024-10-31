<?php get_header();
/*Template Name: Checkout*/
?>
<?php if (!is_user_logged_in()) { ?>
    <script>
        window.location.href = '<?php echo get_home_url(); ?>/account/';
    </script>
<?php } ?>
<?php ?>
<?php echo do_shortcode('[woocommerce_checkout]') ?>
<?php get_footer(); ?>
<script type="text/javascript">
    $(document).ready(function() {

        $('button.use_different_address').click(function(event) {
            event.preventDefault();
            $('h3#ship-to-different-address span').click()
        });
        $('span.view a').click()

        $('#ship-to-different-address-checkbox').change(function() {
            if ($(this).is(':checked')) {
                $('p.note_shipping').hide(); // Show the note when checkbox is checked
            } else {
                $('p.note_shipping').show(); // Hide the note when checkbox is unchecked
            }
        });
        // Listen for changes to the radio buttons

        $('input[name="order_additional_options"]').change(function() {
            var selected_option = $(this).val();

            $.ajax({
                type: 'POST',
                url: wc_checkout_params.ajax_url,
                data: {
                    action: 'update_order_option',
                    order_additional_options: selected_option
                },
                success: function() {
                    $('body').trigger('update_checkout');
                }
            });
        });

    })
</script>