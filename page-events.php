<?php get_header();
/*Template Name: Events*/
$img_path = get_stylesheet_directory_uri().'/assets/img/events/';
?>
<section class="events">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header red_text">
                    <h1 class="text-center">Gorem ipsum dolor sit amet Events adipiscing elit</h1>
                    <p class="text-center">Dorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="content">
                        <img class="w-100 img-fluid h-100 object-fit-cover" src="<?php echo $img_path; ?>/Fourth of July.jpg" alt="Fourth of July Fireworks">
                        <h2 class="text-white mb-0 position-absolute text-center">Fourth of July Fireworks</h2>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="content">
                        <img class="w-100 img-fluid h-100 object-fit-cover" src="<?php echo $img_path; ?>/Gender Reveal Fireworks.jpg" alt="Gender Reveal Fireworks">
                        <h2 class="text-white mb-0 position-absolute text-center">Gender Reveal Fireworks</h2>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="content">
                        <img class="w-100 img-fluid h-100 object-fit-cover" src="<?php echo $img_path; ?>/Wedding Fireworks.jpg" alt="Wedding Fireworks">
                        <h2 class="text-white mb-0 position-absolute text-center">Wedding Fireworks</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer();?>