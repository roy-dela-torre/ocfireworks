<?php get_header();
    $current_page_id = get_the_ID();
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
    if($found_taxonomy == 'sky-show'){
        get_template_part('woocommerce/archive', 'product'); 
    }else{
?>

<section class="page">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <h1 class="text-center">Template Not exist</h1>
            </div>
        </div>
    </div>
</section>
<?php }
get_footer();?>