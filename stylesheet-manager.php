<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/global.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/product_template.css">
<?php $css_path = get_stylesheet_directory_uri().'/inc/css/'?>
<?php if(is_front_page()):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>index.css">
    <link rel="stylesheet" href="<?php echo $css_path; ?>owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $css_path; ?>owl.theme.default.min.css">

<?php elseif(is_404()):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>404.css">

<?php elseif(is_page('thank-you')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>thank-you.css">

<?php elseif(is_page('blogs')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>blogs.css">

<?php elseif(is_page('terms-conditions')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>term_and_condition.css">
<?php elseif(is_cart()):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>cart.css">

<?php elseif(is_page('contact-us')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>contact-us.css">

<?php elseif(is_page('show-builder')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>show_builder.css">

<?php elseif(is_page('login') || is_page(103) || is_page('forgot-password') || is_page(216)):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>login.css">

<?php elseif(is_page('forgot-password') || is_page(11)):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>login.css">
    
<?php elseif(is_page('register') || is_page(105)):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>register.css">

<?php elseif(is_page('events')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>events.css">

<?php elseif(is_page('about-us')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>about_us.css">
    <link rel="stylesheet" href="<?php echo $css_path; ?>owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $css_path; ?>owl.theme.default.min.css">

<?php elseif(is_page('shipping-info')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>shipping_info.css">

<?php elseif(is_page('after-you-order')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>after_you_order.css">

<?php elseif(is_page('curbside-pickup')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>curbsided_pickup.css">

<?php elseif(is_page('brands')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>brands.css">

<?php elseif(is_page('product-demos')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>product_demos.css">

<?php elseif(is_page('')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>.css">

<?php elseif(is_page('')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>.css">

<?php elseif(is_page('')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>.css">

<?php elseif(is_page('')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>.css">

<?php elseif(is_page('')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>.css">

<?php elseif(is_page('')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>.css">

<?php elseif(is_page('')):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>.css">
<?php endif;?>