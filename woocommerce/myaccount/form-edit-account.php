<?php

/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_edit_account_form'); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action('woocommerce_edit_account_form_tag'); ?>>

    <?php do_action('woocommerce_edit_account_form_start'); ?>
    <h3>My Details</h3>
    <div class="personal_details">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <p class="w-100 woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr($user->first_name); ?>" placeholder="First Name" />
                </p>
            </div>
            <div class="col-md-6 col-sm-12">
                <p class="w-100 woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr($user->last_name); ?>" placeholder="Last Name" />
                </p>
            </div>
            <div class="col-md-6 col-sm-12">
                <p class="w-100 woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" value="<?php echo esc_attr(get_userdata(get_current_user_id())->user_email); ?>" placeholder="Email" />
                </p>
            </div>
            <div class="col-md-6 col-sm-12">
                <p class="w-100 woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="billing_phone" id="billing_phone" value="<?php echo esc_attr(get_user_meta(get_current_user_id(), 'billing_phone', true)); ?>" placeholder="Phone Number" />
                </p>
            </div>
            <div class="col-md-12">
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="account_display_name"><?php esc_html_e('Display name', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr($user->display_name); ?>" /> <span><em><?php esc_html_e('This will be how your name will be displayed in the account section and in reviews', 'woocommerce'); ?></em></span>
                </p>
            </div>
            <div class="col-md-12">
                <a href="<?php echo esc_url(get_home_url() . '/account/edit-address/billing/'); ?>" rel="noopener noreferrer" class="w-100 text-center edit_button red_button text-uppercase d-block" id="edit_details">EDIT DETAILS</a>
            </div>
        </div>
    </div>

    <h3>My Password</h3>
    <div class="password">
        <div class="row">
            <div class="col-md-12">
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" placeholder="Current Password" />
                </p>
            </div>
            <div class="col-md-12">
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" placeholder="New Password" />
                </p>
            </div>
            <div class="col-md-12">
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" placeholder="Confirm Password" />
                </p>
            </div>
        </div>
    </div>

    <?php do_action('woocommerce_edit_account_form'); ?>

    <p>
        <?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
        <button type="submit" class="woocommerce-Button red_button save_changes button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="save_account_details" value="<?php esc_attr_e('Save changes', 'woocommerce'); ?>"><?php esc_html_e('Save Password', 'woocommerce'); ?></button>
        <input type="hidden" name="action" value="save_account_details" />
    </p>

    <?php do_action('woocommerce_edit_account_form_end'); ?>
</form>

<?php do_action('woocommerce_after_edit_account_form'); ?>