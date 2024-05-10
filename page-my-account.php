<?php get_header();
/*Template Name: My Account*/
$imgPath = get_stylesheet_directory_uri().'/assets/img/homepage/';
if (is_user_logged_in()): ?>
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/my_account.css">
  <section class="my_account">
    <div class="wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="content">
              <div class="content-container">     
                <?php echo do_shortcode('[woocommerce_my_account]'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php elseif(is_page('login')): ?>
  <section class="login">
        <div class="wrapper">
          <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                  <div class="login_form">
                    <h1 class="text-white">Login</h1>
                    <p class="text-white">Porem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis.</p>
                    <?php echo do_shortcode('[custom_login_form]'); ?>
                    <p class="text-center">Don’t Have an Account? <strong><a href="<?php echo get_home_url(); ?>/login/" target="_blank" rel="noopener noreferrer"></a></strong></p>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12">
                  <div class="image">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/login_image.jpg" alt="">
                  </div>
                </div>
            </div>
          </div>
        </div>
    </section>
  <?php
  // header('Location: ' . get_home_url() . '/register');
endif; ?>
<?php
get_footer();
?>

<script>
  $(document).ready(function() {
    $("#togglePassword").on("click", function() {
      const passwordField = $("#user_pass");
      const toggleIcon = $(this);
      if (passwordField.attr("type") === "password") {
        passwordField.attr("type", "text");
        toggleIcon.removeClass("fa fa-eye").addClass("fa fa-eye-slash");
      } else {
        passwordField.attr("type", "password");
        toggleIcon.removeClass("fa fa-eye-slash").addClass("fa fa-eye");
      }
    });
  });
</script>