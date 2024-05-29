<?php
/* Template Name: Registration Page */
if (is_user_logged_in()) {
    header('Location: ' . get_home_url() . '/my-account/');
    exit; // Make sure to exit to prevent further execution
}

get_header();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
<section class="registration">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="signup_form">
                        <h1><?php echo the_title(); ?></h1>
                        <p>Already have an account? <a href="<?php echo get_home_url()?>/my-account/" rel="noopener noreferrer">Log in</a></p>
                        <?php echo do_shortcode('[registration_form]'); ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="image">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/signup_image.jpg" alt="Registration">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- Your JavaScript code here -->

<script>
$(document).ready(function() {
  $('button[type="submit"]').click(function(e){
    e.preventDefault();
    var errorMessages = [];

    function addErrorMessage(field, message) {
      errorMessages.push(message);
      field.addClass('invalid');
    }

    function clearErrorMessages() {
      errorMessages = [];
      $('input').removeClass('invalid');
    }

    clearErrorMessages();

    var regFirstName = $('input#reg_first_name');
    var regLastName = $('input#reg_last_name');
    var regPhone = $('input#billing_phone');
    var regEmail = $('input#reg_email');
    var regPassword = $('input#password_1');
    var regConfirmPassword = $('input#password_2');
    var disclamer = $('input#rememberme');
    
    // Validation for First Name
    if (regFirstName.val() === "") {
      addErrorMessage(regFirstName, "First Name is required.");
    }

    // Validation for Last Name
    if (regLastName.val() === "") {
      addErrorMessage(regLastName, "Last Name is required.");
    }

    // Validation for Phone
    if (regPhone.val() === "") {
      addErrorMessage(regPhone, "Phone Number is required.");
    }

    // Validation for Disclaimer checkbox
    if (!disclamer.is(':checked')) {
      addErrorMessage(disclamer, "Please accept before submitting.");
    }

    // Validation for Email
    if (regEmail.val() === "") {
      addErrorMessage(regEmail, "Email is required.");
    } else if (!isValidEmail(regEmail.val())) {
      addErrorMessage(regEmail, "Invalid email address.");
    }

    // Validation for Password
    if (regPassword.val() === "") {
      addErrorMessage(regPassword, "Password is required.");
    }

    // Validation for Confirm Password
    if (regConfirmPassword.val() === "") {
      addErrorMessage(regConfirmPassword, "Confirm Password is required.");
    } else if (regPassword.val() !== regConfirmPassword.val()) {
      addErrorMessage(regConfirmPassword, "Passwords do not match.");
    }

    if (errorMessages.length > 0) {
      var errorMessage = errorMessages.join("\n");
      swal("Error", errorMessage, "error");
    } else {
      $('form.woocommerce-form.woocommerce-form-register.register').submit();
    }
  });

  function isValidEmail(email) {
    // Regular expression for email validation
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return emailPattern.test(email);
  }
});
</script>
