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
	<div class="woocommerce-order-details">
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
