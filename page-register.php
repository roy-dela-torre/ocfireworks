<?php
/* Template Name: Registration Page */
if (is_user_logged_in()) {
    header('Location: ' . get_home_url() . '/my-account/');
    exit; // Make sure to exit to prevent further execution
}

get_header();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/register.css">
<div class="bd__custom">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/register-banner.jpg" alt="Registration">
</div>
</div>

<section class="registration">
    <div class="container-fluid">
        <div class="row">
            <div class="__side col-lg-5 col-md-12">
                <div class="form">
                    <h1>Create an Account</h1>
                    <?php echo do_shortcode('[registration_form]'); ?>
                    <p class="text-center">Already have an account? <a href="<?php echo get_home_url()?>/my-account/" rel="noopener noreferrer">Log in</a></p>
                    <?php echo do_shortcode('[nextend_social_login_register_flow]')?>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 pe-md-0">
                <div class="image-container">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/register-banner.jpg" alt="Registration">
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
// $(document).ready(function() {
//   $('button.woocommerce-Button.button').click(function(e){
//     e.preventDefault();
//     var errorMessages = [];

//     function addErrorMessage(field, message) {
//       errorMessages.push(message);
//       field.addClass('error');
//     }

//     function clearErrorMessages() {
//       errorMessages = [];
//       $('input').removeClass('error');
//     }

//     clearErrorMessages();

//     var regUsername = $('input#reg_username');
//     var regEmail = $('input#reg_email');
//     var regPassword = $('input#reg_password');
    
//     // Validation for Username
//     if (regUsername.val() === "") {
//       addErrorMessage(regUsername, "Username is required.");
//     }

//     // Validation for Email
//     if (regEmail.val() === "") {
//       addErrorMessage(regEmail, "Email is required.");
//     } else if (!isValidEmail(regEmail.val())) {
//       addErrorMessage(regEmail, "Invalid email address.");
//     }

//     // Validation for Password
//     if (regPassword.val() === "") {
//       addErrorMessage(regPassword, "Password is required.");
//     }

//     if (errorMessages.length > 0) {
//       var errorMessage = errorMessages.join("\n");
//       swal("Error", errorMessage, "error");
//     } 
//     else {
//       $('form.woocommerce-form.woocommerce-form-register.register').submit();
//     }
//   });

//   function isValidEmail(email) {
//     // Regular expression for email validation
//     var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
//     return emailPattern.test(email);
//   }
// });
</script>
