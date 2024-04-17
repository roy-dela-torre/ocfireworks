<?php get_header();
/*Template Name: My Account*/
$imgPath = get_stylesheet_directory_uri().'/assets/img/homepage/';
if (is_user_logged_in()): ?>
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/desktop/my-account.css">
  <section class="my-account">
    <div class="container-fluid">
      <div class="wrapper">
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

<?php else: ?>
  <section class="login">
    <div class="container-fluid">
        <div class="wrapper">
            <div class="row">
                <div class="col-xxl-8 col-xl-9 col-lg-12 px-sm-0">
                    <div class="content">
                        <div class="content-container">     
                        <!-- <h2 class="text-uppercase text-white">Welcome</h2>
                        <p class="text-white">Log in your account</p> -->
                            <?php echo do_shortcode('[woocommerce_my_account]'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-12">
                    <div class="contact-details">
                     
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