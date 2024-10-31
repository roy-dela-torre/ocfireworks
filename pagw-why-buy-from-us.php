<?php get_header();
/*Template Name: Why buy from us*/
?>
<style>
    body{
        background:url('<?php echo get_stylesheet_directory_uri(); ?>/assets/img/why_but_from_us/banner.jpg')no-repeat center center/cover !important;
    }
</style>
<section class="why_buy_from_us">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="content">
                    <h1>Why Buy From Us?</h1>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>