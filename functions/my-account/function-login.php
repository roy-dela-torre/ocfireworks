<?php
function registration_form()
{
    ob_start();
?>
    <form method="post" class="woocommerce-form woocommerce-form-register register">
        <?php do_action('woocommerce_before_customer_login_form'); ?>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="first_name" id="reg_first_name" placeholder="First Name" value="<?php if (!empty($_POST['first_name'])) echo esc_attr($_POST['first_name']); ?>" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="last_name" id="reg_last_name" placeholder="Last Name" value="<?php if (!empty($_POST['last_name'])) echo esc_attr($_POST['last_name']); ?>" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" placeholder="Email Address" autocomplete="email" value="<?php if (!empty($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="number" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_phone" id="billing_phone" placeholder="Phone Number" value="<?php if (!empty($_POST['billing_phone'])) echo esc_attr($_POST['billing_phone']); ?>" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_1" id="password_1" autocomplete="off" placeholder="Password" />
            <span class="show-password-input"></span>
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_2" id="password_2" autocomplete="off" placeholder="Confirm Password" />
            <span class="show-password-input"></span>
        </p>
        <div class="group">
            <p class="register-remember w-100">
                <label>
                    <input name="rememberme" type="checkbox" id="rememberme" value="forever" class="" />
                    <span>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="<?php echo get_home_url(); ?>/privacy-policy/" target="_blank" rel="noopener noreferrer">Privacy Policy</a></span>
                </label>
            </p>
        </div>
        <p class="woocommerce-form-row form-row">
            <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
            <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="Register"><?php echo is_page('sign-up') ? "Create Account" : "Submit" ?></button>
        </p>
        <?php do_action('woocommerce_after_customer_login_form'); ?>
    </form>

<?php
    return ob_get_clean();
}

add_shortcode('registration_form', 'registration_form');
