<?php
defined('ABSPATH') || exit;

if (!function_exists('wc_get_gallery_image_html')) {
    return;
}

global $product;

$columns = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();
$gallery_images = $product->get_gallery_image_ids(); // Fetch gallery images
$wrapper_classes = apply_filters(
    'woocommerce_single_product_image_gallery_classes',
    array('carousel', 'slide')
);

// Placeholder image URL
$placeholder_url = 'https://ocfireworks.innovnational.com/wp-content/uploads/woocommerce-placeholder.png';

// Get product title for alt text
$product_title = $product->get_name();
?>

<div id="carouselExampleCaptions" class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php
        $active_class = 'active'; // Mark the first image as active
        $count = 1;

        // Use the featured image or fallback to the placeholder
        $featured_image = $post_thumbnail_id ? 
            wp_get_attachment_image($post_thumbnail_id, 'full', false, array('class' => 'd-block w-100', 'alt' => esc_attr($product_title . '-' . $count))) : 
            '<img src="' . esc_url($placeholder_url) . '" class="d-block w-100" alt="' . esc_attr($product_title . '-1') . '">';
        ?>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="<?php echo esc_attr($active_class); ?>" aria-current="true" aria-label="Slide 1">
            <?php echo $featured_image; ?>
        </button>

        <?php
        foreach ($gallery_images as $index => $image_id) {
            $count++; // Increment the alt suffix for each image
            $active_class = ($index === 0) ? 'active' : '';
            ?>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo esc_attr($index + 1); ?>" class="<?php echo esc_attr($active_class); ?>" aria-label="Slide <?php echo esc_attr($index + 2); ?>">
                <?php 
                echo wp_get_attachment_image($image_id, 'full', false, array(
                    'class' => 'd-block w-100',
                    'alt'   => esc_attr($product_title . '-' . $count),
                )); 
                ?>
            </button>
            <?php
        }
        ?>
    </div>

    <div class="carousel-inner">
        <?php
        $active_class = 'active'; // First item active

        // Featured image or placeholder as the first carousel item
        ?>
        <div class="carousel-item <?php echo esc_attr($active_class); ?>">
            <?php echo $featured_image; ?>
        </div>

        <?php
        foreach ($gallery_images as $index => $image_id) {
            $count++; // Increment the alt suffix
            $active_class = ($index === 0) ? 'active' : '';
            ?>
            <div class="carousel-item <?php echo esc_attr($active_class); ?>">
                <?php 
                echo wp_get_attachment_image($image_id, 'full', false, array(
                    'class' => 'd-block w-100',
                    'alt'   => esc_attr($product_title . '-' . $count),
                )); 
                ?>
            </div>
            <?php
        }

        // If no gallery images, use the placeholder for remaining items
        if (empty($gallery_images)) {
            ?>
            <div class="carousel-item">
                <img src="<?php echo esc_url($placeholder_url); ?>" class="d-block w-100" alt="<?php echo esc_attr($product_title . '-2'); ?>">
            </div>
            <?php
        }
        ?>
    </div>
</div>
