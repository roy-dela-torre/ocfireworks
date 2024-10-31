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

 defined('ABSPATH') || exit;
 
 // Get the current user
 $current_user = wp_get_current_user();
 
 // Fetch all orders of the current user
 $customer_orders = wc_get_orders(array(
	 'customer' => $current_user->ID,
	 'status'   => array_keys(wc_get_order_statuses()),
	 'limit'    => -1,
 ));
 
 // Initialize an array to store unique products
 $unique_products = array();
 $max_products_per_page = 6;
 
 if ($customer_orders) {
	 foreach ($customer_orders as $customer_order) {
		 $order_items = $customer_order->get_items();
 
		 foreach ($order_items as $item) {
			 $product = $item->get_product();
			 $product_id = $product->get_id();
 
			 // Check if the product is already added
			 if (!array_key_exists($product_id, $unique_products)) {
				 // Add product to the array if it's not already added
				 $unique_products[$product_id] = $product;
			 }
		 }
	 }
 }
 
 // Pagination setup
 $total_products = count($unique_products);
 $total_pages = ceil($total_products / $max_products_per_page);
 $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
 
 // Get products for the current page
 $offset = ($current_page - 1) * $max_products_per_page;
 $paged_products = array_slice($unique_products, $offset, $max_products_per_page);
 
 if (!empty($paged_products)) {
	 echo '<div class="woocommerce-order-details">';
	 echo '<h2 class="woocommerce-order-details__title">' . esc_html__('Order details', 'woocommerce') . '</h2>';
	 echo '<div class="order-items row">';
 
	 foreach ($paged_products as $product) {
		 $img_url = get_the_post_thumbnail_url($product->get_id(), 'large');
		 $price = $product->get_price_html();
		 $title = $product->get_name();
		 $product_url = get_the_permalink($product->get_id());
		 $product_id = $product->get_id();
		 $add_to_cart = '<a href="' . ($product->get_stock_status() === 'outofstock' ? 'javascript:void(0);' : esc_url(wc_get_cart_url() . '?add-to-cart=' . esc_attr($product_id))) . '" target="_blank" class="red_button w-100 text-center">Add to cart</a>';
		 ?>
		 <div class="col-md-6 col-sm-12 product_column">
			 <?php
			 // Set up data to pass to the template
			 $data = array(
				 'img_url' => $img_url,
				 'title' => $title,
				 'price' => $price,
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
 
	 echo '</div>'; // Close order-items
 
	 // Pagination links
	 echo '<div class="paging d-flex justify-content-center align-items-center">';
	 echo paginate_links(array(
		 'total' => $total_pages,
		 'current' => $current_page,
		 'mid_size' => 2,
		 'prev_text' => __('« Prev', 'textdomain'),
		 'next_text' => __('Next »', 'textdomain'),
	 ));
	 echo '</div>'; // Close pagination
 
	 echo '</div>'; // Close woocommerce-order-details
 } else {
	 echo '<p>No unique products found.</p>';
 }
 ?>
 