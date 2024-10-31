<?php

/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_account_orders', $has_orders); ?>

<?php if ($has_orders) : ?>
	<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table table table-hover d-none d-xl-block" id="order_content_desktop" style="width:100%">
		<thead>
			<tr>
				<?php
				// Array to map original column IDs to new names
				$columnRenameMap = array(
					'order-number'   => 'Order Number',
					'order-date'     => 'Date',
					'order-status'   => 'Payment Status',
					'order-total'    => 'quantity',
					'order-actions'  => 'Actions'
				);

				foreach (wc_get_account_orders_columns() as $columnId => $columnName) :
					// Check if the column needs to be renamed
					if (array_key_exists($columnId, $columnRenameMap)) {
						$columnName = $columnRenameMap[$columnId]; // Use the new name
					}
				?>
					<th class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo esc_attr($columnId); ?>">
						<span class="nobr"><?php echo esc_html($columnName); ?></span>
					</th>
				<?php endforeach; ?>
			</tr>
		</thead>


		<tbody>
			<?php
			foreach ($customer_orders->orders as $customer_order) {
				$order      = wc_get_order($customer_order); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				$item_count = $order->get_item_count() - $order->get_item_count_refunded();
			?>
				<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr($order->get_status()); ?> order">
					<?php foreach (wc_get_account_orders_columns() as $column_id => $column_name) : ?>
						<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr($column_id); ?>" data-title="<?php echo esc_attr($column_name); ?>">
							<?php if (has_action('woocommerce_my_account_my_orders_column_' . $column_id)) : ?>
								<?php do_action('woocommerce_my_account_my_orders_column_' . $column_id, $order); ?>

							<?php elseif ('order-number' === $column_id) : ?>
								<a href="<?php echo esc_url($order->get_view_order_url()); ?>">
									<?php echo esc_html(_x('#', 'hash before order number', 'woocommerce') . $order->get_order_number()); ?>
								</a>

							<?php elseif ('order-date' === $column_id) : ?>
								<time datetime="<?php echo esc_attr($order->get_date_created()->date('c')); ?>"><?php echo esc_html(wc_format_datetime($order->get_date_created())); ?></time>

							<?php elseif ('order-status' === $column_id) : ?>
								<?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>

							<?php elseif ('order-total' === $column_id) : ?>
								<?php
								/* translators: 1: formatted order total 2: total order items */
								echo wp_kses_post(sprintf(_n('%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce'), $order->get_formatted_order_total(), $item_count));
								?>

							<?php elseif ('order-actions' === $column_id) : ?>
								<div class="row flex-column align-items-center gx-1">
									<?php
									$actions = wc_get_account_orders_actions($order);

									if (!empty($actions)) {
										$i = 0; // Initialize a counter
										foreach ($actions as $key => $action) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
											// Determine the button class based on the counter value
											$button_class = $i === 0 ? 'red_button' : 'orange_button';

											// Output the button
											echo '<a href="' . esc_url($action['url']) . '" class="woocommerce-button justify-content-center ' . esc_attr($button_class) . ' w-100 text-center' . esc_attr($wp_button_class) . ' button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>';

											$i++; // Increment the counter
										}
									}
									?>
								</div>

							<?php endif; ?>
						</td>
					<?php endforeach; ?>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>

	<div class="orders-mobile d-block d-xl-none">
		<?php
		foreach ($customer_orders->orders as $customer_order) {
			$order = wc_get_order($customer_order);
			$item_count = $order->get_item_count() - $order->get_item_count_refunded();
		?>
			<div class="mobile-order-card">
				<div class="order-field">
					<strong>Order Number:</strong>
					<a href="<?php echo esc_url($order->get_view_order_url()); ?>">
						<?php echo esc_html(_x('#', 'hash before order number', 'woocommerce') . $order->get_order_number()); ?>
					</a>
				</div>

				<div class="order-field">
					<strong>Date:</strong>
					<time datetime="<?php echo esc_attr($order->get_date_created()->date('c')); ?>">
						<?php echo esc_html(wc_format_datetime($order->get_date_created())); ?>
					</time>
				</div>

				<div class="order-field">
					<strong>Payment Status:</strong>
					<?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>
				</div>

				<div class="order-field">
					<strong>Quantity:</strong>
					<?php
					echo wp_kses_post(sprintf(
						_n('%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'woocommerce'),
						$order->get_formatted_order_total(),
						$item_count
					));
					?>
				</div>

				<div class="order-field">
					<strong>Actions:</strong>
					<div class="goup_button">
						<?php
						$actions = wc_get_account_orders_actions($order);
						if (!empty($actions)) {
							$i = 0;
							foreach ($actions as $key => $action) {
								$button_class = $i === 0 ? 'red_button' : 'orange_button';
								echo '<a href="' . esc_url($action['url']) . '" 
                                class="woocommerce-button ' . esc_attr($button_class) . ' button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>';
								$i++;
							}
						}
						?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>


	<?php do_action('woocommerce_before_account_orders_pagination'); ?>

	<?php if (1 < $customer_orders->max_num_pages) : ?>
		<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
			<?php if (1 !== $current_page) : ?>
				<a class="woocommerce-button d-flex align-items-center text-uppercase red_text woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button<?php echo esc_attr($wp_button_class); ?>" href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page - 1)); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<path d="M8 12.0169C8.0019 12.2799 8.0574 12.5397 8.1631 12.7805C8.2688 13.0212 8.4224 13.2378 8.6146 13.4169L14.3028 18.7469C14.4972 18.9204 14.7517 19.0109 15.0117 18.999C15.2718 18.9871 15.5169 18.8737 15.6948 18.6832C15.8727 18.4927 15.9692 18.24 15.9638 17.9791C15.9583 17.7182 15.8514 17.4698 15.6657 17.2869L10.0374 12.0169L15.6657 6.7469C15.7651 6.6582 15.8458 6.5504 15.9031 6.43C15.9603 6.3096 15.9929 6.1789 15.999 6.0456C16.005 5.9123 15.9844 5.7792 15.9384 5.654C15.8923 5.5289 15.8218 5.4142 15.7308 5.3168C15.6399 5.2194 15.5304 5.1412 15.4089 5.0868C15.2873 5.0324 15.1562 5.003 15.0231 5.0002C14.89 4.9974 14.7577 5.0214 14.634 5.0706C14.5103 5.1198 14.3977 5.1934 14.3028 5.2869L8.6156 10.6129C8.4228 10.7924 8.2687 11.0095 8.1628 11.251C8.0569 11.4925 8.0015 11.7531 8 12.0169Z" fill="#FF0000" />
					</svg>
					<?php esc_html_e('Previous', 'woocommerce'); ?></a>
			<?php endif; ?>

			<?php if (intval($customer_orders->max_num_pages) !== $current_page) : ?>
				<a class="woocommerce-button d-flex align-items-center text-uppercase red_text woocommerce-button--next woocommerce-Button woocommerce-Button--next button<?php echo esc_attr($wp_button_class); ?>" href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page + 1)); ?>">
					<?php esc_html_e('Next', 'woocommerce'); ?>
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16 12.0169C15.9981 12.2799 15.9426 12.5397 15.8369 12.7805C15.7312 13.0212 15.5776 13.2378 15.3854 13.4169L9.69722 18.7469C9.50277 18.9204 9.24835 19.0109 8.98827 18.999C8.7282 18.9871 8.48306 18.8737 8.30519 18.6832C8.12732 18.4927 8.0308 18.24 8.03624 17.9791C8.04167 17.7182 8.14864 17.4698 8.3343 17.2869L13.9626 12.0169L8.3343 6.7469C8.23488 6.6582 8.15418 6.5504 8.09695 6.43C8.03972 6.3096 8.00711 6.1789 8.00104 6.0456C7.99497 5.9123 8.01557 5.7792 8.06161 5.654C8.10766 5.5289 8.17823 5.4142 8.26917 5.3168C8.36011 5.2194 8.46957 5.1412 8.59112 5.0868C8.71266 5.0324 8.84383 5.003 8.97691 5.0002C9.10998 4.9974 9.24226 5.0214 9.36597 5.0706C9.48968 5.1198 9.6023 5.1934 9.69722 5.2869L15.3844 10.6129C15.5772 10.7924 15.7313 11.0095 15.8372 11.251C15.9431 11.4925 15.9985 11.7531 16 12.0169Z" fill="#FF0000" />
					</svg>
				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

<?php else : ?>

	<?php wc_print_notice(esc_html__('No order has been made yet.', 'woocommerce') . ' <a class="woocommerce-Button button' . esc_attr($wp_button_class) . '" href="' . esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))) . '">' . esc_html__('Browse products', 'woocommerce') . '</a>', 'notice'); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment 
	?>

<?php endif; ?>

<?php do_action('woocommerce_after_account_orders', $has_orders); ?>
<style>
	section.my_account .woocommerce-MyAccount-content {
		padding: 0 !important;
		background-color: transparent;
	}
</style>