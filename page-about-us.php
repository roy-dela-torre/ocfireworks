<?php get_header();
/*Template Name: About Us*/
$img = get_stylesheet_directory_uri().'/assets/img/about_us';
$img_home = get_stylesheet_directory_uri() . '/assets/img/homepage';
?>
<section class="banner">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="content">
                        <h1 class="text-white">Beyond fireworks, we craft celebrations!</h1>
                        <img loading="lazy" src="<?php echo $img?>/banner_image.png" alt="Beyond fireworks, we craft celebrations" class="w-100 d-block d-lg-none">
                        <p class="text-white">OC Fireworks goes beyond fireworks, crafting dazzling displays that paint the night with wonder. From backyard "oohs" to grand finale "aahs," we light up lives. Dive deeper and discover why we're passionate about igniting unforgettable celebrations!</p>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="image">
                        <img loading="lazy" src="<?php echo $img?>/banner_image.png" alt="Beyond fireworks, we craft celebrations" class="w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="left_image_right_content">
    <div class="wrapper">
        <div class="containeer-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6  d-none d-lg-block">
                    <div class="image">
                        <img src="<?php echo $img; ?>/left_image.jpg" alt="Your Neighborhood Experts for a Dazzling Display.">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 ps-lg-5">
                    <div class="content">
                        <h2>Your Neighborhood Experts for a Dazzling Display.</h2>
                        <img src="<?php echo $img; ?>/left_image.jpg" alt="Your Neighborhood Experts for a Dazzling Display." class="w-100 d-block d-lg-none">
                        <p>Our retail store and warehouse has offered retail and wholesale fireworks for over 35 years to the South Bend, Mishawaka, and Elkhart, Indiana area. From 500 gram cakes to sparklers, our extensive, ever-growing catalog of fireworks caters to all of your needs.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="brands px-0">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h2 class="text-center">The One-Stop Shop For Affordable Fireworks</h2>
            <p class="text-center">We carry the hottest and most recognized brands at the lowest prices possible.</p>
            <div class="owl-carousel owl-theme p-0" id="brands">
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <img src="<?php echo $img_home; ?>/logo<?php echo $i; ?>.png" alt="logo<?php echo $i; ?>" width="186" height="186">
                <?php } ?>
            </div>
            <a href="<?php echo get_home_url(); ?>/brands/" target="_blank" rel="noopener noreferrer" class="view_all red_button">View All</a>
        </div>
    </div>
</section>

<section class="left_image_right_content">
    <div class="wrapper">
        <div class="containeer-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="content">
                        <h2>More Than Fireworks, It's a Family Passion </h2>
                        <img src="<?php echo $img; ?>/left_image.jpg" alt="More Than Fireworks, It's a Family Passion" class="w-100 d-block d-lg-none">
                        <p>Our retail store and warehouse has offered retail and wholesale fireworks for over 35 years to the South Bend, Mishawaka, and Elkhart, Indiana area. From 500 gram cakes to sparklers, our extensive, ever-growing catalog of fireworks caters to all of your needs.</p>
                    </div>
                </div>
                <div class="col-lg-6  d-none d-lg-block ps-lg-5">
                    <div class="image">
                        <img src="<?php echo $img; ?>/left_image.jpg" alt="More Than Fireworks, It's a Family Passion">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="map">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="content_map">
                    <div class="header">
                        <h2 class="text-center">OC Fireworks: Find Us Here </h2>
                        <p class="text-center">OCFireworks.com is conveniently located at 13421 McKinley Hwy Mishawaka, Indiana. 5 minutes from the Indiana east/west toll road exit #83 and 1/4 mile west of the A.M. General Hummer H1 & H2 assembly plant.</p>
                    </div>
                    <div class="maps">
                        <img src="<?php echo $img; ?>/map.jpg" alt="OC Fireworks: Find Us Here">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php get_footer();?>