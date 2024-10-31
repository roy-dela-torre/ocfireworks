<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="col-xl-8 col-lg-12">
<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<th class="product-thumbnail"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
				<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				/**
				 * Filter the product name.
				 *
				 * @since 2.1.0
				 * @param string $product_name Name of the product in the cart.
				 * @param array $cart_item The product in the cart.
				 * @param string $cart_item_key Key for the product in the cart.
				 */
				$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">


						<td class="product-thumbnail">
							<div class="product_container">
								<?php
										echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											'woocommerce_cart_item_remove_link',
											sprintf(
												'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
												<path d="M16.875 4.25H13.75V3.625C13.75 3.12772 13.5525 2.65081 13.2008 2.29917C12.8492 1.94754 12.3723 1.75 11.875 1.75H8.125C7.62772 1.75 7.15081 1.94754 6.79917 2.29917C6.44754 2.65081 6.25 3.12772 6.25 3.625V4.25H3.125C2.95924 4.25 2.80027 4.31585 2.68306 4.43306C2.56585 4.55027 2.5 4.70924 2.5 4.875C2.5 5.04076 2.56585 5.19973 2.68306 5.31694C2.80027 5.43415 2.95924 5.5 3.125 5.5H3.75V16.75C3.75 17.0815 3.8817 17.3995 4.11612 17.6339C4.35054 17.8683 4.66848 18 5 18H15C15.3315 18 15.6495 17.8683 15.8839 17.6339C16.1183 17.3995 16.25 17.0815 16.25 16.75V5.5H16.875C17.0408 5.5 17.1997 5.43415 17.3169 5.31694C17.4342 5.19973 17.5 5.04076 17.5 4.875C17.5 4.70924 17.4342 4.55027 17.3169 4.43306C17.1997 4.31585 17.0408 4.25 16.875 4.25ZM8.75 13.625C8.75 13.7908 8.68415 13.9497 8.56694 14.0669C8.44973 14.1842 8.29076 14.25 8.125 14.25C7.95924 14.25 7.80027 14.1842 7.68306 14.0669C7.56585 13.9497 7.5 13.7908 7.5 13.625V8.625C7.5 8.45924 7.56585 8.30027 7.68306 8.18306C7.80027 8.06585 7.95924 8 8.125 8C8.29076 8 8.44973 8.06585 8.56694 8.18306C8.68415 8.30027 8.75 8.45924 8.75 8.625V13.625ZM12.5 13.625C12.5 13.7908 12.4342 13.9497 12.3169 14.0669C12.1997 14.1842 12.0408 14.25 11.875 14.25C11.7092 14.25 11.5503 14.1842 11.4331 14.0669C11.3158 13.9497 11.25 13.7908 11.25 13.625V8.625C11.25 8.45924 11.3158 8.30027 11.4331 8.18306C11.5503 8.06585 11.7092 8 11.875 8C12.0408 8 12.1997 8.06585 12.3169 8.18306C12.4342 8.30027 12.5 8.45924 12.5 8.625V13.625ZM12.5 4.25H7.5V3.625C7.5 3.45924 7.56585 3.30027 7.68306 3.18306C7.80027 3.06585 7.95924 3 8.125 3H11.875C12.0408 3 12.1997 3.06585 12.3169 3.18306C12.4342 3.30027 12.5 3.45924 12.5 3.625V4.25Z" fill="#BF2126"/>
											  </svg></a>',
												esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
												/* translators: %s is the product name */
												esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
												esc_attr( $product_id ),
												esc_attr( $_product->get_sku() )
											),
											$cart_item_key
										);
									?>
								<div class="products">
								<?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								if ( ! $product_permalink ) {
									echo $thumbnail; // PHPCS: XSS ok.
								} else {
									printf( '<a href="%s" target="_blank">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
								}
								?>
									<?php
								if ( ! $product_permalink ) {
									echo wp_kses_post( $product_name . '&nbsp;' );
								} else {
									/**
									 * This filter is documented above.
									 *
									 * @since 2.1.0
									 */
										echo wp_kses_post(
											apply_filters(
												'woocommerce_cart_item_name',
												sprintf(
													'<a href="%s" class="prod_name" target="_blank">%s%s</a>',
													esc_url( $product_permalink ),
													$_product->get_name(),
													$_product->is_on_sale() ? '<span class="on-sale"> (Sale)</span>' : ''
												),
												$cart_item,
												$cart_item_key
											)
										);
								}

								do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

								// Meta data.
								echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

								// Backorder notification.
								if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
									echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
								}
								?>
								</div>
							</div>
						</td>


						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
						<?php
							$product_price = $_product->get_price_html();
							$regular_price = $_product->get_regular_price();
							$sale_price = $_product->get_sale_price();

							if ($_product->is_on_sale() && $sale_price && $regular_price) {
								echo sprintf(
									'<span class="original-price"><del>%s</del></span> <span class="sale-price">%s</span>',
									wc_price($regular_price),
									wc_price($sale_price)
								);
							} else {
								echo sprintf(
									'<span class="regular-price">%s</span>',
									$product_price
								);
							}
							?>

						</td>

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
						<?php
						if ( $_product->is_sold_individually() ) {
							$min_quantity = 1;
							$max_quantity = 1;
						} else {
							$min_quantity = 0;
							$max_quantity = $_product->get_max_purchase_quantity();
						}

						$product_quantity = woocommerce_quantity_input(
							array(
								'input_name'   => "cart[{$cart_item_key}][qty]",
								'input_value'  => $cart_item['quantity'],
								'max_value'    => $max_quantity,
								'min_value'    => $min_quantity,
								'product_name' => $product_name,
							),
							$_product,
							false
						);

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						?>
						</td>

						<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<tr class="d-none">
				<td colspan="6" class="actions">

					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

					<button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<div class="group_button d-flex align-items-center w-100">
		<button type="submit" class="red_button update_cart button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
		<button class="black_button delete_cart_item" id="delete_cart_item">CLEAR CART</button>
	</div>

	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>
</div>
<div class="col-xl-4 col-lg-12">
	<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

	<div class="cart-collaterals">
		<?php
			/**
			 * Cart collaterals hook.
			 *
			 * @hooked woocommerce_cross_sell_display
			 * @hooked woocommerce_cart_totals - 10
			 */
			do_action( 'woocommerce_cart_collaterals' );
		?>
	</div>

	<?php do_action( 'woocommerce_after_cart' ); ?>
</div>
