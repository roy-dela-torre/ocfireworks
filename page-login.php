<?php get_header();
/*Template Name: Login*/ ?>
<?php if (is_user_logged_in()) { ?>
    <script>
        window.location.href = '<?php echo get_home_url(); ?>/my-account/';
    </script>
<?php } else { ?>
  <!-- login page -->
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
<?php } ?>
<?php get_footer(); ?>

<script>
  $(document).ready(function() {
    $("#togglePassword").on("click", function() {
      console.log("Eye icon clicked");
      
      const passwordField = $("#user_pass");
      const toggleIcon = $(this);

      if (passwordField.attr("type") === "password") {
        passwordField.attr("type", "text");
        toggleIcon.removeClass("fa-eye").addClass("fa-eye-slash");
        console.log("Password revealed");
      } else {
        passwordField.attr("type", "password");
        toggleIcon.removeClass("fa-eye-slash").addClass("fa-eye");
        console.log("Password hidden");
      }
    });
  });
</script>
