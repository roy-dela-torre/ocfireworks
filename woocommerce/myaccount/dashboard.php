<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
$current_user = wp_get_current_user();
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/dashboard.css">
<p class="name text-uppercase font-weight-700">Hello <?php echo esc_attr( $current_user->first_name ); ?> <?php echo esc_attr( $current_user->last_name ); ?> (NOT <?php echo esc_attr( $current_user->first_name ); ?> <?php echo esc_attr( $current_user->last_name ); ?>? <a class="red_text" href="<?php echo wp_logout_url( get_home_url() ); ?>">LOGOUT)</a></p>

<p>From your account dashboard, you can view your <a href="<?php echo get_home_url(); ?>/account/orders/" target="_blank" class="red_text font-weight-300">recent orders</a>, manage your <a href="<?php echo get_home_url(); ?>/account/edit-add target="_blank" class="red_text font-weight-300"ress/">shipping and billing addresses</a>, and <a href="<?php echo get_home_url(); ?>/account/edit-acc target="_blank" class="red_text font-weight-300"ount/">edit your password and account details</a>.</p>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
