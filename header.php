<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php the_title();?></title>
    <?php include('stylesheet-manager.php')?>
    <?php wp_head()?>
</head>
<body <?php body_class(); ?>>
<?php $img = get_stylesheet_directory_uri().'/assets/img/global'; 
$home = get_home_url();
?>
<header>
    <div class="top_nav">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <div class="contact d-flex align-items-center">
                        <img src="<?php echo $img; ?>/phone.png" alt="">
                        <span>Contact Us: <a href="tel:+574-742-8164">574-742-8164</a></span>
                    </div>
                    <div class="promocode">
                        <span>Promo Code Sign Up</span>
                    </div>
                    <div class="connect_with_us d-flex align-items-center">
                        <span>Connect with Us:</span>
                        <div class="socmed">
                            <a href="http://" target="_blank" rel="noopener noreferrer">
                                <img src="<?php echo $img; ?>/facebook.png" alt="">
                            </a>
                            <a href="http://" target="_blank" rel="noopener noreferrer">
                                <img src="<?php echo $img; ?>/instagram.png" alt="">
                            </a>
                            <a href="http://" target="_blank" rel="noopener noreferrer">
                                <img src="<?php echo $img; ?>/twitter.png" alt="">
                            </a>
                            <a href="http://" target="_blank" rel="noopener noreferrer">
                                <img src="<?php echo $img; ?>/youtube.png" alt="">
                            </a>
                            <a href="http://" target="_blank" rel="noopener noreferrer">
                                <img src="<?php echo $img; ?>/pinterest.png" alt="">
                            </a>
                            <a href="http://" target="_blank" rel="noopener noreferrer">
                                <img src="<?php echo $img; ?>/linkedn.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="middle_nav">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <div class="col-xxl-2 d-none d-xxl-block">
                        <div class="logo">
                            <a href="<?php echo $home; ?>"  rel="noopener noreferrer">
                                <img src="<?php echo $img; ?>/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xxl-10 col-xl-12 p-xxl-0">
                        <div class="left_menu d-flex">
                            <div class="d-flex d-lg-none col">
                                <button class="search_button">
                                    <img src="<?php echo $img; ?>/search.png" alt="">
                                </button>
                            </div>
                            <div class="search d-none d-lg-block">
                                <form role="search" method="get" class="mb-0" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <div class="search_field d-flex align-items-center">
                                        <input type="search" placeholder="Search..." class="w-100" value="<?php echo get_search_query(); ?>" name="s" id="s">
                                        <img src="<?php echo $img; ?>/search.png" alt="" class="d-none d-lg-block">
                                    </div>
                                </form>
                            </div>
                            <div class="group_icon_button d-flex align-items-center">
                                <a href="<?php echo $home; ?>/wishlist/" target="_blank" rel="noopener noreferrer">
                                    <img src="<?php echo $img; ?>/wishlist.png" alt="">
                                </a>
                                <a href="<?php echo $home; ?>/cart/" target="_blank" rel="noopener noreferrer">
                                    <img src="<?php echo $img; ?>/cart.png" alt="">
                                </a>
                                <div class="account d-flex">
                                    <a href="<?php echo $home; ?>/my-account/" target="_blank" rel="noopener noreferrer">
                                        <img src="<?php echo $img; ?>/user.png" alt="">
                                    </a>
                                    <?php if (is_user_logged_in()): ?>
                                        <a href="<?php echo wp_logout_url(); ?>" target="_blank" rel="noopener noreferrer">
                                            LOGOUT
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo $home;?>/login/" target="_blank" rel="noopener noreferrer">
                                            LOGIN
                                        </a>
                                    <?php endif; ?>
                                    <span>|</span>
                                    <a href="<?php echo $home;?>/register/" target="_blank" rel="noopener noreferrer">
                                            SIGNUP
                                    </a>
                                </div>
                                <div class="shipping d-flex align-items-center mw-md-100">
                                    <img src="<?php echo $img; ?>/shipping.png" alt="">
                                    <span>free shipping for orders over $499.99</span>
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
                <a class="navbar-brand d-block d-xxl-none" href="<?php echo $home;?>">
                    <img src="<?php echo $img; ?>/logo.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <?php wp_nav_menu(array('Primary Menu' => 'Primary','menu_class' => 'navMenu navbar-nav me-auto mb-2 mb-lg-0','container' => false,));?>
                    <div class="group_top_nav d-flex d-sm-none justify-content-between">
                        <div class="contact d-flex align-items-center">
                            <img src="<?php echo $img; ?>/phone.png" alt="">
                            <span>Contact Us: <a href="tel:+574-742-8164">574-742-8164</a></span>
                        </div>
                        <div class="promocode">
                            <span>Promo Code Sign Up</span>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
