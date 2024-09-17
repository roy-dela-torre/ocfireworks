<?php get_header();
/*Template Name: Disclamer*/
?>
<style>
    section p {
        line-height: 140%;
        margin-bottom: 20px;
    }

    section a {
        text-decoration: underline;
    }
</style>
<section class="disclamer" style="background: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/terms_and_condition/banner.jpg')no-repeat center center/cover">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="content">
                    <h1><?php echo get_the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>