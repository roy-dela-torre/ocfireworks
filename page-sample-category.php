<?php
get_header();
/* Template Name: Category */

$img_path = get_stylesheet_directory_uri() . '/assets/img/';

$current_page_id = get_queried_object_id();
$page_slug = get_post_field('post_name', $current_page_id);
$taxonomies = get_object_taxonomies('product', 'names');
$found_taxonomy = '';

foreach ($taxonomies as $taxonomy) {
    $term = get_term_by('slug', $page_slug, $taxonomy);
    if ($term && !is_wp_error($term)) {
        $found_taxonomy = $taxonomy;
        break;
    }
}

?>
<section class="category">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header red_text">
                    <h1 class="text-center"><?php single_cat_title(); ?></h1>
                    <p class="text-center"><?php echo category_description(); ?></p>
                </div>
                <?php
                $current_category = get_queried_object();
                $product_categories = get_terms(array(
                    'taxonomy' => $current_category->taxonomy,
                    'hide_empty' => true
                ));

                if ($product_categories && !is_wp_error($product_categories)) {
                    foreach ($product_categories as $category) {
                        if (esc_html($category->name) === "Uncategorized") {
                            continue;
                        }
                        $category_url = get_term_link($category);
                        if (!is_wp_error($category_url)) {
                            ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="content">
                                    <a href="<?php echo esc_url($category_url); ?>" class="stretched-link"></a>
                                    <?php
                                    $image_url = get_field('category_image', 'term_' . $category->term_id);
                                    if ($image_url) {
                                        echo '<img class="w-100 img-fluid h-100 object-fit-cover" src="' . esc_url($image_url) . '" alt="' . esc_attr($category->name) . '">';
                                    } else {
                                        echo '<img class="w-100 img-fluid h-100 object-fit-cover" src="' . esc_url($img_path . 'fallback-image.jpg') . '" alt="Fallback Image">';
                                    }
                                    ?>
                                    <h2 class="text-white mb-0 position-absolute text-center"><?php echo esc_html($category->name); ?></h2>
                                </div>
                            </div>
                            <?php
                        }
                    }
                } else {
                    echo '<p class="text-center">No categories found</p>';
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();
?>
