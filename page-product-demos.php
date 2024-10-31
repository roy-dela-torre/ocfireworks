<?php get_header();
/*Template Name: Product Demos*/
$img_path = get_stylesheet_directory_uri().'/assets/img/product_demos';
?>
<section class="product_demos">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <h1 class="text-center red_text">Product Demos</h1>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="content2020">
                        <h2 class="red_text text-center"> 2020 Online Virtual Demo</h2>
                        <img src="<?php echo $img_path; ?>/2020 Online Virtual Demo.jpg" alt="2020 Online Virtual Demo" class="w-100">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="content2019">
                        <h2 class="red_text text-center">2019 Public Demo</h2>
                        <img src="<?php echo $img_path; ?>/2019 Public Demo.jpg" alt="2019 Public Demo" class="w-100">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="full_width">
                        <div class="content">
                            <h2 class="text-white">Witness the Spectacle. Order Now.</h2>
                            <p class="text-white">Witness the magic of OC Fireworks come alive in our product demos. See the dazzling effects, vibrant colors, and breathtaking displays for yourself. Order yours today and transform any event into a celebration of unforgettable brilliance.</p>
                            <a href="<?php echo get_home_url(); ?>/wholesale-fireworks/" target="_blank" rel="noopener noreferrer" class="shop_now">Shop wholesale<?php echo file_get_contents($img_path.'/cart.svg'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer();?>