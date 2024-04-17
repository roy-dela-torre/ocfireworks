<?php get_header();
/*Template Name: Login*/ ?>
<?php if (is_user_logged_in()) { ?>
    <script>
        window.location.href = '<?php echo get_home_url(); ?>/my-account/';
    </script>
<?php } else { ?>
    <section class="login">
        <div class="container-fluid">
            <div class="wrapper">
                <div class="row">
                    <?php echo do_shortcode('[custom_login_form]'); ?>
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
