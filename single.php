<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/desktop/blog-single.css">
<?php get_header();
$imgPath = get_stylesheet_directory_uri().'/assets/img/homepage/';
$homeUrl = get_home_url();
?>
<style>
	blockquote{
		padding-left: 30px;
		border-left: 2px solid #094074;
		margin-left: 30px !important;
	}
	blockquote *{
		font-style: italic !important;
	}
</style>

<?php
$theTitle = "";
        // Start the loop.
while (have_posts()) : the_post();

// GATHER DATA (DEFAULT VALUE FROM WORDPRESS)
  $blog_id = get_the_ID();
  $blog_title = get_the_title();
  $blog_link = get_permalink();
  $blog_content = get_the_content();
  $blog_date = get_the_date();

  $singlePosts[] = $post->ID;
?>

<section class="blog-single">   
    <div class="container-fluid">
        <div class="wrapper">
            <div class="row">

            <div class="col-lg-8 col-md-12">
            <div class="header">
                    <h1><?php echo $blog_title;?></h1>
                </div>

                <div class="featureImage">
                    <?php echo get_the_post_thumbnail(); ?>
                    </div>
                <div id="content-left" class="single-content">
                    <?php echo the_content(); ?>
                </div>
                <div class="share">
                    <h5>Share it on:</h5>
                    <div class="soc-med-icons">
                        <a href="https://www.facebook.com/sharer.php?u=<?php echo get_home_url().get_post_field('post_name', get_the_ID()); ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blogs/icons/facebook.png" alt=""></a>
                        
                        <a href="https://twitter.com/share?url=<?php echo get_home_url().get_post_field('post_name', get_the_ID()); ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blogs/icons/xtwitter.png" alt=""></a>

                        <a href="https://www.linkedIn.com/share?url=<?php echo get_home_url().get_post_field('post_name', get_the_ID()); ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blogs/icons/linkedIn.png" alt=""></a>

                        <a href="https://www.external-link.com/sharer.php?u=<?php echo get_home_url().get_post_field('post_name', get_the_ID()); ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blogs/icons/external.png" alt=""></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                        <div class="blogs-shop-now">
                            <div class="content">
                                <h4>Gear Up for Card Adventures</h4>
                                <p class="text-white">It's time to level up your collection with cards from Flesh & Blood, Magic the Gathering, Pokemon, and more. </p>
                                <a href="<?php echo get_home_url(); ?>/shop/" target="_blank" rel="noopener noreferrer"
                                    class="blue-btn text-uppercase">Shop Now</a>
                            </div>
                        </div>
                        <div class="articles-container">
                            <h5 class="similar-articles-header">Similar Articles</h5>
                            <?php
                            $blogsPost = array('post_type' => 'post', 'order' => 'rand', 'posts_per_page' => 3, );
                            $blogsLoop = new WP_Query($blogsPost);
                            if ($blogsLoop->have_posts()):
                                while ($blogsLoop->have_posts()):
                                    $blogsLoop->the_post();
                                    if (has_post_thumbnail()) {
                                        $blogsImg = get_the_post_thumbnail_url($blogs_id, 'medium');
                                    } else {
                                        $blogsImg = '';
                                    }
                                    ?>
                                    <!-- <a href="<?php echo the_permalink(); ?>" target="_blank" rel="noopener noreferrer"> -->
                                        <div class="content">
                                           
                                            <div class="similar-images-container">
                                                <img src="<?php echo $blogsImg; ?>" alt="<?php echo the_title(); ?>">
                                            </div>
                                            <div class="similar-articles-content">
                                                <div class="articles-date"><span><?php echo date('M j, Y', strtotime(get_the_date())); ?></span></div>
                                                <div class="articles-title"><h5><?php echo wp_trim_words(get_the_title(), 3); ?></h5></div>
                                                <div class="articles-text"><p><?php echo wp_trim_words(get_the_excerpt(), 8); ?></p></div>
                                                <div class="read-more-content">
                                                    <a href="<?php echo get_permalink();?>" target="_blank" rel="noopener noreferrer" class="read-more ">Read More </a><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/blogs/single/blog-read-more-vector-img.png" style="height: 16px;padding-left:10px" >
                                                </div>
                                            </div>
                                        </div>
                                    <!-- </a> -->
                                <?php endwhile;
                            endif; ?>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>

<?php
    endwhile;
?>

<?php
get_footer();?>
<!-- <script>
$(document).ready(function() {
    var h3Elements = $('section.moreBlogs h3');
    var tallestHeight = 0;
    h3Elements.each(function() {
        var height = $(this).height();
        if (height > tallestHeight) {   
            tallestHeight = height;
        }
    });
    $('section.moreBlogs h3').css('height',tallestHeight)
});
</script> -->