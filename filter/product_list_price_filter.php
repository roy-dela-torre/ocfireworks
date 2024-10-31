<?php
/* Template Name: Price Filter */ ?>
<div class="product_list">
    <?php
   // Get the taxonomy parameter from the URL
   $taxonomy_param = isset($_GET['taxonomy']) ? sanitize_text_field($_GET['taxonomy']) : '';
        
   // Default to current page slug if no taxonomy parameter is provided
   if (empty($taxonomy_param)) {
       $current_page_id = get_the_ID();
       $taxonomy_param = get_post_field('post_name', $current_page_id);
   }
   
   $taxonomies = get_object_taxonomies('product', 'names');
   $found_taxonomy = '';
   foreach ($taxonomies as $taxonomy) {
       $term = get_term_by('slug', $taxonomy_param, $taxonomy);
       if ($term && !is_wp_error($term)) {
           $found_taxonomy = $taxonomy;
           break;
       }
   }
   
   // Get the price parameter from the URL
   $price_param = isset($_GET['price']) ? sanitize_text_field($_GET['price']) : '';
   
   // Define default price range
   $price_range = array(30, 50);
   
   // Check if the price parameter is set and is a valid range
   if (!empty($price_param)) {
       $price_values = explode('-', $price_param);
       if (count($price_values) == 2 && is_numeric($price_values[0]) && is_numeric($price_values[1])) {
           $price_range = array((float)$price_values[0], (float)$price_values[1]);
       }
   }

   global $paged;
   $curpage = $paged ? $paged : 1;
   $args = array(
       'post_type'      => 'product',
       'posts_per_page' => 6,
       'post_status'    => 'publish',
       'orderby'        => 'rand', // Order by random
       'paged'          => $paged,
       'tax_query'      => array(
           array(
               'taxonomy' => $found_taxonomy,
               'field'    => 'slug',
               'terms'    => $taxonomy_param,
           ),
       ),
       'meta_query'     => array(
           array(
               'key'     => '_price',
               'value'   => $price_range,
               'compare' => 'BETWEEN',
               'type'    => 'NUMERIC'
           ),
       ),
   );
   $productLoop = new WP_Query($args);

   if ($productLoop->have_posts()) :
       woocommerce_product_loop_start();
       while ($productLoop->have_posts()) : $productLoop->the_post();
           wc_get_template_part('content', 'product');
       endwhile;
       woocommerce_product_loop_end();
       wp_reset_postdata();
       ?>
       <div class="paging d-flex justify-content-center align-items-center">
           <?php
           $totalPages = $productLoop->max_num_pages;
           echo paginate_links(array(
               'total'     => $totalPages,
               'mid_size'  => 2
           ));
           ?>
       </div>
       <?php
   else :
       do_action('woocommerce_no_products_found');
   endif; ?>
</div>
