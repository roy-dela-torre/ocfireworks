<?php
defined('ABSPATH') || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table test">
    <div class="table-header d-none">
        <div class="table-row">
            <div class="table-cell product-name"><?php esc_html_e('Product', 'woocommerce'); ?></div>
            <div class="table-cell product-total"><?php esc_html_e('Subtotal', 'woocommerce'); ?></div>
        </div>
    </div>
    <div class="table-body">
        <?php
        do_action('woocommerce_review_order_before_cart_contents');

        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
        ?>
                <div class="table-row <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                    <div class="table-cell product-name">
                        <p class="product_name mb-0"><?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;'; ?></p>
                        <?php echo apply_filters('woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf('&times;&nbsp;%s', $cart_item['quantity']) . '</strong>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                        ?>
                        <?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                        ?>
                    </div>
                    <div class="table-cell product-total">
                        <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                        ?>
                    </div>
                </div>
        <?php
            }
        }

        do_action('woocommerce_review_order_after_cart_contents');
        ?>
    </div>
    <form class="checkout_coupon woocommerce-form-coupon" method="post">
        <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" id="coupon_code" value="" />
        <button type="submit" class="red_button <?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_html_e('Apply coupon', 'woocommerce'); ?></button>
    </form>
    <div class="table-footer">
        <div class="d-flex align-items-center justify-content-between">
            <span class="subtotal"><?php esc_html_e('Subtotal', 'woocommerce'); ?></span>
            <span class="subtotal"><?php wc_cart_totals_subtotal_html(); ?></span>
        </div>

        <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
            <div class="table-row cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
                <div class="table-cell"><?php wc_cart_totals_coupon_label($coupon); ?></div>
                <div class="table-cell"><?php wc_cart_totals_coupon_html($coupon); ?></div>
            </div>
        <?php endforeach; ?>

        <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

            <?php do_action('woocommerce_review_order_before_shipping'); ?>

            <?php wc_cart_totals_shipping_html(); ?>

            <?php do_action('woocommerce_review_order_after_shipping'); ?>

        <?php endif; ?>

        <?php foreach (WC()->cart->get_fees() as $fee) : ?>
            <div class="table-row fee">
                <div class="table-cell"><?php echo esc_html($fee->name); ?></div>
                <div class="table-cell"><?php wc_cart_totals_fee_html($fee); ?></div>
            </div>
        <?php endforeach; ?>

        <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
            <?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
                <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited 
                ?>
                    <div class="table-row tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
                        <div class="table-cell"><?php echo esc_html($tax->label); ?></div>
                        <div class="table-cell"><?php echo wp_kses_post($tax->formatted_amount); ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="table-row tax-total">
                    <div class="table-cell"><?php echo esc_html(WC()->countries->tax_or_vat()); ?></div>
                    <div class="table-cell"><?php wc_cart_totals_taxes_total_html(); ?></div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php do_action('woocommerce_review_order_before_order_total'); ?>

        <div class="table-row order-total d-flex align-items-center justify-content-between">
            <span class="total"><?php esc_html_e('Total', 'woocommerce'); ?></span>
            <span class="table-cell"><?php wc_cart_totals_order_total_html(); ?></span>
        </div>

        <?php do_action('woocommerce_review_order_after_order_total'); ?>

    </div>
</div>