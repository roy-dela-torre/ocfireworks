jQuery(function($) {
    // Listen for changes to the shipping method
    $('body').on('change', 'input[name^="shipping_method"]', function() {
        // Trigger WooCommerce to update totals
        $('body').trigger('update_checkout');
    });
});
