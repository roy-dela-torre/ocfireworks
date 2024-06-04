<?php get_header();
/*Template Name: Events*/
$img_path = get_stylesheet_directory_uri().'/assets/img/events/';
?>
<section class="events">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header red_text">
                    <h1 class="text-center">Gorem ipsum dolor sit amet Events adipiscing elit</h1>
                    <p class="text-center">Dorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>
                </div>
                <?php
                $product_categories = get_terms(array(
                    'taxonomy' => 'fireworks-for-events',
                    'hide_empty' => false,
                    'number' => -1
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
                            <div class="col-lg-4 col-md-6">
                                <div class="content">
                                    <a href="http://" target="_blank" rel="noopener noreferrer" class="stretched-link"></a>
                                    <img class="w-100 img-fluid h-100 object-fit-cover" src="<?php echo $img_path; ?>/Fourth of July.jpg" alt="Fourth of July Fireworks">
                                    <h2 class="text-white mb-0 position-absolute text-center">Fourth of July Fireworks</h2>
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