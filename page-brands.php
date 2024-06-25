<?php get_header();
/*Template Name: Brands*/
?>
<section class="brands">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <h1 class="text-center red_text">Browse the Best: Top Brands, Top Fireworks!</h1>
                </div>
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $posts_per_page = 12;

                $product_categories = get_terms(array(
                    'taxonomy' => 'brands',
                    'hide_empty' => false,
                    'paged' => $paged,
                    'number' => $posts_per_page
                ));

                if ($product_categories && !is_wp_error($product_categories)) {
                    foreach ($product_categories as $category) {
                        if (esc_html($category->name) === "Uncategorized") {
                            continue;
                        }
                        $category_url = get_term_link($category);
                        if (!is_wp_error($category_url)) {
                            ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                <div class="content position-relative d-flex flex-column align-items-center">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/brands/barnds.png" alt="" class="mb-4">
                                    <h5 class="text-center"><a href="<?php echo esc_url($category_url); ?>" rel="noopener noreferrer" class="stretched-link "></a><?php echo esc_html($category->name); ?></h5>
                                </div>
                            </div>
                            <?php
                        }
                    }
                } else {
                    echo 'No product categories found';
                }
                ?>
                <div class="paging d-flex justify-content-center align-items-center">
                    <?php
                    $total_categories = wp_count_terms('brands');
                    $total_pages = ceil($total_categories / $posts_per_page);
                    echo paginate_links(array(
                        'total' => $total_pages,
                        'current' => $paged,
                        'mid_size' => 2
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>