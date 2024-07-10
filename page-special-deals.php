<?php get_header();
/*Template Name: Special Deals & Prices for Firework*/
$img = get_stylesheet_directory_uri().'/assets/img/special';
?>
<section class="special_deals">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header red_text">
                    <h1 class="text-center">Party Explosions: Deals & New Arrivals</h1>
                    <p class="text-center">Looking to light up your next celebration? Dive into our special main section where we've got all the dazzling deals and exciting new arrivals to make your party unforgettable. </p>
                </div>
                <?php
                $product_categories = get_terms(array(
                    'taxonomy' => 'special-fireworks',
                    'hide_empty' => false,
                    'posts_per_page' => -1,
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
                                    <!-- get the current url and then get the slug -->
                                    <?php
                                    $parsed_url = wp_parse_url($category_url);
                                    $path = trim($parsed_url['path'], '/');
                                    $path_segments = explode('/', $path);
                                    $slug = end($path_segments);
                                    ?>
                                    <!-- combine the home url and slug -->
                                    <a href="<?php echo get_home_url().'/'.$slug; ?>" target="_blank" rel="noopener noreferrer" class="stretched-link"></a>
                                    <?php
                                    $image_url = get_field('featured_image', 'term_' . $category->term_id);
                                    if ($image_url) {
                                        echo '<img class="w-100 img-fluid h-100 object-fit-cover" src="' . esc_url($image_url) . '" alt="'.esc_html($category->name).'">';
                                    } else {
                                        echo '<img class="w-100 img-fluid h-100 object-fit-cover" src="' . esc_url(get_template_directory_uri() . '/fallback-image.jpg') . '" alt="'.esc_html($category->name).'">';
                                    }
                                    ?>
                                    <h2 class="text-white mb-0 position-absolute text-center"><?php echo esc_html($category->name); ?></h2>
                                </div>
                            </div>
                            <?php
                        }
                    }
                } else {
                    echo 'No product categories found';
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer();?>