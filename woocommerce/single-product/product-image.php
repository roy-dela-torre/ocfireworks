<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'carousel',
		'slide',
	)
);
?>
<div id="carouselExampleCaptions" class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php
        $gallery_images = $product->get_gallery_image_ids();
        
        // Featured image
        $active_class = 'active';
        ?>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="<?php echo esc_attr( $active_class ); ?>" aria-current="true" aria-label="Slide 1">
            <?php echo wp_get_attachment_image( $post_thumbnail_id, 'full', false, array( 'class' => 'd-block w-100' ) ); ?>
        </button>
        <?php
        foreach ( $gallery_images as $index => $image_id ) {
            $active_class = ( $index === 0 ) ? 'active' : '';
            ?>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo esc_attr( $index + 1 ); ?>" class="<?php echo esc_attr( $active_class ); ?>" aria-current="true" aria-label="Slide <?php echo esc_attr( $index + 2 ); ?>">
                <?php echo wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'd-block w-100' ) ); ?>
            </button>
            <?php
        }
        ?>
    </div>
    <div class="carousel-inner">
        <?php
        // Featured image
        $active_class = 'active';
        ?>
        <div class="carousel-item <?php echo esc_attr( $active_class ); ?>">
            <?php echo wp_get_attachment_image( $post_thumbnail_id, 'full', false, array( 'class' => 'd-block w-100' ) ); ?>
            <div class="carousel-caption d-none d-md-block">
                <h5><?php echo esc_html__( 'Slide label', 'your-text-domain' ); ?></h5>
                <p><?php echo esc_html__( 'Some representative placeholder content for the slide.', 'your-text-domain' ); ?></p>
            </div>
        </div>
        <?php
        foreach ( $gallery_images as $index => $image_id ) {
            $active_class = ( $index === 0 ) ? 'active' : '';
            ?>
            <div class="carousel-item <?php echo esc_attr( $active_class ); ?>">
                <?php echo wp_get_attachment_image( $image_id, 'full', false, array( 'class' => 'd-block w-100' ) ); ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>