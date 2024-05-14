<?php get_header(); 
/*Template Name: Forgot Password*/
?>
<section class="login">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="login_form">
                        <h1 class="text-white">Reset Password</h1>
                        <?php wc_get_template('myaccount/form-lost-password.php'); ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="image">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/forgot_password_image.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>