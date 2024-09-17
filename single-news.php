<?php get_header(); ?>
<style>
    section.singleNewsContainer{
        padding: 100px 0;
    }
    @media (max-width: 1200px) {
        section.singleNewsContainer{
            padding: 70px 30px;
        }
    }

    @media (max-width: 991px) {
        section.singleNewsContainer{
            padding: 50px 20px;
        }
    }
</style>
<section class="singleNewsBanner">
    <?php echo get_the_post_thumbnail(); ?>
</section>
<section class="singleNewsContainer">
    <div class="container">
        <div class="col-xl-8 col-lg-8 col-md-10 m-auto">
            <h1 class="text-center">
                <?php echo the_title(); ?>
            </h1>
            <p class="text-center">
                <?php echo the_date(); ?>
            </p>
        </div>
        <div class="singleNewsContent">
            <?php echo the_content(); ?>
        </div>
    </div>
</section>
<section class="hp__news">
    <div class="container">
        <div class="row">
            <?php
            $newsAr = array(
                'post_type' => 'news',
                'posts_per_page' => 3,
            );
            $news = new WP_Query($newsAr);
            if ($news->have_posts()):
                while ($news->have_posts()):
                    $news->the_post();
            ?>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="hp-news-item">
                            <div class="news-img">
                                <?php
                                if (has_post_thumbnail()):
                                    echo get_the_post_thumbnail();
                                else:
                                ?>
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo 1.png" alt="Chevrolet Logo">
                                <?php endif; ?>
                            </div>
                            <div class="news-content">
                                <div class="news-shordesc">
                                    <h4><?php echo the_title(); ?></h4>
                                    <p>
                                        <?php echo the_field('short_description'); ?>
                                    </p>
                                    <a href="<?php echo the_permalink(); ?>">read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_query();
            endif;
            ?>
        </div>
        <!-- <div class="d-flex justify-content-center mt-5">
            <a class="gold-button" href="<?php echo get_home_url(); ?>/news/">See More</a>
        </div> -->
    </div>
</section>
<?php get_footer(); ?>