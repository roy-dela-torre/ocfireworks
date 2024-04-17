
<?php
if ( ! function_exists( 'ocfireworks' ) ) :
    function ocfireworks() {
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'post-formats',  array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );
        register_nav_menus( array(
            'primary'   => __( 'Primary Menu', 'ocfireworksNavMenu' )
        ) );
        add_theme_support( 'woocommerce' );
        add_theme_support( 'wc-product-gallery-zoom' ); 
        add_theme_support( 'wc-product-gallery-lightbox' ); 
        add_theme_support( 'wc-product-gallery-slider' );
    }
    endif; 
    add_action( 'after_setup_theme', 'ocfireworks' );
    function get_excerpt($limit, $source = null){
        $excerpt = $source == "content" ? get_the_content() : get_the_excerpt();
        $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
        $excerpt = strip_shortcodes($excerpt);
        $excerpt = strip_tags($excerpt);
        $excerpt = substr($excerpt, 0, $limit);
        $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
        $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
        return $excerpt;
    }

    function custom_login_form_shortcode() {
        if (is_user_logged_in()) {
            // If the user is already logged in, display a message or redirect as needed
            return 'You are already logged in.';
        } else {
            // If the user is not logged in, display the custom login form with placeholders and "Remember Me" checkbox
            ob_start();
            ?>
            <form method="post" class="custom-login-form" action="<?php echo esc_url(site_url('wp-login.php', 'login_post')); ?>">
                <p>
                    <label for="user_login">Username:</label>
                    <input type="text" name="log" id="user_login" placeholder="Email" required />
                </p>
                <p>
                    <label for="user_pass">Password:</label>
                    <input type="password" name="pwd" id="user_pass" placeholder="Password" required />
                </p>
                <p class="login-remember">
                    <label>
                        <input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me
                    </label>
                </p>
                <p>
                    <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Log In" />
                </p>
            </form>
            <?php
            return ob_get_clean();
        }
     }
     add_shortcode('custom_login_form', 'custom_login_form_shortcode');
     
     
     add_filter( 'yith_wcwl_is_wishlist_responsive', '__return_false' );