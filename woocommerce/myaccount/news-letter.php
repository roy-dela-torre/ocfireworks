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

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
} ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/news-letter.css">
<div class="news_letter_content">
    <div class="image_banner">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/my_account/news_letter_banner.jpg" alt="News Letter">
    </div>
    <div class="content">
        <h3>Subscribe to our newsletter</h3>
        <p>Be the first to know about our dazzling new products, exclusive discounts, and thrilling events. Subscribe to our newsletter and ignite your inbox with fireworks excitement! Join our pyrotechnic family today and let the sparks fly.</p>
        <?php echo do_shortcode('[contact-form-7 id="253a8fa" title="News Letter My Account"]'); ?>
    </div>
</div>