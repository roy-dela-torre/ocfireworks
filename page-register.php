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

<?php get_footer(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- Your JavaScript code here -->

<script>
$(document).ready(function() {
  $('button.woocommerce-Button.woocommerce-form-register__submit').click(function(e){
    e.preventDefault();
    var errorMessages = [];

    function addErrorMessage(field, message) {
      errorMessages.push(message);
      field.addClass('error');
    }

    function clearErrorMessages() {
      errorMessages = [];
      $('input').removeClass('error');
    }

    clearErrorMessages();

    var firstName = $('#reg_first_name');
    var lastName = $('#reg_last_name');
    var email = $('#reg_email');
    var phone = $('#billing_phone');
    var password1 = $('#password_1');
    var password2 = $('#password_2');
    
    // Validation for First Name
    if (firstName.val() === "") {
      addErrorMessage(firstName, "First Name is required.");
    }

    // Validation for Last Name
    if (lastName.val() === "") {
      addErrorMessage(lastName, "Last Name is required.");
    }

    // Validation for Email
    if (email.val() === "") {
      addErrorMessage(email, "Email is required.");
    } else if (!isValidEmail(email.val())) {
      addErrorMessage(email, "Invalid email address.");
    }

    // Validation for Phone Number
    if (phone.val() === "") {
      addErrorMessage(phone, "Phone Number is required.");
    }

    // Validation for Password
    if (password1.val() === "") {
      addErrorMessage(password1, "Password is required.");
    } else if (password1.val().length < 12) {
      addErrorMessage(password1, "Very weak - Please enter a stronger password.");
    }

    // Validation for Confirm Password
    if (password2.val() === "") {
      addErrorMessage(password2, "Confirm Password is required.");
    } else if (password1.val() !== password2.val()) {
      addErrorMessage(password2, "Your passwords do not match. Please re-enter your password.");
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
