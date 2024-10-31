<?php get_header();
/*Template Name: Privacy Policy*/
?>
<section class="pricay_policy">
    <div class="container-fluid">
        <div class="wrapper">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-12">
                    <div class="buttons">
                        <a class="active" href="#button2">What information do we collect?</a>
                        <a class="" href="#button3">What do we use your information for?</a>
                        <a class="" href="#button4">How do we protect your information?</a>
                        <a class="" href="#button5">Do we use cookies?</a>
                        <a class="" href="#button6">Do we disclose any information to outside parties?</a>
                        <a class="" href="#button7">Children's Online Privacy Protection Act Compliance</a>
                        <a class="" href="#button8">Online Privacy Policy Only</a>
                        <a class="" href="#button9">Terms and Conditions</a>
                        <a class="" href="#button10">Your Consent</a>
                        <a class="" href="#button11">Contacting Us</a>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-12">
                    <h1>Privacy Policy</h1>
                    <div class="content">
                        <div id="button2">
                            <h2>What information do we collect?</h2>
                            <p>We collect information from you when you register on our site or place an order.</p>
                            <p>When ordering or registering on our site, as appropriate, you may be asked to enter your: name, e-mail address, mailing address, phone number, or credit card information.</p>
                        </div>
                        <div id="button3">
                            <h3>What do we use your information for?</h3>
                            <p>Any of the information we collect from you may be used in one of the following ways:</p>
                            <p>To process transactions</p>
                            <p>Your information, whether public or private, will not be sold, exchanged, transferred, or given to any other company for any reason whatsoever, without your consent, other than for the express purpose of delivering the purchased product, or service requested.</p>
                        </div>
                        <div id="button4">
                            <h3>How do we protect your information?</h3>
                            <p>
                                We implement a variety of security measures to maintain the safety of your personal information when you place an order.

                            </p>
                            <p>
                                We offer the use of a secure server. All supplied sensitive/credit information is transmitted via Secure Socket Layer (SSL) technology and then encrypted into our Payment gateway providers database only to be accessible by those authorized with special access rights to such systems, and are required to keep the information confidential.

                            </p>
                            <p>
                                After a transaction, your private information (credit cards) will not be stored on our servers.

                            </p>
                        </div>
                        <div id="button5">
                            <h3>Do we use cookies?</h3>
                            <p>We do not use cookies.</p>
                        </div>
                        <div id="button6">
                            <h3>Do we disclose any information to outside parties?</h3>
                            <p>We do not sell, trade, or otherwise transfer to outside parties your personally identifiable information. This does not include trusted third parties who assist us in operating our website, conducting our business, or servicing you, so long as those parties agree to keep this information confidential. We may also release your information when we believe release is appropriate to comply with the law, enforce our site policies, or protect our or other's rights, property, or safety. However, non-personally identifiable visitor information may be provided to other parties for marketing, advertising, or other uses.</p>
                        </div>
                        <div id="button7">
                            <h3>Children's Online Privacy Protection Act Compliance</h3>
                            <p>We are in compliance with the requirements of COPPA (Children's Online Privacy Protection Act), Our website, products and services are all directed to people who are at least 18 years old or older.</p>
                        </div>
                        <div id="button8">
                            <h3>Online Privacy Policy Only</h3>
                            <p>This online privacy policy applies only to information collected through our websites and not to information collected offline.</p>
                        </div>
                        <div id="button9">
                            <h3>Terms and Conditions</h3>
                            <p>Please also visit our Terms and Conditions section establishing the use, disclaimers, and limitations of liability governing the use of our website at <a href="http://www.ocfireworks.com" target="_blank" rel="noopener noreferrer" class="red_text text-lowecase">http://www.ocfireworks.com</a></p>
                        </div>
                        <div id="button10">
                            <h3>Your Consent</h3>
                            <p>By using our site, you consent to our online privacy policy.</p>
                        </div>
                        <div id="button11">
                            <h3>Contacting Us</h3>
                            <p>If there are any questions regarding this privacy policy you may contact us using the information below.</p>
                            <ul>
                                <li>OCFireworks.com</li>
                                <li>13421 Mckinley HwyMishawaka,</li>
                                <li>Indiana46545</li>
                                <li>sales@ocfireworks.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
<script>
    $(document).ready(function() {
        $('.buttons a').click(function() {
            $('.buttons a').removeClass('active')
            $(this).addClass('active')
        });
        $('.buttons a[href^="#"]').click(function() {
            const target = $($(this).attr('href'));
            let offset = 260;
            if ($(window).width() <= 767) {
                offset = 70;
            }
            const targetPosition = target.offset().top - offset;
            $('html, body').animate({
                scrollTop: targetPosition
            }, 'smooth');
        });
        $('.buttons a').click(function(event) {
            event.preventDefault();
            $('.buttons a').removeClass('active');
            $(this).addClass('active');
        });
    })
</script>