<?php
add_filter('woocommerce_product_tabs', 'update_product_tab_titles');
function update_product_tab_titles($tabs)
{
    $tabs['description']['title'] = __('overview', 'woocommerce');
    $tabs['reviews']['title'] = __('review', 'woocommerce');
    return $tabs;
}


add_action('template_redirect', 'bbloomer_track_product_view', 9999);

function bbloomer_track_product_view()
{
    if (! is_singular('product')) return;
    global $post;
    if (empty($_COOKIE['bbloomer_recently_viewed'])) {
        $viewed_products = array();
    } else {
        $viewed_products = wp_parse_id_list((array) explode('|', wp_unslash($_COOKIE['bbloomer_recently_viewed'])));
    }
    $keys = array_flip($viewed_products);
    if (isset($keys[$post->ID])) {
        unset($viewed_products[$keys[$post->ID]]);
    }
    $viewed_products[] = $post->ID;
    if (count($viewed_products) > 15) {
        array_shift($viewed_products);
    }
    wc_setcookie('bbloomer_recently_viewed', implode('|', $viewed_products));
}

add_shortcode('recently_viewed_products', 'bbloomer_recently_viewed_shortcode');

function bbloomer_recently_viewed_shortcode()
{
    $viewed_products = ! empty($_COOKIE['bbloomer_recently_viewed']) ? (array) explode('|', wp_unslash($_COOKIE['bbloomer_recently_viewed'])) : array();
    $viewed_products = array_reverse(array_filter(array_map('absint', $viewed_products)));
    if (empty($viewed_products)) return;
    $title = '<h3>Recently Viewed</h3>';
    $product_ids = implode(",", $viewed_products);
    return $title . do_shortcode("[products ids='$product_ids']");
}



function add_custom_my_account_endpoint()
{
    add_rewrite_endpoint('recently-viewed', EP_ROOT | EP_PAGES);
}
add_action('init', 'add_custom_my_account_endpoint');



function display_recently_viewed_products()
{
    echo do_shortcode('[recently_viewed_products]');
}
add_action('woocommerce_account_recently-viewed_endpoint', 'display_recently_viewed_products');


function add_custom_my_account_endpoint_news_letter()
{
    add_rewrite_endpoint('news-letter', EP_ROOT | EP_PAGES);
}
add_action('init', 'add_custom_my_account_endpoint_news_letter');

function add_custom_query_vars_news_letter($vars)
{
    $vars[] = 'news-letter';
    return $vars;
}
add_filter('query_vars', 'add_custom_query_vars_news_letter');

function custom_my_account_endpoint_news_letter_content()
{
    wc_get_template_part('myaccount/news-letter');
}
add_action('woocommerce_account_news-letter_endpoint', 'custom_my_account_endpoint_news_letter_content');




function add_custom_my_account_endpoint_order_status()
{
    add_rewrite_endpoint('order-status', EP_ROOT | EP_PAGES);
}
add_action('init', 'add_custom_my_account_endpoint_order_status');

function add_custom_query_vars_order_status($vars)
{
    $vars[] = 'order-status';
    return $vars;
}
add_filter('query_vars', 'add_custom_query_vars_order_status');

function custom_my_account_endpoint_order_status_content()
{
    wc_get_template_part('myaccount/order-status');
}
add_action('woocommerce_account_order-status_endpoint', 'custom_my_account_endpoint_order_status_content');
