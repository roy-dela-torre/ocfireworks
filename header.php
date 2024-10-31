<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta name="google-site-verification" content="uoVUFD_osDNOnE_y3kkfMsHP4EFWD1wXbIilGyizDPo" /> -->
    <title><?php wp_title(); ?></title>
    <?php include('stylesheet-manager.php') ?>
    <?php wp_head(); ?>
    <!-- Google tag (gtag.js) -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-1XD9KCVMXG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-1XD9KCVMXG');
    </script> -->
    <!-- Google tag (gtag.js) end -->
</head>

<body <?php body_class(); ?>>
    <?php $img = get_stylesheet_directory_uri() . '/assets/img/global';
    $home = get_home_url();
    ?>
    <header>
        <div class="top_nav">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row justify-content-between">
                        <div class="contact d-flex align-items-center">
                            <?php
                            echo file_get_contents($img . '/contact.svg');
                            ?>
                            <span>Contact Us: <a href="tel:+574-742-8164">574-742-8164</a></span>
                        </div>
                        <div class="promocode">
                            <span><a href="<?php echo get_home_url(); ?>/sign-up-to-save/" target="_blank" rel="noopener noreferrer">Get Up to 5% percent discount sign up here</a></span>
                        </div>
                        <div class="connect_with_us d-flex align-items-center">
                            <span>Connect with Us:</span>
                            <div class="socmed">
                                <a href="https://www.facebook.com/ocfireworksdotcom/" target="_blank" rel="noopener noreferrer">
                                    <?php
                                    echo file_get_contents($img . '/facebook.svg');
                                    ?>
                                </a>
                                <a href="https://www.instagram.com/ocfireworks/" target="_blank" rel="noopener noreferrer">
                                    <?php
                                    echo file_get_contents($img . '/instagram.svg');
                                    ?>
                                </a>
                                <a href="https://x.com/ocfireworks" target="_blank" rel="noopener noreferrer">
                                    <?php
                                    echo file_get_contents($img . '/twitter.svg');
                                    ?>
                                </a>
                                <a href="https://www.youtube.com/channel/UC1rvJpD3HrPRNNedJxNMjMQ" target="_blank" rel="noopener noreferrer">
                                    <?php
                                    echo file_get_contents($img . '/youtube.svg');
                                    ?>
                                </a>
                                <a href="https://www.pinterest.com/buyfireworksonline/" target="_blank" rel="noopener noreferrer">
                                    <?php
                                    echo file_get_contents($img . '/pinterest.svg');
                                    ?>
                                </a>
                                <a href="https://www.linkedin.com/company/overstock-central-fireworks" target="_blank" rel="noopener noreferrer">
                                    <?php
                                    echo file_get_contents($img . '/linkedn.svg');
                                    ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky-header">
            <div class="middle_nav">
                <div class="wrapper">
                    <div class="container-fluid">
                        <div class="row justify-content-between">
                            <div class="col-xxl-2 d-none d-xxl-block">
                                <div class="logo">
                                    <a href="<?php echo $home; ?>" rel="noopener noreferrer">
                                        <img src="<?php echo $img; ?>/logo.png" alt="Ocfireworks">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xxl-10 col-xl-12 p-xxl-0">
                                <div class="left_menu d-flex">
                                    <div class="d-flex d-lg-none col">
                                        <button class="search_button">
                                            <img src="<?php echo $img; ?>/search.png" alt="Search">
                                        </button>
                                    </div>
                                    <div class="search d-none d-lg-block">
                                        <form role="search" method="get" class="mb-0" role="search" action="<?php echo esc_url(home_url('/')); ?>">
                                            <div class="search_field d-flex align-items-center">
                                                <input type="search" placeholder="Search..." class="w-100" value="<?php echo get_search_query(); ?>" name="s" id="s">
                                                <?php
                                                echo file_get_contents($img . '/search.svg');
                                                ?>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="group_icon_button d-flex align-items-center">
                                        <a href="<?php echo $home; ?>/wishlist/" target="_blank" rel="noopener noreferrer">
                                            <?php
                                            echo file_get_contents($img . '/wishlist.svg');
                                            ?>
                                        </a>
                                        <div class="cart_button">
                                            <a class="cart">
                                                <span class="cart_count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                                <?php
                                                echo file_get_contents($img . '/cart.svg');
                                                ?>
                                            </a>
                                            <div class="mini_cart_main_container" style="display: none;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="82" height="39" viewBox="0 0 82 39" fill="none">
                                                    <path d="M41 0L81.7032 39H0.296806L41 0Z" fill="white" />
                                                </svg>
                                                <div class="mini_cart d-block position-relative">
                                                    <?php echo woocommerce_mini_cart(); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="account d-flex">
                                            <a href="<?php echo is_user_logged_in() ? get_home_url() . '/account/' : get_home_url() . '/login/' ?>" rel="noopener noreferrer">
                                                <?php
                                                echo file_get_contents($img . '/profile.svg');
                                                ?>
                                            </a>

                                            <?php if (is_user_logged_in()) : ?>
                                                <a href="<?php echo wp_logout_url(get_home_url()); ?>" rel="noopener noreferrer">LOGOUT</a>
                                            <?php else : ?>
                                                <a href="<?php echo $home; ?>/login/" rel="noopener noreferrer">LOGIN</a>
                                            <?php endif; ?>
                                            <span>|</span>
                                            <a href="<?php echo $home; ?>/sign-up/" target="_blank" rel="noopener noreferrer">SIGN UP</a>
                                        </div>
                                        <div class="shipping d-flex align-items-center mw-md-100 position-relative">
                                            <div class="shipping_car" style="width: 38px; height: 38px">
                                                <?php
                                                echo file_get_contents($img . '/shipping.svg');
                                                ?>
                                            </div>
                                            <a href="<?php echo $home; ?>/shipping-info/" target="_blank" rel="noopener noreferrer" class="">free shipping for orders over $499.99</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main_nav">
                <nav class="navbar navbar-expand-xxl p-0">
                    <div class="container-fluid">
                        <a class="navbar-brand d-block d-xxl-none" href="<?php echo $home; ?>">
                            <img src="<?php echo $img; ?>/logo.png" alt="Ocfireworks">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',   // This should match the location registered in functions.php
                                'menu_class'     => 'navMenu navbar-nav me-auto mb-2 mb-lg-0',
                                'container'      => false,
                            ));
                            ?>

                            <div class="group_top_nav d-flex d-lg-none justify-content-between">
                                <div class="contact d-flex align-items-center">
                                    <img src="<?php echo $img; ?>/phone.png" alt="Phone">
                                    <span>Contact Us: <a href="tel:+574-742-8164">574-742-8164</a></span>
                                </div>
                                <div class="promocode">
                                    <span><a href="<?php get_home_url(); ?>/register-discount/" target="_blank" rel="noopener noreferrer">Get Up to 5% percent discount sign up here</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>