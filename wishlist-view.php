<?php
if (!defined('YITH_WCWL')) {
    exit;
} // Exit if accessed directly
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/wishlist.css">
<!-- WISHLIST GRID -->
<div class="row">
    <?php
    if ($wishlist && $wishlist->has_items()) :
        foreach ($wishlist_items as $item) :
            global $product;

            $product = $item->get_product();

            if ($product && $product->exists()) :
                ?>
                <div class="col-md-3">
                    <div class="content" id="yith-wcwl-row-<?php echo esc_attr($item->get_product_id()); ?>"
                         data-row-id="<?php echo esc_attr($item->get_product_id()); ?>">

                        <?php if ($show_remove_product) : ?>
                            <div class="product-remove">
                                <span class="nobr">
                                    <a href="<?php echo esc_url($item->get_remove_url()); ?>"
                                       class="remove remove_from_wishlist"
                                       title="<?php echo esc_html(apply_filters('yith_wcwl_remove_product_wishlist_message_title', __('Remove this product', 'yith-woocommerce-wishlist'))); ?>">
                                        &times;
                                    </a>
                                </span>
                            </div>
                        <?php endif; ?>

                        <div class="product-thumbnail">
                            <?php
                            do_action('yith_wcwl_table_before_product_thumbnail', $item, $wishlist);
                            ?>

                            <a href="<?php echo esc_url(get_permalink(apply_filters('woocommerce_in_cart_product', $item->get_product_id()))); ?>">
                                <?php echo wp_kses_post($product->get_image()); ?>
                            </a>

                            <?php
                            do_action('yith_wcwl_table_after_product_thumbnail', $item, $wishlist);
                            ?>
                        </div>

                        <p class="name">
                            <?php
                            do_action('yith_wcwl_table_before_product_name', $item, $wishlist);
                            ?>

                            <a href="<?php echo esc_url(get_permalink(apply_filters('woocommerce_in_cart_product', $item->get_product_id()))); ?>">
                                <?php echo wp_kses_post(apply_filters('woocommerce_in_cartproduct_obj_title', $product->get_title(), $product)); ?>
                            </a>

                            <?php
                            if ($show_variation && $product->is_type('variation')) {
                                echo wp_kses_post(wc_get_formatted_variation($product));
                            }
                            ?>

                            <?php
                            do_action('yith_wcwl_table_after_product_name', $item, $wishlist);
                            ?>
                        </p>

                        <?php if ($show_price || $show_price_variations) : ?>
                            <p class="price">
                                <?php
                                do_action('yith_wcwl_table_before_product_price', $item, $wishlist);
                                ?>

                                <?php
                                if ($show_price) {
                                    echo wp_kses_post($item->get_formatted_product_price());
                                }

                                if ($show_price_variations) {
                                    echo wp_kses_post($item->get_price_variation());
                                }
                                ?>

                                <?php
                                do_action('yith_wcwl_table_after_product_price', $item, $wishlist);
                                ?>
                            </p>
                        <?php endif ?>

                        <?php if ($show_quantity) : ?>
                            <div class="product-quantity">
                                <?php
                                do_action('yith_wcwl_table_before_product_quantity', $item, $wishlist);
                                ?>
                                <?php if (!$no_interactions && $wishlist->current_user_can('update_quantity')) : ?>
                                    <input type="number" min="1" step="1"
                                           name="items[<?php echo esc_attr($item->get_product_id()); ?>][quantity]"
                                           value="<?php echo esc_attr($item->get_quantity()); ?>"/>
                                <?php else : ?>
                                    <?php echo esc_html($item->get_quantity()); ?>
                                <?php endif; ?>

                                <?php
                                do_action('yith_wcwl_table_after_product_quantity', $item, $wishlist);
                                ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($show_stock_status) : ?>
                            <div class="product-stock-status">
                                <?php
                                do_action('yith_wcwl_table_before_product_stock', $item, $wishlist);
                                ?>

                                <?php
                                $stock_status_html = 'out-of-stock' === $item->get_stock_status() ? '<span class="wishlist-out-of-stock">' . esc_html(apply_filters('yith_wcwl_out_of_stock_label', __('Out of stock', 'yith-woocommerce-wishlist'))) . '</span>' : '<span class="wishlist-in-stock">' . esc_html(apply_filters('yith_wcwl_in_stock_label', __('In Stock', 'yith-woocommerce-wishlist'))) . '</span>';
                                echo apply_filters('yith_wcwl_stock_status', $stock_status_html, $item, $wishlist);
                                ?>

                                <?php
                                do_action('yith_wcwl_table_after_product_stock', $item, $wishlist);
                                ?>
                            </div>
                        <?php endif ?>

                        <?php if ($show_last_column) : ?>
                            <div class="group-button">
                                <?php
                                do_action('yith_wcwl_table_before_product_cart', $item, $wishlist);
                                ?>
                                <?php
                                if ($show_dateadded && $item->get_date_added()) :
                                    // translators: date added label: 1 date added.
                                    echo '<span class="dateadded">' . esc_html(sprintf(__('Added on: %s', 'yith-woocommerce-wishlist'), $item->get_date_added_formatted())) . '</span>';
                                endif;
                                ?>
                                <?php
                                do_action('yith_wcwl_table_product_before_add_to_cart', $item, $wishlist);
                                ?>
                                <?php
                                $show_add_to_cart = apply_filters('yith_wcwl_table_product_show_add_to_cart', $show_add_to_cart, $item, $wishlist);
                                ?>
                                <?php if ($show_add_to_cart && $item->is_purchasable() && 'out-of-stock' !== $item->get_stock_status()) : ?>
                                    <?php woocommerce_template_loop_add_to_cart(array('quantity' => $show_quantity ? $item->get_quantity() : 1)); ?>
                                <?php endif ?>

                                <?php
                                do_action('yith_wcwl_table_product_after_add_to_cart', $item, $wishlist);
                                ?>
                                <?php
                                $move_to_another_wishlist = apply_filters('yith_wcwl_table_product_move_to_another_wishlist', $move_to_another_wishlist, $item, $wishlist);
                                ?>
                                <?php if ($move_to_another_wishlist && $available_multi_wishlist && count($users_wishlists) > 1) : ?>
                                    <?php if ('select' === $move_to_another_wishlist_type) : ?>
                                        <select class="change-wishlist selectBox">
                                            <option value=""><?php esc_html_e('Move', 'yith-woocommerce-wishlist'); ?></option>
                                            <?php
                                            foreach ($users_wishlists as $wl) :
                                                if ($wl->get_token() === $wishlist_token) {
                                                    continue;
                                                }
                                                ?>
                                                <option value="<?php echo esc_attr($wl->get_token()); ?>">
                                                    <?php echo sprintf('%s - %s', esc_html($wl->get_formatted_name()), esc_html($wl->get_formatted_privacy())); ?>
                                                </option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    <?php else : ?>
                                        <a href="#move_to_another_wishlist" class="move-to-another-wishlist-button"
                                           data-rel="prettyPhoto[move_to_another_wishlist]">
                                            <?php
                                            echo esc_html(apply_filters('yith_wcwl_move_to_another_list_label', __('Move to another list &rsaquo;', 'yith-woocommerce-wishlist')));
                                            ?>
                                        </a>
                                    <?php endif; ?>

                                    <?php
                                    do_action('yith_wcwl_table_product_after_move_to_another_wishlist', $item, $wishlist);
                                    ?>
                                <?php endif; ?>
                                <?php
                                if ($repeat_remove_button) :
                                    ?>
                                    <a href="<?php echo esc_url($item->get_remove_url()); ?>"
                                       class="remove_from_wishlist button"
                                       title="<?php echo esc_html(apply_filters('yith_wcwl_remove_product_wishlist_message_title', __('Remove this product', 'yith-woocommerce-wishlist'))); ?>">
                                        <?php esc_html_e('Remove', 'yith-woocommerce-wishlist'); ?>
                                    </a>
                                <?php endif; ?>

                                <?php
                                do_action('yith_wcwl_table_after_product_cart', $item, $wishlist);
                                ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($enable_drag_n_drop) : ?>
                            <div class="product-arrange">
                                <i class="fa fa-arrows"></i>
                                <input type="hidden"
                                       name="items[<?php echo esc_attr($item->get_product_id()); ?>][position]"
                                       value="<?php echo esc_attr($item->get_position()); ?>"/>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            endif;
        endforeach;
    else :
        ?>
        <div class="col-md-12">
            <div class="wishlist-empty"><?php echo esc_html(apply_filters('yith_wcwl_no_product_to_remove_message', __('No products added to the wishlist', 'yith-woocommerce-wishlist'), $wishlist)); ?></div>
        </div>
    <?php
    endif;

    if (!empty($page_links)) :
        ?>
        <div class="col-md-12 wishlist-pagination">
            <?php echo wp_kses_post($page_links); ?>
        </div>
    <?php endif ?>
</div>



