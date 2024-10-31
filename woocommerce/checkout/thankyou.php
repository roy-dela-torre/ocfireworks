<?php

/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined('ABSPATH') || exit;
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/order_complete.css">
<section class="order_complete">
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-8 col-lg-7">
					<div class="order_details">
						<div class="order_details_content">
							<h1 class="red_text"><?php printf(esc_html__('Thank you, %s!', 'woocommerce'), esc_html($order->get_billing_first_name())); ?></h1>
							<p><?php esc_html_e('Your order has been received and will be processed shortly.', 'woocommerce'); ?></p>
							<p><?php esc_html_e('Your order number is', 'woocommerce'); ?> <strong class="font-weight-700"><?php echo esc_html($order->get_order_number()); ?></strong></p>
							<p><?php esc_html_e('An email will be sent containing information about your purchase. If you have any questions about your purchase, email us at ', 'woocommerce'); ?>
								<a href="mailto:sales@ocfireworks.com" class="red_text font-weight-700">sales@ocfireworks.com</a>
								<?php esc_html_e(' or call us at ', 'woocommerce'); ?>
								<a href="tel:+574-743-8164" class="red_text font-weight-700">574-743-8164</a>
							</p>
						</div>

						<!-- Display shipping address if it's a shipped order -->
						<?php if (! $order->has_status('failed') && $order->needs_shipping_address()) : ?>
							<div class="shipping_addresss">
								<?php
								// Prepare the shipping address for Google Maps URL encoding
								$shipping_address = urlencode(
									$order->get_shipping_address_1() . ' ' .
										$order->get_shipping_address_2() . ', ' .
										$order->get_shipping_city() . ', ' .
										$order->get_shipping_state() . ' ' .
										$order->get_shipping_postcode() . ', ' .
										WC()->countries->countries[$order->get_shipping_country()]
								);

								// Google Maps URL (No API Key)
								$google_map_url = "https://www.google.com/maps?q={$shipping_address}&output=embed";
								?>

								<!-- Replace the static image with Google Map iframe -->
								<?php if (!$order->has_status('failed') && $order->needs_shipping_address()) : ?>
									<div class="shipping_address">
										<iframe
											width="600"
											height="450"
											style="border:0;"
											loading="lazy"
											allowfullscreen
											src="<?php echo esc_url($google_map_url); ?>">
										</iframe>
									</div>
								<?php endif; ?>

							</div>
						<?php endif; ?>

						<h3><?php esc_html_e('Order Summary', 'woocommerce'); ?></h3>

						<div class="contact_details row">
							<div class="col-xl-6 col-lg-12 col-md-6">
								<div class="contact_details_content">
									<h4><?php esc_html_e('Contact Details:', 'woocommerce'); ?></h4>
									<p class="name"><?php echo esc_html($order->get_billing_first_name() . ' ' . $order->get_billing_last_name()); ?></p>
									<p class="email"><?php echo esc_html($order->get_billing_email()); ?></p>
									<p class="phone_number"><?php echo esc_html($order->get_billing_phone()); ?></p>
								</div>
							</div>

							<?php if (! $order->has_status('failed') && $order->needs_shipping_address()) : ?>
								<div class="col-xl-6 col-lg-12 col-md-6">
									<div class="shipping_address_">
										<h4><?php esc_html_e('Shipping Address', 'woocommerce'); ?></h4>
										<p class="company"><?php echo esc_html($order->get_shipping_company()); ?></p>
										<p class="country"><?php echo esc_html(WC()->countries->countries[$order->get_shipping_country()]); ?></p>
										<p class="address"><?php echo esc_html($order->get_shipping_address_1()); ?>, <?php echo esc_html($order->get_shipping_address_2()); ?></p>
										<p class="state_province"><?php echo esc_html($order->get_shipping_city() . ', ' . $order->get_shipping_state()); ?></p>
										<p class="zip_code"><?php echo esc_html($order->get_shipping_postcode()); ?></p>
									</div>
								</div>
							<?php endif; ?>

							<div class="col-xl-6 col-lg-12 col-md-6">
								<div class="shipping_method">
									<h4><?php esc_html_e('Shipping Method', 'woocommerce'); ?></h4>
									<p class="shipping_address">
										<?php echo esc_html($order->get_shipping_method()) . ' - ' . wp_kses_post(wc_price($order->get_shipping_total())); ?>
									</p>
								</div>
							</div>

							<div class="col-xl-6 col-lg-12 col-md-6">
								<div class="billing_address">
									<h4>Billing address</h4>
									<p class="company"><?php echo esc_html($order->get_billing_company()); ?></p>
									<p class="country"><?php echo esc_html(WC()->countries->countries[$order->get_billing_country()]); ?></p>
									<p class="address"><?php echo esc_html($order->get_billing_address_1()); ?>, <?php echo esc_html($order->get_billing_address_2()); ?></p>
									<p class="state_province"><?php echo esc_html($order->get_billing_city() . ', ' . $order->get_billing_state()); ?></p>
									<p class="zip_code"><?php echo esc_html($order->get_billing_postcode()); ?></p>
								</div>
							</div>
						</div>

						<div class="contact_us d-flex align-items-center justify-content-between">
							<p class="mb-0">Got some question? <a href="/contact-us/" target="_blank" rel="noopener noreferrer" class="red_text font-weight-700">Contact Us</a></p>
							<a href="https://ocfireworks.innovnational.com/shop/" target="_blank" rel="noopener noreferrer" class="red_button text-uppercase">continue shopping<svg xmlns="http://www.w3.org/2000/svg" width="22" height="23" viewBox="0 0 22 23" fill="none">
									<path d="M20.867 4.54927C20.6743 4.30499 20.4286 4.10769 20.1485 3.97227C19.8684 3.83686 19.5611 3.76686 19.25 3.76758H5.31644L4.79462 1.54764C4.75912 1.39673 4.67366 1.26225 4.5521 1.16602C4.43054 1.0698 4.28003 1.01749 4.125 1.01758H1.375C1.19266 1.01758 1.0178 1.09001 0.888864 1.21894C0.759933 1.34787 0.6875 1.52274 0.6875 1.70508C0.6875 1.88741 0.759933 2.06228 0.888864 2.19121C1.0178 2.32015 1.19266 2.39258 1.375 2.39258H3.5805L6.01081 12.723C5.4808 12.7663 4.98819 13.0133 4.63632 13.412C4.28445 13.8107 4.10066 14.3302 4.12352 14.8615C4.14637 15.3928 4.37409 15.8946 4.75891 16.2616C5.14372 16.6286 5.65573 16.8324 6.1875 16.8301H17.875C18.0573 16.8301 18.2322 16.7576 18.3611 16.6287C18.4901 16.4998 18.5625 16.3249 18.5625 16.1426C18.5625 15.9602 18.4901 15.7854 18.3611 15.6564C18.2322 15.5275 18.0573 15.4551 17.875 15.4551H6.1875C6.00516 15.4551 5.8303 15.3826 5.70136 15.2537C5.57243 15.1248 5.5 14.9499 5.5 14.7676C5.5 14.5852 5.57243 14.4104 5.70136 14.2814C5.8303 14.1525 6.00516 14.0801 6.1875 14.0801H17.7939C18.2591 14.0813 18.7109 13.9246 19.0755 13.6358C19.4402 13.347 19.6961 12.943 19.8014 12.4899L21.2582 6.30239C21.3301 5.99963 21.3323 5.68449 21.2645 5.38077C21.1967 5.07706 21.0608 4.79272 20.867 4.54927Z" fill="white" />
									<path d="M15.8125 21.6426C16.9516 21.6426 17.875 20.7192 17.875 19.5801C17.875 18.441 16.9516 17.5176 15.8125 17.5176C14.6734 17.5176 13.75 18.441 13.75 19.5801C13.75 20.7192 14.6734 21.6426 15.8125 21.6426Z" fill="white" />
									<path d="M8.25 21.6426C9.38909 21.6426 10.3125 20.7192 10.3125 19.5801C10.3125 18.441 9.38909 17.5176 8.25 17.5176C7.11091 17.5176 6.1875 18.441 6.1875 19.5801C6.1875 20.7192 7.11091 21.6426 8.25 21.6426Z" fill="white" />
								</svg>
							</a>
						</div>

					</div>
				</div>
				<div class="col-xl-4 col-lg-5 ps-lg-5">
					<div class="order_summary">
						<h3 class="text-uppercase red_text"><?php esc_html_e('Cart total:', 'woocommerce'); ?></h3>

						<div class="order_items">
							<?php
							// Loop through the order items
							foreach ($order->get_items() as $item_id => $item) {
								$product = $item->get_product();
								$product_name = $item->get_name();
								$quantity = $item->get_quantity();
								$total = $item->get_total();
								$subtotal = $item->get_subtotal();
								$price = wc_price($total / $quantity); // Calculate per-item price
							?>
								<div class="order_item">
									<div class="order_item_name">
										<p><?php echo esc_html($product_name); ?></p>
									</div>
									<div class="order_item_quantity">
										<p><?php echo esc_html('X' . $quantity); ?></p>
									</div>
									<div class="order_item_price">
										<strong><?php echo wp_kses_post( $price); ?></strong>
									</div>
								</div>
							<?php } ?>
						</div>

						<div class="order_note">
							<span class="text-uppercase">Note:</span>
							<p class="mb-0">Qorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis... <span class="red_text font-weight-700 text-uppercase">SEE MOre</span></p>
						</div>

						<div class="order_totals">
							<div class="order_subtotal">
								<span><?php esc_html_e('Subtotal:', 'woocommerce'); ?></span>
								<span><?php echo wp_kses_post(wc_price($order->get_subtotal())); ?></span>
							</div>
							<div class="order_shipping">
								<span><?php esc_html_e('Shipping:', 'woocommerce'); ?></span>
								<span><?php echo wp_kses_post(wc_price($order->get_shipping_total())); ?></span>
							</div>
							<div class="order_total">
								<strong><?php esc_html_e('Total:', 'woocommerce'); ?></strong>
								<strong><?php echo wp_kses_post(wc_price($order->get_total())); ?></strong>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
<script>
	function initMap() {
		// Customer shipping address
		const address = "<?php
							echo esc_js($order->get_shipping_address_1()) . ', ' .
								esc_js($order->get_shipping_city()) . ', ' .
								esc_js($order->get_shipping_state()) . ' ' .
								esc_js($order->get_shipping_postcode());
							?>";

		// Initialize map
		const geocoder = new google.maps.Geocoder();
		const map = new google.maps.Map(document.getElementById("map"), {
			zoom: 12,
			center: {
				lat: -34.397,
				lng: 150.644
			} // Default center
		});

		// Geocode the address to get coordinates
		geocoder.geocode({
			'address': address
		}, function(results, status) {
			if (status === 'OK') {
				map.setCenter(results[0].geometry.location);
				new google.maps.Marker({
					map: map,
					position: results[0].geometry.location
				});
			} else {
				console.error('Geocode failed: ' + status);
			}
		});
	}

	// Load map after page loads
	window.onload = initMap;
</script>

<div class="woocommerce-order d-none">

	<?php
	if ($order) :

		do_action('woocommerce_before_thankyou', $order->get_id());
	?>

		<?php if ($order->has_status('failed')) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
				<?php if (is_user_logged_in()) : ?>
					<a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<?php wc_get_template('checkout/order-received.php', array('order' => $order)); ?>

			<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

				<li class="woocommerce-order-overview__order order">
					<?php esc_html_e('Order number:', 'woocommerce'); ?>
					<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							?></strong>
				</li>

				<li class="woocommerce-order-overview__date date">
					<?php esc_html_e('Date:', 'woocommerce'); ?>
					<strong><?php echo wc_format_datetime($order->get_date_created()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							?></strong>
				</li>

				<?php if (is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email()) : ?>
					<li class="woocommerce-order-overview__email email">
						<?php esc_html_e('Email:', 'woocommerce'); ?>
						<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
								?></strong>
					</li>
				<?php endif; ?>

				<li class="woocommerce-order-overview__total total">
					<?php esc_html_e('Total:', 'woocommerce'); ?>
					<strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
							?></strong>
				</li>

				<?php if ($order->get_payment_method_title()) : ?>
					<li class="woocommerce-order-overview__payment-method method">
						<?php esc_html_e('Payment method:', 'woocommerce'); ?>
						<strong><?php echo wp_kses_post($order->get_payment_method_title()); ?></strong>
					</li>
				<?php endif; ?>

			</ul>

		<?php endif; ?>

		<?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
		<?php do_action('woocommerce_thankyou', $order->get_id()); ?>

	<?php else : ?>

		<?php wc_get_template('checkout/order-received.php', array('order' => false)); ?>

	<?php endif; ?>

</div>