<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // Make sure $order_id is set before this line

if ( ! $order ) {
    return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();
if (is_wc_endpoint_url('view-order')) { ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/order_details.css">
<div class="order-items">
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
			<tbody>
				<?php
				// Define the table headers
				$table_head = array('Product', 'Price', 'Quantity', 'Total');
				
				// Loop through the order items
				foreach ($order->get_items() as $item_id => $item) {
					$product = $item->get_product();
					$img_url = get_the_post_thumbnail_url($product->get_id(), 'large');
					$price = wc_price($item->get_subtotal() / $item->get_quantity()); // Price per item
					$quantity = $item->get_quantity(); // Quantity of the product
					$total = wc_price($item->get_total()); // Total for this item
					$title = $item->get_name(); // Product title
					$product_url = get_permalink($product->get_id());
					$product_id = $product->get_id();

					// Add to cart button logic
					$add_to_cart = '<a href="' . ($product->is_in_stock() 
						? esc_url(wc_get_cart_url() . '?add-to-cart=' . esc_attr($product_id)) 
						: 'javascript:void(0);') . '" target="_blank" class="red_button w-100 text-center back_to_order_status">Add to cart</a>';
				?>
					<tr>
						<td data-label="<?php echo esc_attr($table_head[0]); ?>">
							<div class="product_column">
								<a href="<?php echo esc_url($product_url); ?>" target="_blank">
									<img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>" width="50">
								</a>
								<p class="product_name">
									<a href="<?php echo esc_url($product_url); ?>">
										<?php echo esc_html($title); ?>
									</a>
								</p>
							</div>
						</td>
						<td data-label="<?php echo esc_attr($table_head[1]); ?>"><?php echo $price; ?></td>
						<td data-label="<?php echo esc_attr($table_head[2]); ?>"><?php echo esc_html($quantity); ?>x</td>
						<td data-label="<?php echo esc_attr($table_head[3]); ?>"><?php echo $total; ?></td>
					</tr>
				<?php } ?>
			</tbody>

        </table>
		<div class="order-totals">
			<?php foreach ( $order->get_order_item_totals() as $key => $total ) : ?>
				<div class="order-total">
					<span class="total-label"><?php echo esc_html( $total['label'] ); ?></span>
					<span class="total-value"><?php echo wp_kses_post( $total['value'] ); ?></span>
				</div>
			<?php endforeach; ?>

			<?php if ( $order->get_customer_note() ) : ?>
				<div class="order-note">
					<span class="note-label"><?php esc_html_e( 'Note:', 'woocommerce' ); ?></span>
					<span class="note-value"><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></span>
				</div>
			<?php endif; ?>
		</div>
		
		<div class="shipping_and_billing_address">
			<div class="billing_address">
				<h4>Billing address</h4>
				<p class="company"><?php echo esc_html($order->get_billing_company()); ?></p>
				<p class="country"><?php echo esc_html(WC()->countries->countries[$order->get_billing_country()]); ?></p>
				<p class="address"><?php echo esc_html($order->get_billing_address_1()); ?>, <?php echo esc_html($order->get_billing_address_2()); ?></p>
				<p class="state_province"><?php echo esc_html($order->get_billing_city() . ', ' . $order->get_billing_state()); ?></p>
				<p class="zip_code"><?php echo esc_html($order->get_billing_postcode()); ?></p>
			</div>
			<?php if (! $order->has_status('failed') && $order->needs_shipping_address()) : ?>
				<div class="shipping_address_">
					<h4><?php esc_html_e('Shipping Address', 'woocommerce'); ?></h4>
					<p class="company"><?php echo esc_html($order->get_shipping_company()); ?></p>
					<p class="country"><?php echo esc_html(WC()->countries->countries[$order->get_shipping_country()]); ?></p>
					<p class="address"><?php echo esc_html($order->get_shipping_address_1()); ?>, <?php echo esc_html($order->get_shipping_address_2()); ?></p>
					<p class="state_province"><?php echo esc_html($order->get_shipping_city() . ', ' . $order->get_shipping_state()); ?></p>
					<p class="zip_code"><?php echo esc_html($order->get_shipping_postcode()); ?></p>
				</div>
			<?php endif; ?>
		</div>
    </div>
</div>

<?php }

if ( $show_downloads ) {
    wc_get_template(
        'order/order-downloads.php',
        array(
            'downloads'  => $downloads,
            'show_title' => true,
        )
    );
}
else if(!is_order_received_page()): ?>
	<div class="woocommerce-order-details d-none">
		<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

		<h2 class="woocommerce-order-details__title"><?php esc_html_e( 'Order details', 'woocommerce' ); ?></h2>

		<div class="order-items">
			<div class="row">
				<?php
				// Display the items in this order
				foreach ($order_items as $item_id => $item) {
					$product = $item->get_product();
					$img_url = get_the_post_thumbnail_url($product->get_id(), 'large');
					$price = $product->get_price_html();
					$title = $item->get_name(); // Get the title of the product
					$product_url = get_permalink($product->get_id());
					$product_id =  $product->get_id();
					$add_to_cart = '<a href="' . ($product->get_stock_status() === 'outofstock' ? 'javascript:void(0);' : esc_url(wc_get_cart_url() . '?add-to-cart=' . esc_attr($product_id))) . '" target="_blank" class="red_button w-100 text-center">Add to cart</a>';
					?>
					<div class="col-md-6 col-sm-12 product_column">
						<?php
						// Set up data to pass to the template
						$data = array(
							'img_url' => $img_url,     // Image URL
							'title' => $title, // Product title
							'price' => $price, // Product price
							'product_url' => $product_url,
							'product' => $product,
							'product_id' => $product_id
						);
						// Load the template
						echo wc_get_template('template/product_content.php', $data);
						?>
					</div>
					<?php
				}
				?>
			</div>
		</div>

		<div class="order-totals">
			<?php foreach ( $order->get_order_item_totals() as $key => $total ) : ?>
				<div class="order-total">
					<span class="total-label"><?php echo esc_html( $total['label'] ); ?></span>
					<span class="total-value"><?php echo wp_kses_post( $total['value'] ); ?></span>
				</div>
			<?php endforeach; ?>

			<?php if ( $order->get_customer_note() ) : ?>
				<div class="order-note">
					<span class="note-label"><?php esc_html_e( 'Note:', 'woocommerce' ); ?></span>
					<span class="note-value"><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></span>
				</div>
			<?php endif; ?>
		</div>

		<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
	</div>
<?php else: ?>
	<?php
	/**
	 * Action hook fired after the order details.
	 *
	 * @since 4.4.0
	 * @param WC_Order $order Order data.
	 */
	do_action( 'woocommerce_after_order_details', $order );

	if ( $show_customer_details ) {
		wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
	}
endif;
?>
