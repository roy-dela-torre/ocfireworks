<?php

/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined('ABSPATH') || exit;

?>
<div class="cart_totals <?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?>">

	<?php do_action('woocommerce_before_cart_totals'); ?>

	<h3><?php esc_html_e('Cart totals', 'woocommerce'); ?></h3>

	<div class="product_summary">
		<?php
		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
			$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

			if ($_product && $_product->exists() && $cart_item['quantity'] > 0) {
		?>
				<div class="product d-flex align-items-md-center">
					<p class="product_name mb-0"><?php echo $_product->get_name(); ?></p>
					<p class="qty mb-0">x<?php echo $cart_item['quantity']; ?></p>
					<p class="price mb-0"><?php echo wc_price($_product->get_price()); ?></p>
				</div>
		<?php
			}
		}
		?>
	</div>


	<div class="cart-totals-container">
		<div class="cart-subtotal d-flex align-items-center justify-content-between">
			<p class="subtotal-label mb-0"><?php esc_html_e('Subtotal:', 'woocommerce'); ?></p>
			<p class="subtotal-value" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>"><?php wc_cart_totals_subtotal_html(); ?></p>
		</div>

		<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
			<div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
				<p class="discount-label"><?php wc_cart_totals_coupon_label($coupon); ?></p>
				<p class="discount-value" data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>"><?php wc_cart_totals_coupon_html($coupon); ?></p>
			</div>
		<?php endforeach; ?>

		<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
			<div class="shipping">
				<p class="shipping-label"><?php esc_html_e('Shipping:', 'woocommerce'); ?></p>
				<ul id="shipping_method" class="woocommerce-shipping-methods">
					<?php foreach (WC()->shipping()->get_packages() as $i => $package) : ?>
						<?php foreach ($package['rates'] as $method_id => $rate) : ?>
							<li>
								<input type="radio" name="shipping_method[<?php echo $i; ?>]"
									id="shipping_method_<?php echo $i . '_' . $method_id; ?>"
									value="<?php echo esc_attr($rate->id); ?>"
									class="shipping_method" <?php checked($rate->id, WC()->session->get('chosen_shipping_methods')[$i]); ?>>
								<label for="shipping_method_<?php echo $i . '_' . $method_id; ?>">
									<?php echo esc_html($rate->label); ?>:
									<span class="woocommerce-Price-amount amount"><?php echo wp_kses_post(wc_price($rate->cost)); ?></span>
								</label>
							</li>
						<?php endforeach; ?>
					<?php endforeach; ?>
				</ul>

				<p class="woocommerce-shipping-destination">
					<?php
					// Show shipping destination
					if ($formatted_destination = WC()->countries->get_formatted_address(WC()->customer->get_shipping_address())) {
						printf(esc_html__('Shipping to %s.', 'woocommerce'), '<strong>' . esc_html($formatted_destination) . '</strong>');
					}
					?>
				</p>
			</div>
		<?php endif; ?>



		<?php foreach (WC()->cart->get_fees() as $fee) : ?>
			<div class="fee">
				<p class="fee-label"><?php echo esc_html($fee->name); ?></p>
				<p class="fee-value" data-title="<?php echo esc_attr($fee->name); ?>"><?php wc_cart_totals_fee_html($fee); ?></p>
			</div>
		<?php endforeach; ?>

		<?php
		if (wc_tax_enabled() && ! WC()->cart->display_prices_including_tax()) {
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = '';

			if (WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()) {
				$estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
			}

			if ('itemized' === get_option('woocommerce_tax_total_display')) {
				foreach (WC()->cart->get_tax_totals() as $code => $tax) {
		?>
					<div class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
						<p class="tax-label"><?php echo esc_html($tax->label) . $estimated_text; ?></p>
						<p class="tax-value" data-title="<?php echo esc_attr($tax->label); ?>"><?php echo wp_kses_post($tax->formatted_amount); ?></p>
					</div>
				<?php
				}
			} else {
				?>
				<div class="tax-total">
					<p class="tax-label"><?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; ?></p>
					<p class="tax-value" data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>"><?php wc_cart_totals_taxes_total_html(); ?></p>
				</div>
		<?php
			}
		}
		?>

		<?php do_action('woocommerce_cart_totals_before_order_total'); ?>

		<div class="order-total d-flex aling-items-center justify-content-between">
			<p class="total-label mb-0"><?php esc_html_e('Total:', 'woocommerce'); ?></p>
			<p class="total-value d-flex align-items-center" data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>"><?php wc_cart_totals_order_total_html(); ?></p>
		</div>

		<?php do_action('woocommerce_cart_totals_after_order_total'); ?>
	</div>
	<div class="wc-proceed-to-checkout">
		<?php do_action('woocommerce_proceed_to_checkout'); ?>
		<button class="continue_shopping"><a href="<?php echo get_home_url(); ?>" target="_blank" rel="noopener noreferrer" class="stretched-link">Continue shopping</a></button>
	</div>

	<?php do_action('woocommerce_after_cart_totals'); ?>
</div>