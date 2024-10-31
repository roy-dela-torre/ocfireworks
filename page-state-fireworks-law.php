<?php get_header();
/*Template Name: State Fireworks Law*/
?>
<section class="state_fireworks_law">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="top_content">
                        <h1>State Firework Laws</h1>
                        <p>Facilisi a ornare sociosqu vitae augue urna auctor nec natoque penatibus erat molestie, mattis scelerisque ad nulla praesent ultricies donec convallis elementum et blandit. Class donec odio consequat ullamcorper mattis fermentum magna lacinia commodo nunc habitasse purus feugiat condimentum, luctus curabitur ad litora libero conubia penatibus bibendum felis at dis dignissim aenean. Sollicitudin magna leo volutpat nostra arcu donec sem natoque dictumst integer, ultrices vulputate suspendisse vehicula convallis neque rutrum dui senectus cum nisi.</p>
                        <p>Accumsan aenean aliquam nulla platea luctus metus porta diam. Lectus ut quam gravida nulla pellentesque leo felis, commodo vivamus fusce arcu ad et cubilia, quis auctor donec varius mauris posuere. Scelerisque nam orci purus viverra dis gravida tincidunt risus in, nunc consequat mi luctus sociosqu vel tempus quam, dui cubilia vulputate magna hac hendrerit nec varius. Arcu pharetra ornare aenean nisl netus interdum rutrum tempor mi sodales, congue facilisis fames neque</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <ul class="row p-0">
                        <?php
                        $args = array(
                            'post_type'        => 'law',
                            'posts_per_page'   => -1, // Fetch all posts
                            'post_status'      => 'publish',
                            'orderby'          => 'title',  // Order by title
                            'order'            => 'ASC',    // A-Z order (ascending)
                        );
                        $law_query = new WP_Query($args);
                        if ($law_query->have_posts()) :
                            while ($law_query->have_posts()) : $law_query->the_post(); ?>
                                <li>
                                    <a href="<?php echo get_the_permalink(); ?>" target="_blank" rel="noopener noreferrer"><?php echo get_the_title(); ?></a>
                                </li>
                        <?php endwhile;
                        endif;
                        ?>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="bottom_content">
                        <h2>State Fireworks Laws</h2>
                        <p>In preparation for these pages, every effort has been made to offer the most current, correct, and clearly expressed information possible.</p>
                        <p>Nevertheless, inadvertent errors in information may occur. In particular but without limiting anything here, OCFireworks.com disclaims any responsibility for typographical errors and accuracy of the information that may be contained on OCFireworks.com web pages.</p>
                        <p>The information and data included on OCFireworks.com servers have been compiled by OCFireworks.com staff from a variety of sources, and are subject to change without notice to the User.</p>
                        <p>OCFireworks.com makes no warranties or representations whatsoever regarding the quality, content, completeness, suitability, adequacy, sequence, accuracy, or timeliness of such information and data.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo get_template_part('template/news-letter') ?>
<?php get_footer(); ?>