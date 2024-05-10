<?php get_header();
/*Template Name: Events*/
$img_path = get_stylesheet_directory_uri().'/assets/img/events/';
?>
<section class="template">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="header">
                    <h1 class="text-center">Gorem ipsum dolor sit amet Events adipiscing elit</h1>
                    <p class="text-center">Dorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="content">
                        <img src="<?php echo $img_path; ?>/Fourth of July Fireworks.jpg" alt="Fourth of July Fireworks">
                        <h3>Fourth of July Fireworks</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="content">
                        <img src="<?php echo $img_path; ?>/Gender Reveal Fireworks.jpg" alt="Gender Reveal Fireworks">
                        <h3>Gender Reveal Fireworks</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="content">
                        <img src="<?php echo $img_path; ?>/Wedding Fireworks.jpg" alt="Wedding Fireworks">
                        <h3>Wedding Fireworks</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer();?>