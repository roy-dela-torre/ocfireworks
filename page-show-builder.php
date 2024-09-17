<?php get_header();
/*Template Name: Show Builder*/
?>
<section class="show_builder">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                <?php
                        $section = "show_builder";
                        $header = get_the_title();
                        $p_text = "Firework woes? We've got the BOOMS! Ask our dazzling experts for an epic display!";
                        $shortcode = '[contact-form-7 id="700a603" title="Show Builder"]';
                        $data = array(
                            'section' => $section,
                            'header' => $header,    
                            'p_text' => $p_text, 
                            'shortcode' => $shortcode, 
                        );
                        ob_start();
                    ?>
                    <?php echo wc_get_template('template/form.php', $data);?>
                    <?php
                        $content = ob_get_clean();
                        echo $content;
                ?>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="contact_us_info">
                        <h1>Help is here!</h1>
                        <p>It can be difficult to decide which fireworks to purchase for your show. Let us help you. Fill out the contact information below and use the comment box to tell us about your budget and what you like to see light up your sky. Then submit! One of our fireworks professionals will reach out to you via email and help build the best show for you and your budget. Please note, this service is to help get the most bang for your buck; this is NOT a show designing service.</p>
                        <p>You must have an account on our website for the process to work, so please create an account with your information before submitting here.</p>
                        <p>If you do not submit a budget, your request will be ignored. If you do not provide direction on what you like, you will receive an assortment of items. You can always make changes once you receive our suggestions.</p>
                        <p>Office Hours: Monday-Friday 9am-5pm ET</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer();?>