<?php get_header();
/*Template Name: Login*/ ?>
<?php if (is_user_logged_in()) { ?>
    <script>
        window.location.href = '<?php echo get_home_url(); ?>/my-account/';
    </script>
<?php } else { 
 wc_get_template('woocommerce/myaccount/form-login.php');
} ?>
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
