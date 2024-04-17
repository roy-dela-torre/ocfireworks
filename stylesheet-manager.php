<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/global.css">
<?php $css_path = get_stylesheet_directory_uri().'/inc/css/'?>
<?php if(is_front_page()):?>
    <link rel="stylesheet" href="<?php echo $css_path; ?>index.css">
    <link rel="stylesheet" href="<?php echo $css_path; ?>owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $css_path; ?>owl.theme.default.min.css">
<?php elseif(is_page('about-us')):?>
<?php elseif(is_page('contact-us')):?>
<?php endif;?>