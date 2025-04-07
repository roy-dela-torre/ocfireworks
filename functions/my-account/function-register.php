<?php
function custom_process_registration()
{
    if ('POST' !== strtoupper($_SERVER['REQUEST_METHOD'])) {
        return;
    }


    $nonce_value = isset($_POST['woocommerce-register-nonce']) ? $_POST['woocommerce-register-nonce'] : '';
    if (!wp_verify_nonce($nonce_value, 'woocommerce-register')) {

        return;
    }


    $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone = isset($_POST['billing_phone']) ? sanitize_text_field($_POST['billing_phone']) : '';
    $password = isset($_POST['password_1']) ? $_POST['password_1'] : '';
    $password2 = isset($_POST['password_2']) ? $_POST['password_2'] : '';
    $checkbox = isset($_POST['rememberme']) ? sanitize_text_field($_POST['rememberme']) : '';


    echo '<script>console.log("Password 1: ' . $password . '");</script>';
    echo '<script>console.log("Password 2: ' . $password2 . '");</script>';
    echo '<script>console.log("Checkbox: ' . $checkbox . '");</script>';

    if (empty($first_name)) {
        wc_add_notice(__('First name is required.', 'woocommerce'), 'error');
    }

    if (empty($last_name)) {
        wc_add_notice(__('Last name is required.', 'woocommerce'), 'error');
    }

    if (empty($email) || !is_email($email)) {
        wc_add_notice(__('Please provide a valid email address.', 'woocommerce'), 'error');
    }

    if (empty($phone)) {
        wc_add_notice(__('Phone number is required.', 'woocommerce'), 'error');
    }

    if (empty($password)) {
        wc_add_notice(__('Password is required.', 'woocommerce'), 'error');
    }

    if (empty($password2)) {
        wc_add_notice(__('Confirm password is required.', 'woocommerce'), 'error');
    }

    if (!empty($password) && !empty($password2) && $password !== $password2) {
        wc_add_notice(__('Passwords do not match.', 'woocommerce'), 'error');
    }

    if (empty($checkbox)) {
        wc_add_notice(__('You must agree to the terms and conditions.', 'woocommerce'), 'error');
    }

    if (wc_notice_count('error') > 0) {
        return;
    }


    $user_data = array(
        'user_login' => $email,
        'user_email' => $email,
        'user_pass' => $password,
        'first_name' => $first_name,
        'last_name' => $last_name,
    );

    $user_id = wp_insert_user($user_data);

    if (is_wp_error($user_id)) {
        wc_add_notice($user_id->get_error_message(), 'error');
    } else {

        if (!empty($phone)) {
            update_user_meta($user_id, 'billing_phone', $phone);
        }


        wc_set_customer_auth_cookie($user_id);


        $redirect = wc_get_page_permalink('myaccount');
        wp_redirect($redirect);
        exit;
    }
}
add_action('template_redirect', 'custom_process_registration');





function save_extra_user_fields($user_id)
{
    if (isset($_POST['first_name'])) {
        update_user_meta($user_id, 'first_name', sanitize_text_field($_POST['first_name']));
    }
    if (isset($_POST['last_name'])) {
        update_user_meta($user_id, 'last_name', sanitize_text_field($_POST['last_name']));
    }
    if (isset($_POST['billing_phone'])) {
        update_user_meta($user_id, 'billing_phone', sanitize_text_field($_POST['billing_phone']));
    }
}
add_action('user_register', 'save_extra_user_fields');





function custom_login_form_shortcode()
{
    if (is_user_logged_in()) {

        return 'You are already logged in.';
    } else {

        ob_start();
        do_action('woocommerce_before_customer_login_form');
    ?>

        <form class="woocommerce-form woocommerce-form-login login" method="post">

            <?php do_action('woocommerce_login_form_start'); ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <!-- <label for="username"><?php esc_html_e('Username or email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label> -->
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo (! empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" placeholder="Email Address" /><?php
                                                                                                                                                                                                                                                                                            ?>
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <!-- <label for="password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label> -->
                <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="Password" />
            </p>

            <?php do_action('woocommerce_login_form'); ?>

            <p class="form-row">
                <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                <button type="submit" class="black_button woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
            </p>
            <div class="group">
                <p class="login-remember mb-0">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme d-flex align-items-center">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" placeholder="Password" /> <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
                    </label>
                </p>
                <p class="woocommerce-LostPassword lost_password">
                    <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
                </p>
            </div>
            <p class="text-white text-center">Don’t Have an Account? <strong><a href="<?php echo get_home_url(); ?>/register/" target="_blank" rel="noopener noreferrer">Sign Up</a></strong></p>
            <?php do_action('woocommerce_login_form_end'); ?>
        </form>
    <?php
        do_action('woocommerce_after_customer_login_form');

        return ob_get_clean();
    }
}
add_shortcode('custom_login_form', 'custom_login_form_shortcode');