<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit; ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/forgot_password.css">
<section class="forget_password">
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="forget_password_form">
						<h1 class="text-white">Spark a New Password </h1>
						<?php do_action( 'woocommerce_before_lost_password_form' ); ?>
							<form method="post" class="woocommerce-ResetPassword lost_reset_password">
								<p class="mb-0"><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Let\'s get you back in. Enter your email address and we\'ll send you instructions to reset your password.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>
								<input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" placeholder="Enter your username or email address"/>
								<?php do_action( 'woocommerce_lostpassword_form' ); ?>
								<p class="woocommerce-form-row form-row">
									<input type="hidden" name="wc_reset_password" value="true" />
									<button type="submit" class="black_button w-100 woocommerce-Button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
								</p>
								<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
							</form>
						<?php do_action( 'woocommerce_after_lost_password_form' ); ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
                    <div class="image">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/forgot_password_image.jpg" alt="">
                    </div>
                </div>
			</div>
		</div>
	</div>
</section>
