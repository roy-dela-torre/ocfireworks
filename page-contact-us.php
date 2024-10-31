<?php get_header();
/*Template Name: Contact Us*/
?>
<section class="contact_us">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <?php
                    $section = "contact_us";
                    $header = get_the_title();
                    $p_text = "Light up your night!  OC Fireworks makes any event explosive. Contact us for a firework finale you won't forget!";
                    $shortcode = '[contact-form-7 id="85e7ba4" title="Contact Us"]';
                    $data = array(
                        'section' => $section,
                        'header' => $header,
                        'p_text' => $p_text,
                        'shortcode' => $shortcode,
                    );
                    ob_start();
                    echo wc_get_template('template/form.php', $data);
                    $content = ob_get_clean();
                    echo $content;
                    ?>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="contact_us_info d-flex flex-column">
                        <div class="contact_info d-flex flex-column">
                            <div class="phone d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                    <path d="M9.72624 20.2297C13.3552 23.858 17.7748 26.6582 21.378 26.6582C22.998 26.6582 24.4166 26.093 25.5593 24.8373C26.2246 24.0964 26.6393 23.2302 26.6393 22.3768C26.6393 21.7489 26.4004 21.1463 25.7982 20.7193L21.9555 17.9818C21.3657 17.58 20.8761 17.3791 20.4239 17.3791C19.8464 17.3791 19.3439 17.7059 18.7664 18.2705L17.875 19.1497C17.749 19.2771 17.5775 19.3494 17.3982 19.3505C17.1973 19.3505 17.0211 19.2755 16.8834 19.2123C16.1173 18.7982 14.7866 17.6555 13.5432 16.425C12.3127 15.1945 11.17 13.8638 10.7682 13.0854C10.6815 12.9318 10.6342 12.7592 10.6305 12.5829C10.6305 12.42 10.6804 12.2561 10.8186 12.1184L11.6971 11.2023C12.2629 10.6243 12.5891 10.1218 12.5891 9.5443C12.5891 9.09269 12.3882 8.60305 11.9741 8.01269L9.2741 4.20805C8.83482 3.60537 8.21982 3.3418 7.5416 3.3418C6.71285 3.3418 5.8466 3.7184 5.11857 4.43465C3.90035 5.60251 3.36035 7.04573 3.36035 8.64001C3.36035 12.2438 6.11017 16.6136 9.72624 20.2297Z" fill="#BF2126" />
                                </svg>
                                <a href="tel:+574-742-8164">574-742-8164</a>
                            </div>
                            <div class="email d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                    <path d="M25 5H5C3.625 5 2.5 6.125 2.5 7.5V22.5C2.5 23.875 3.625 25 5 25H25C26.375 25 27.5 23.875 27.5 22.5V7.5C27.5 6.125 26.375 5 25 5ZM24.5 10.3125L16.325 15.425C15.5125 15.9375 14.4875 15.9375 13.675 15.425L5.5 10.3125C5.37466 10.2421 5.2649 10.1471 5.17736 10.0331C5.08982 9.91906 5.02633 9.78847 4.99072 9.64921C4.95511 9.50995 4.94813 9.36492 4.9702 9.22288C4.99226 9.08085 5.04292 8.94477 5.1191 8.82288C5.19528 8.70099 5.29541 8.59582 5.41341 8.51374C5.53141 8.43167 5.66484 8.37439 5.80562 8.34537C5.9464 8.31636 6.0916 8.31621 6.23244 8.34494C6.37328 8.37366 6.50683 8.43067 6.625 8.5125L15 13.75L23.375 8.5125C23.4932 8.43067 23.6267 8.37366 23.7676 8.34494C23.9084 8.31621 24.0536 8.31636 24.1944 8.34537C24.3352 8.37439 24.4686 8.43167 24.5866 8.51374C24.7046 8.59582 24.8047 8.70099 24.8809 8.82288C24.9571 8.94477 25.0077 9.08085 25.0298 9.22288C25.0519 9.36492 25.0449 9.50995 25.0093 9.64921C24.9737 9.78847 24.9102 9.91906 24.8226 10.0331C24.7351 10.1471 24.6253 10.2421 24.5 10.3125Z" fill="#BF2126" />
                                </svg>
                                <a href="mailto:ian@ocfireworks.com">ian@ocfireworks.com</a>
                            </div>
                            <div class="location d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                    <path d="M15.5 14.25C14.5054 14.25 13.5516 13.8549 12.8483 13.1517C12.1451 12.4484 11.75 11.4946 11.75 10.5C11.75 9.50544 12.1451 8.55161 12.8483 7.84835C13.5516 7.14509 14.5054 6.75 15.5 6.75C16.4946 6.75 17.4484 7.14509 18.1517 7.84835C18.8549 8.55161 19.25 9.50544 19.25 10.5C19.25 10.9925 19.153 11.4801 18.9645 11.9351C18.7761 12.39 18.4999 12.8034 18.1517 13.1517C17.8034 13.4999 17.39 13.7761 16.9351 13.9645C16.4801 14.153 15.9925 14.25 15.5 14.25ZM15.5 0C12.7152 0 10.0445 1.10625 8.07538 3.07538C6.10625 5.04451 5 7.71523 5 10.5C5 18.375 15.5 30 15.5 30C15.5 30 26 18.375 26 10.5C26 7.71523 24.8938 5.04451 22.9246 3.07538C20.9555 1.10625 18.2848 0 15.5 0Z" fill="#BF2126" />
                                </svg>
                                <a href="https://www.google.com/maps/place/13421+McKinley+Hwy,+Mishawaka,+IN+46545,+USA/@41.6813486,-86.1273883,17z/data=!3m1!4b1!4m6!3m5!1s0x8816cfced1933acd:0xdf1e5c9119ca9b1e!8m2!3d41.6813486!4d-86.1273883!16s%2Fg%2F11bw4dnmqg?entry=ttu" target="_blank" rel="noopener noreferrer">13421 Mckinley Hwy Mishawaka, IN 46545</a>
                            </div>
                        </div>
                        <div class="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2979.81454097319!2d-86.12738829999999!3d41.6813486!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8816cfced1933acd%3A0xdf1e5c9119ca9b1e!2s13421%20McKinley%20Hwy%2C%20Mishawaka%2C%20IN%2046545%2C%20USA!5e0!3m2!1sen!2sph!4v1729740712585!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>