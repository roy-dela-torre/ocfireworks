<?php $img = get_stylesheet_directory_uri().'/assets/img/homepage'; ?>
<section class="brands px-0">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h2 class="text-center"><?php echo $title?></h2>
            <?php echo is_page('about-us') ? '<p class="text-center">We carry the hottest and most recognized brands at the lowest prices possible.</p>' : ''?>
            
            <div class="owl-carousel owl-theme p-0 <?php echo !is_front_page() ? 'mb-0' : ''?>" id="brands">
                <?php
                $product_categories = get_terms(array(
                    'taxonomy' => 'product_cat', // assuming 'product_cat' is the taxonomy for WooCommerce product categories
                    'hide_empty' => false, // set to true if you want to hide empty categories
                ));
                if ($product_categories && !is_wp_error($product_categories)) {
                    ?>
                   <?php 
                    foreach ($product_categories as $category) {
                        // Skip the "Uncategorized" category and move to the next iteration
                        if (esc_html($category->name) === "Uncategorized") {
                            continue;
                        }
                        $category_url = get_term_link($category);
                        if (!is_wp_error($category_url)) {

                            ?>
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/brands/barnds.png" alt="<?php echo esc_url($category_url); ?>" class="mb-4">
                            <?php
                        }
                    }
                } else {
                    echo 'No product categories found';
                }
                ?>
            </div>
            <?php if(is_front_page()):?>
                <a href="<?php echo get_home_url(); ?>/brands" target="_blank" rel="noopener noreferrer" class="view_all red_button">View All</a>
            <?php endif; ?>
        </div>
    </div>
</section>
<style>
    section.brands h2 {
        margin-bottom: 50px;
    }

    section.brands #brands {
        margin-bottom: 50px;
    }
    <?php if (!is_page('brands')): ?>
        section.brands #brands img{
            width: 186px;
            object-fit: contain;
        }
    <?php endif; ?>
</style>