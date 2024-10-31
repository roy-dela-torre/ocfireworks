<link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/bootstrap/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/bootstrap/bootstrap.min.css">
</noscript>

<link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/global_desktop.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/global_desktop.css">
</noscript>

<link rel="preload" media="screen and (max-width: 991px)" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/global_mobile.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" media="screen and (max-width: 991px)" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/global_mobile.css">
</noscript>


<link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/product_template.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/product_template.css">
</noscript>

<?php $css_path = get_stylesheet_directory_uri() . '/inc/css/' ?>
<?php if (is_front_page()) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>index.css">
    <link rel="stylesheet" href="<?php echo $css_path; ?>owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $css_path; ?>owl.theme.default.min.css">

<?php elseif (is_404()) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>404.css">

<?php elseif (is_page('thank-you')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>thank-you.css">

<?php elseif (is_page('blogs')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>blogs.css">

<?php elseif (is_page('terms-conditions')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>term_and_condition.css">

<?php elseif (is_page('Privacy Policy') || is_page(3)) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>privacy_policy.css">
<?php elseif (is_cart()) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>cart.css">

<?php elseif (is_page('contact-us')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>contact-us.css">

<?php elseif (is_page('show-builder')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>show_builder.css">

<?php elseif (is_page('login') || is_page(103)) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>login.css">

<?php elseif (is_page('forgot-password') || is_page(216)) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>forgot_password.css">

<?php elseif (is_page('register') || is_page(105) || is_page('register-discount')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>register.css">

<?php elseif (is_page('events')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>events.css">

<?php elseif (is_page('about-us')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>about_us.css">
    <link rel="stylesheet" href="<?php echo $css_path; ?>owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $css_path; ?>owl.theme.default.min.css">

<?php elseif (is_page('shipping-info')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>shipping_info.css">

<?php elseif (is_page('after-you-order')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>after_you_order.css">

<?php elseif (is_page('curbside-pickup')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>curbsided_pickup.css">

<?php elseif (is_page('brands')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>brands.css">

<?php elseif (is_page('product-demos')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>product_demos.css">

<?php elseif (is_page('sign-up-to-save') || is_page(250)) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>sign-up-to-save.css">

<?php elseif (is_page('professional-fireworks') || is_page(254)) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>professional-fireworks.css">

<?php elseif (is_order_received_page()) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>is_order_received_page.css">

<?php elseif (is_page('events') || is_page(62) || is_category()) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>events.css">
    <link rel="stylesheet" href="<?php echo $css_path; ?>category.css">
<?php elseif (is_page('Fireworks Supply Store') || is_page(72)) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>supply.css">

<?php elseif (is_page('Special Deals & Prices for Firework')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>special_deals.css">

<?php elseif (is_page('Novelty Fireworks for Sale') || is_page(306)) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>novelty.css">

<?php elseif (is_page('Fireworks Supply Store')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>firewors-supply-status.css">

<?php elseif (is_page('Sky Show')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>sky-show.css">

<?php elseif (is_page('Ground Effects')) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>ground_effect.css">

<?php elseif (is_checkout()) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>checkout.css">

<?php elseif (is_page('Store Hours') || is_page(806)) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>store-hours.css">

<?php elseif (is_page('State Firework Laws') || is_page(818)) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>state-fireworks-law.css">

<?php elseif (is_page('Fireworks Club') || is_page(916)) : ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>fireworks-club.css">

<?php elseif(is_page('Why Buy From Us') || is_page(952)):
    ?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>why-buy-from-us.css">

<?//php elseif(is_page('')):?>
    <!-- <link rel="stylesheet" href="<?//php echo $css_path; ?>.css"> -->

<?//php elseif(is_page('')):?>
    <!-- <link rel="stylesheet" href="<?//php echo $css_path; ?>.css"> -->

<?//php elseif(is_page('')):?>
    <!-- <link rel="stylesheet" href="<?//php echo $css_path; ?>.css"> -->

<?//php elseif(is_page('')):?>
    <!-- <link rel="stylesheet" href="<?//php echo $css_path; ?>.css"> -->

<?//php elseif(is_page('')):?>
    <!-- <link rel="stylesheet" href="<?//php echo $css_path; ?>.css"> -->

<?//php elseif(is_page('')):?>
    <!-- <link rel="stylesheet" href="<?//php echo $css_path; ?>.css"> -->

<?//php elseif(is_page('')):?>
    <!-- <link rel="stylesheet" href="<?//php echo $css_path; ?>.css"> -->

<?//php elseif(is_page('')):?>
    <!-- <link rel="stylesheet" href="<?//php echo $css_path; ?>.css"> -->

<?//php elseif(is_page('')):?>
    <!-- <link rel="stylesheet" href="<?//php echo $css_path; ?>.css"> -->

<?//php elseif(is_page('')):?>
    <!-- <link rel="stylesheet" href="<?//php echo $css_path; ?>.css"> -->

<?//php elseif(is_page('')):?>
    <!-- <link rel="stylesheet" href="<?//php echo $css_path; ?>.css"> -->

<?//php elseif(is_page('')):?>
    <!-- <link rel="stylesheet" href="<?//php echo $css_path; ?>.css"> -->
<?php endif; ?>