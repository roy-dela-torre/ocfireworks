<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/global.css">
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

<?php endif;?>