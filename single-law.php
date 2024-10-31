<?php get_header(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/single-law.css">
<?php
while (have_posts()) : the_post(); ?>
    <section class="laws_content">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="content">
                        <div class="back_to_laws position-relative">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="21" viewBox="0 0 26 21" fill="none">
                                <path d="M1.99652 8.14898L0.998262 9.15849L0 8.14898L0.998262 7.13946L1.99652 8.14898ZM26 19.5721C26 19.9508 25.8512 20.314 25.5864 20.5818C25.3216 20.8496 24.9625 21 24.588 21C24.2136 21 23.8544 20.8496 23.5896 20.5818C23.3248 20.314 23.1761 19.9508 23.1761 19.5721H26ZM8.05811 16.298L0.998262 9.15849L2.99479 7.13946L10.0546 14.2789L8.05811 16.298ZM0.998262 7.13946L8.05811 0L10.0546 2.01904L2.99479 9.15849L0.998262 7.13946ZM1.99652 6.72109H16.1162V9.57687H1.99652V6.72109ZM26 16.7163V19.5721H23.1761V16.7163H26ZM16.1162 6.72109C18.7376 6.72109 21.2515 7.77415 23.1051 9.64862C24.9587 11.5231 26 14.0654 26 16.7163H23.1761C23.1761 14.8228 22.4323 13.0069 21.1083 11.668C19.7843 10.3291 17.9886 9.57687 16.1162 9.57687V6.72109Z" fill="#BF2126" />
                            </svg>
                            <a href="<?php echo get_home_url(); ?>/state-firework-laws/" class="stretched-link red_text text-uppercase">Back to state Fireworks Laws</a>
                        </div>
                        <?php
                        if (is_single(892) || is_single(888)) { ?>
                            <h1><?php echo get_the_title(); ?></h1>
                        <?php } else { ?>
                            <h1><?php echo get_the_title(); ?> Laws</h1>
                        <?php }
                        ?>
                        <div class="main_content">
                            <?php echo get_the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endwhile;
?>
<?php
get_template_part('template/news-letter');
get_footer(); ?>
<script>
    // $('tr td:last-child').each(function() {
    //     var paragraphs = $(this).html().split(/<br\s*\/?>/g).map(function(item) {
    //         return $.trim(item); // Trim each part
    //     });
    //     var newContent = paragraphs.map(function(item) {
    //         return '<p>' + item + '</p>';
    //     }).join('');
    //     $(this).html(newContent);
    // });
</script>