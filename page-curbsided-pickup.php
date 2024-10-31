<?php get_header(); 
/*Template Name: Curbsided Pickup*/
$img_path = get_stylesheet_directory_uri().'/assets/img/curbsided_pickup';
?>
<section class="banner">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="content mw-lg-100">
                        <h1 class="text-white">Curbside Pickup</h1>
                        <img loading="lazy" src="<?php echo $img_path?>/banner_image.jpg" alt="Curbside Pickup" class="w-100 d-block d-lg-none mb-3">
                        <p class="text-white mb-0">Effortless Sparkle: Curbside Pickup Skip the lines and celebrate with ease!  Order your spectacular OC Fireworks display online and pick it up conveniently curbside. It's the perfect way to enjoy a dazzling fireworks show without the hassle.</p>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block ps-lg-5">
                    <div class="video">
                        <img loading="lazy" src="<?php echo $img_path?>/banner_image.jpg" alt="Curbside Pickup" class="w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content_image">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="image">
                        <img src="<?php echo $img_path; ?>/Don't like crowds Want to skip the line.jpg" alt="Don't like crowds Want to skip the line" >
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 ps-lg-4">
                    <div class="content">
                        <h2>Don't like crowds? Want to skip the line?</h2>
                        <img src="<?php echo $img_path; ?>/Don't like crowds Want to skip the line.jpg" alt="Don't like crowds Want to skip the line" class="d-block d-lg-none w-100">
                        <p>Then our curbside pickup is just for you. It is simple and easy. Just add the products to your cart and during checkout select curbside pickup. Once your order has processed, we will pack it and contact you when it is ready to be picked up.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="content">
                        <h2>When you arrive:</h2>
                        <img src="<?php echo $img_path; ?>/maps.jpg" alt="When you arrive:" class="d-block d-lg-none w-100 maps">
                        <ul>
                           <li> Please check-in upfront</li>
                           <li> You will need your ID and the credit card used to pay for the order</li>
                           <li> Your order will be brought out to you</li>
                           <li> It is your responsibility to go over the order with the employee</li>
                        </ul>
                        <p><strong>Address:</strong></p>
                        <p class="location"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                            <path d="M15.5 14.25C14.5054 14.25 13.5516 13.8549 12.8483 13.1517C12.1451 12.4484 11.75 11.4946 11.75 10.5C11.75 9.50544 12.1451 8.55161 12.8483 7.84835C13.5516 7.14509 14.5054 6.75 15.5 6.75C16.4946 6.75 17.4484 7.14509 18.1517 7.84835C18.8549 8.55161 19.25 9.50544 19.25 10.5C19.25 10.9925 19.153 11.4801 18.9645 11.9351C18.7761 12.39 18.4999 12.8034 18.1517 13.1517C17.8034 13.4999 17.39 13.7761 16.9351 13.9645C16.4801 14.153 15.9925 14.25 15.5 14.25ZM15.5 0C12.7152 0 10.0445 1.10625 8.07538 3.07538C6.10625 5.04451 5 7.71523 5 10.5C5 18.375 15.5 30 15.5 30C15.5 30 26 18.375 26 10.5C26 7.71523 24.8938 5.04451 22.9246 3.07538C20.9555 1.10625 18.2848 0 15.5 0Z" fill="#BF2126"/>
                            </svg><a href="https://maps.app.goo.gl/THgFEvTPhSx5ekk87" target="_blank" rel="noopener noreferrer">13421 Mckinley Hwy Mishawaka, IN 46545</a></p>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block ps-lg-4">
                    <div class="maps">
                        <img src="<?php echo $img_path; ?>/maps.jpg" alt="When you arrive:" >
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer();?>
