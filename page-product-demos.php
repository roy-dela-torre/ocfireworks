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
                    <div class="content"></div>
                    <h3 class="red_text text-center"> 2020 Online Virtual Demo</h3>
                    <img src="<?php echo $img_path; ?>/2020 Online Virtual Demo.jpg" alt="2020 Online Virtual Demo">
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="content"></div>
                    <h3 class="red_text text-center">2019 Public Demo</h3>
                    <img src="<?php echo $img_path; ?>/2019 Public Demo.jpg" alt="2019 Public Demo">
                </div>
                <div class="col-lg-12">
                    <div class="full_width">
                        <div class="content">
                            <h2 class="text-white">Rorem ipsum dolor sit amet consectetur adipiscing </h2>
                            <p class="text-white">Korem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
                            <a href="<?php echo get_home_url(); ?>/shop/" target="_blank" rel="noopener noreferrer" class="shop_now">
                                SHOP NOW
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="17" viewBox="0 0 22 17" fill="none">
                                    <path d="M20.867 4.21919C20.6743 3.97491 20.4286 3.77761 20.1485 3.6422C19.8684 3.50678 19.5611 3.43679 19.25 3.4375H5.31644L4.79462 1.21756C4.75912 1.06665 4.67366 0.932168 4.5521 0.835946C4.43054 0.739724 4.28003 0.687411 4.125 0.6875H1.375C1.19266 0.6875 1.0178 0.759933 0.888864 0.888864C0.759933 1.0178 0.6875 1.19266 0.6875 1.375C0.6875 1.55734 0.759933 1.7322 0.888864 1.86114C1.0178 1.99007 1.19266 2.0625 1.375 2.0625H3.5805L6.01081 12.3929C5.4808 12.4363 4.98819 12.6832 4.63632 13.0819C4.28445 13.4806 4.10066 14.0001 4.12352 14.5314C4.14637 15.0627 4.37409 15.5645 4.75891 15.9315C5.14372 16.2986 5.65573 16.5023 6.1875 16.5H17.875C18.0573 16.5 18.2322 16.4276 18.3611 16.2986C18.4901 16.1697 18.5625 15.9948 18.5625 15.8125C18.5625 15.6302 18.4901 15.4553 18.3611 15.3264C18.2322 15.1974 18.0573 15.125 17.875 15.125H6.1875C6.00516 15.125 5.8303 15.0526 5.70136 14.9236C5.57243 14.7947 5.5 14.6198 5.5 14.4375C5.5 14.2552 5.57243 14.0803 5.70136 13.9514C5.8303 13.8224 6.00516 13.75 6.1875 13.75H17.7939C18.2591 13.7512 18.7109 13.5946 19.0755 13.3057C19.4402 13.0169 19.6961 12.6129 19.8014 12.1598L21.2582 5.97231C21.3301 5.66956 21.3323 5.35441 21.2645 5.05069C21.1967 4.74698 21.0608 4.46265 20.867 4.21919Z" fill="#BF2126"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer();?>