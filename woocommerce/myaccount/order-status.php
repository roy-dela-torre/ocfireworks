<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$current_user = wp_get_current_user();
$customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
    'numberposts' => -1,
    'meta_key'    => '_customer_user',
    'meta_value'  => get_current_user_id(),
    'post_type'   => wc_get_order_types( 'view-orders' ),
    'post_status' => array_keys( wc_get_order_statuses() ),
) ) );

if ( $customer_orders ) : ?>

    <h2><?php esc_html_e( 'Order Status', 'textdomain' ); ?></h2>
    
    <div class="order-status-list">
        <?php foreach ( $customer_orders as $customer_order ) :
            $order      = wc_get_order( $customer_order );
            $order_id   = $order->get_id();
            $order_date = wc_format_datetime( $order->get_date_created() );
            $status     = wc_get_order_status_name( $order->get_status() );
            $total      = $order->get_formatted_order_total();
            $item_count = $order->get_item_count();
            $order_url  = $order->get_view_order_url();
            ?>
            <div class="order-status-item">
                <div class="order-details">
                    <div class="order-id"><?php echo $order->get_order_number(); ?></div>
                    <div class="order-date"><?php echo $order_date; ?></div>
                    <div class="order-status"><?php echo $status; ?></div>
                    <div class="order-total"><?php echo $total; ?></div>
                    <div class="order-item-count"><?php echo $item_count; ?></div>
                </div>
                <div class="order-view">
                    <a href="<?php echo esc_url( $order_url ); ?>"><?php esc_html_e( 'View Order', 'textdomain' ); ?></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php else : ?>
    <p><?php esc_html_e( 'No orders found.', 'textdomain' ); ?></p>
<?php endif; ?>
