<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}

$img_url = wp_get_attachment_url($product->get_image_id());
$product_title = get_the_title($product->get_id());
$product_short_description = $product->get_short_description();
$product_link = get_permalink($product->get_id());
$product_price = $product->get_price_html();

$col = "";
if (is_page('recently-viewed') || is_archive()) {
    $col = "col-xl-4 col-sm-6 col-12";
} else if (is_page() || is_archive() || is_tax()) {
    $col = "col-xl-4 col-sm-6 col-12";
} elseif (is_account_page() && !is_page('recently-viewed')) {
    $col = "col-xl-4 col-sm-6 col-12";
} elseif (is_single()) {
    $col = "col-lg-3 col-md-4 col-sm-6 col-12";
} else {
    $col = "col-lg-3 col-md-4 col-sm-6 col-12";
}

$data = array(
    'img_url' => $img_url,     // Image URL
    'title' => $product_title, // Product title
    'price' => $product_price, // Product price
    'product_url' => $product_link,
    'product' => $product,
    'product_id' => $product->get_id(),
    'video_iframe' => get_field('video_iframe', $product->get_id())
);

// Load the template
ob_start();
if (is_page('4th of July Fireworks for Sale | OC Fireworks') || is_page(281)) : ?>
    <div class="<?php echo $col; ?> product_column">
        <?php echo wc_get_template('template/product_content.php', $data); ?>
    </div>
<?php else : ?>
    <div class="<?php echo $col; ?> product_column">
        <?php echo wc_get_template('template/product_content.php', $data); ?>
    </div>
<?php endif;
$content = ob_get_clean();
// Output the content
echo $content;
?>