<?php echo get_template_part('video_pop_up'); 
echo get_template_part('wishlist_pop_up');
$home_url = get_home_url(); 
?>
    <footer>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="logo d-flex justify-content-center">
                        <img loading="lazy" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/logo.png" alt="Ocfireworks">
                    </div>
                    <div class="col">
                        <h5>Information</h5>
                        <a href="<?php echo $home_url; ?>/about-us/" target="_blank" rel="noopener noreferrer">About </a>
                        <a href="<?php echo $home_url; ?>/why-buy-from-us/" target="_blank" rel="noopener noreferrer">Why Buy From Us?</a>
                        <a href="<?php echo $home_url; ?>/blogs/" target="_blank" rel="noopener noreferrer">Blogs</a>
                        <a href="<?php echo $home_url; ?>/product-demos/" target="_blank" rel="noopener noreferrer">Product Demos</a>
                        <a href="<?php echo $home_url; ?>/store-hours/" target="_blank" rel="noopener noreferrer">Store Hours</a>
                    </div>
                    <div class="col">
                        <h5>Legal</h5>
                        <a href="<?php echo $home_url; ?>/terms-conditions/" target="_blank" rel="noopener noreferrer">Terms & Conditions</a>
                        <a href="<?php echo $home_url; ?>/copyright-policy/" target="_blank" rel="noopener noreferrer">Copyright Policy</a>
                        <a href="<?php echo $home_url; ?>/privacy-policy/" target="_blank" rel="noopener noreferrer">Privacy Policy</a>
                        <a href="<?php echo $home_url; ?>/disclaimer/" target="_blank" rel="noopener noreferrer">Disclaimer</a>
                        <a href="<?php echo $home_url; ?>/state-firework-laws/" target="_blank" rel="noopener noreferrer">State Firework Laws</a>
                    </div>
                    <div class="col">
                        <h5>Customer Service</h5>
                        <a href="<?php echo $home_url; ?>/contact-us/" target="_blank" rel="noopener noreferrer">Contact Us</a>
                        <a href="<?php echo $home_url; ?>/show-builder/" target="_blank" rel="noopener noreferrer">Show Builder</a>
                        <a href="<?php echo $home_url; ?>/sitemap_index.xml/" target="_blank" rel="noopener noreferrer">Site Map</a>
                        <a href="<?php echo $home_url; ?>/after-you-order/" target="_blank" rel="noopener noreferrer">After You Order</a>
                        <a href="<?php echo $home_url; ?>/curbside-pickup/" target="_blank" rel="noopener noreferrer">Curbside Pickup</a>
                    </div>
                    <div class="col">
                        <h5>Extras</h5>
                        <a href="<?php echo $home_url; ?>/brands/" target="_blank" rel="noopener noreferrer">Brands</a>
                        <a href="<?php echo $home_url; ?>/special-fireworks/" target="_blank" rel="noopener noreferrer">Specials</a>
                        <a href="<?php echo $home_url; ?>/proline-1-4g/" target="_blank" rel="noopener noreferrer">Professional Fireworks</a>
                        <a href="<?php echo $home_url; ?>/firework-clubs/" target="_blank" rel="noopener noreferrer">Firework Clubs</a>
                    </div>
                    <div class="col">
                        <h5>My Account</h5>
                        <div class="my_account">
                            <a href="<?php echo $home_url; ?>/account/" target="_blank" rel="noopener noreferrer">My Account</a>
                            <a href="<?php echo $home_url; ?>/account/orders/" target="_blank" rel="noopener noreferrer">Order History</a>
                            <a href="<?php echo $home_url; ?>/account/news-letter/" target="_blank" rel="noopener noreferrer">Newsletter</a>
                            <a href="<?php echo $home_url; ?>/account/recently-viewed/" target="_blank" rel="noopener noreferrer">Recently viewed</a>
                            <a href="<?php echo $home_url; ?>/account/payment-methods/" target="_blank" rel="noopener noreferrer">Payment methods</a>
                            <a href="<?php echo $home_url; ?>/account/edit-address/" target="_blank" rel="noopener noreferrer">Shipping and Billing Address</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="copy_right">
        <div class="content d-flex align-items-center justify-content-between">
            <p class="text-white text-uppercase mb-0 text-center">Copyright © <?php echo date('Y'); ?> <a href="<?php echo get_home_url(); ?>/sitemap_index.xml/" target="_blank" class="text-white" rel="noopener noreferrer" class="text-white">OC FIreworks</a> | <a href="https://seo-hacker.com/seo-philippines/" target="_blank" class="text-white" rel="noopener noreferrer">SEO</a> by <a href="https://seo-hacker.net/" target="_blank" class="text-white" rel="noopener noreferrer">SEO-Hacker</a>. Optimized and maintained by <a href="https://sean.si/" target="_blank" class="text-white" rel="noopener noreferrer">Sean Si</a></p>
            <div class="payment_method">
                <img loading="lazy" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/visa.png" alt="visa">
                <img loading="lazy" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/discover.png" alt="discover">
                <img loading="lazy" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/mastercard.png" alt="mastercard">
                <img loading="lazy" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/american_express.png" alt="american express">
            </div>
        </div>
    </div>
</body>
<?php include('script-manager.php')?>
<?php wp_footer()?>
</html>