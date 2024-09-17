<?php get_header();
/*Template Name: Learn*/
$img = get_stylesheet_directory_uri().'/assets/img/learn';
?>
<section class="banner">
    <div class="container-xxl">
        <div class="row">
            <div class="header">
                <h1 class="text-center">Massa venenatis habitasse montes magnis sagittis ci</h1>
            </div>
            <div class="today_topic">
                <div class="today_topic_header">
                    <div class="today_topic_button">Today’s Picks</div>
                </div>
                <div class="today_topic_main_content">
                <?php
                    $args = array(
                        'post_type'        => 'post',
                        'posts_per_page'   => 3,
                        'post_status' 	   => 'publish',
                        'order' => 'ASC',
                    );
                    $large_content = 0;
                    $blogs_query = new WP_Query($args);
                    if ($blogs_query->have_posts()):
                        while ($blogs_query->have_posts()) : $blogs_query->the_post();
                            $id = get_the_ID();
                            $date = get_the_date();
                            $title = get_the_title();
                            $description = get_the_excerpt();
                            $link = get_permalink(); 
                            $excluded_posts[] = $id;
                            if($large_content != 2):?>
                                <div class="today_topic_small_content">
                                    <div class="image">
                                        <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo get_the_title(); ?>" alt="">
                                    </div>
                                    <div class="content">
                                        <?php
                                        $categories = get_the_category();
                                        $filtered_categories = array_filter($categories, function($category) {
                                            return $category->slug !== 'uncategorized';
                                        });

                                        if (!empty($filtered_categories)) {
                                            echo '<div class="categories">';
                                            foreach ($filtered_categories as $category) {
                                                $category_link = get_category_link($category->term_id);
                                                echo '<a href="' . esc_url($category_link) . '" target="_blank" rel="noopener noreferrer">' . esc_html($category->name) . '</a> ';
                                            }
                                            echo '</div>';
                                        }
                                        ?>

                                        <h3 class="title"><?php echo wp_trim_words($title,7);?></h3>
                                        <p class="description"><?php echo wp_trim_words($description,8); ?><a href="http://" target="_blank" rel="noopener noreferrer" class="read_more">Read More</a></p>
                                        <p class="author"><?php the_author(); ?></p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="today_topic_large_content">
                                    <div class="image">
                                        <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo get_the_title(); ?>" alt="">
                                    </div>
                                    <div class="content">
                                        <?php
                                            $categories = get_the_category();
                                            $filtered_categories = array_filter($categories, function($category) {
                                                return $category->slug !== 'uncategorized';
                                            });

                                            if (!empty($filtered_categories)) {
                                                echo '<div class="categories">';
                                                foreach ($filtered_categories as $category) {
                                                    $category_link = get_category_link($category->term_id);
                                                    echo '<a href="' . esc_url($category_link) . '" target="_blank" rel="noopener noreferrer">' . esc_html($category->name) . '</a> ';
                                                }
                                                echo '</div>';
                                            }?>
                                        <h3 class="title"><?php echo wp_trim_words($title,7);?></h3>
                                        <p class="description"><?php echo wp_trim_words($description,20); ?><a href="http://" target="_blank" rel="noopener noreferrer" class="read_more">Read More</a></p>
                                        <p class="author"><?php the_author(); ?></p>
                                    </div>
                                </div>
                            <?php endif;?>
                            <?php $large_content += 1; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>  
                </div>
            </div>
            <div class="recent">
                <div class="recent_header">
                    <div class="recent_header_button">most recent</div>
                </div>
                <?php
                    $args = array(
                        'post_type'        => 'post',
                        'posts_per_page'   => 5,
                        'post_status' 	   => 'publish',
                        'order' => 'ASC',
                        'post__not__in' => $$excluded_posts
                    );
                    $blogs_query = new WP_Query($args);
                    if ($blogs_query->have_posts()):
                        while ($blogs_query->have_posts()) : $blogs_query->the_post();
                            $id = get_the_ID();
                            $date = get_the_date();
                            $title = get_the_title();
                            $description = get_the_excerpt();
                            $link = get_permalink(); ?>
                        <div class="content">
                            <div class="image">
                                <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo get_the_title(); ?>" alt="">
                            </div>
                            <div class="recent_content">
                                <h4 class="title"><?php echo wp_trim_words($title,8);?></h4>
                                <p class="description d-block d-xl-none d-md-block"><?php echo wp_trim_words($description,20); ?></p>    
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="beginner_blog template_blog d-none">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="header">
                    <div class="header_button">Beginner Blog</div>
                </div>
            </div>

            <?php
            // Query posts from 'Beginner level' category
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'post_status' => 'publish',
                'order' => 'ASC',
                'category_name' => 'beginner-level' // Replace with your actual category slug
            );

            $blogs_query = new WP_Query($args);
            if ($blogs_query->have_posts()) :
                while ($blogs_query->have_posts()) : $blogs_query->the_post();
                    $id = get_the_ID();
                    $date = get_the_date();
                    $title = get_the_title();
                    $description = get_the_excerpt();
                    $link = get_permalink();
            ?>
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="content">
                            <div class="image">
                                <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo esc_attr($title); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 ps-lg-4">
                        <div class="content">
                            <?php
                            $categories = get_the_category();
                            $filtered_categories = array_filter($categories, function ($category) {
                                return $category->slug !== 'uncategorized';
                            });

                            if (!empty($filtered_categories)) {
                                echo '<div class="categories">';
                                foreach ($filtered_categories as $category) {
                                    $category_link = get_category_link($category->term_id);
                                    echo '<a href="' . esc_url($category_link) . '" target="_blank" rel="noopener noreferrer">' . esc_html($category->name) . '</a> ';
                                }
                                echo '</div>';
                            }
                            ?>
                            <h2><?php echo $title; ?></h2>
                            <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo esc_attr($title); ?>" class="d-block d-lg-none">
                            <p class="description"><?php echo wp_trim_words($description, 80); ?></p>
                            <p class="author"><?php the_author(); ?></p>
                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata(); // Reset post data
            endif;
            ?>

        </div>

        <div class="row">
            <?php
            // Query more posts from 'Beginner level' category
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 4,
                'post_status' => 'publish',
                'order' => 'ASC',
                'category_name' => 'beginner-level', // Replace with your actual category slug
                'post__not_in' => $excluded_posts // Exclude already displayed posts
            );

            $blogs_query = new WP_Query($args);
            if ($blogs_query->have_posts()) :
                while ($blogs_query->have_posts()) : $blogs_query->the_post();
                    $id = get_the_ID();
                    $title = get_the_title();
            ?>
                    <div class="col-xl-3 col-lg-4 co-md-6">
                        <div class="content">
                            <div class="image">
                                <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo esc_attr($title); ?>">
                            </div>
                            <?php
                            $categories = get_the_category();
                            $filtered_categories = array_filter($categories, function ($category) {
                                return $category->slug !== 'uncategorized';
                            });

                            if (!empty($filtered_categories)) {
                                echo '<div class="categories">';
                                foreach ($filtered_categories as $category) {
                                    $category_link = get_category_link($category->term_id);
                                    echo '<a href="' . esc_url($category_link) . '" target="_blank" rel="noopener noreferrer">' . esc_html($category->name) . '</a> ';
                                }
                                echo '</div>';
                            }
                            ?>
                            <h3><?php echo wp_trim_words($title, 7); ?></h3>
                            <p class="author"><?php the_author(); ?></p>
                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata(); // Reset post data
            endif;
            ?>
        </div>
    </div>
</section>


<section class="intermediate_blog template_blog d-none">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="header">
                    <div class="header_button">Intermediate Blog</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="content">
                    <div class="categories">
                        <a href="http://" target="_blank" rel="noopener noreferrer">PDAX</a>
                        <a href="http://" target="_blank" rel="noopener noreferrer">ETH</a>
                        <a href="http://" target="_blank" rel="noopener noreferrer">Featured</a>
                    </div>
                    <h2>PDAXScope: Bitcoin Tumbles Below $60K, Ether Under $3K</h2>
                    <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo get_the_title(); ?>" alt="" class="d-block d-lg-none">
                    <p class="description">Bitcoin experienced a significant drop, erasing its previous gains from Saturday's selloff recovery. During the Wednesday U.S. trading session, it fell below the $60,000 mark, hitting a low of $59,900, down over 3% in the last 24 hours. This is its lowest price since early March, even though it had briefly climbed back above $64,000 earlier in the day. Ether, the second-largest cryptocurrency, also saw a decline, dropping below $3,000 and decreasing by 2.5% over the same period.</p>
                    <p class="author">Lorem Ipsum Dolor</p>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block ps-lg-4">
                <div class="content">
                    <div class="image">
                        <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo get_the_title(); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4 co-md-6">
                <div class="content">
                    <div class="image">
                        <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo get_the_title(); ?>" alt="">
                    </div>
                    <div class="categories">
                        <a href="http://" target="_blank" rel="noopener noreferrer">PDAX</a>
                        <a href="http://" target="_blank" rel="noopener noreferrer">ETH</a>
                        <a href="http://" target="_blank" rel="noopener noreferrer">Featured</a>
                    </div>
                    <h3>#YourNextMoneyMove - Get free BTC on your first trade.</h3>
                    <p class="author">Lorem Ipsum Dolor</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 co-md-6">
                <div class="content">
                    <div class="image">
                        <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo get_the_title(); ?>" alt="">
                    </div>
                    <div class="categories">
                        <a href="http://" target="_blank" rel="noopener noreferrer">PDAX</a>
                        <a href="http://" target="_blank" rel="noopener noreferrer">ETH</a>
                        <a href="http://" target="_blank" rel="noopener noreferrer">Featured</a>
                    </div>
                    <h3>#YourNextMoneyMove - Get free BTC on your first trade.</h3>
                    <p class="author">Lorem Ipsum Dolor</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 co-md-6">
                <div class="content">
                    <div class="image">
                        <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo get_the_title(); ?>" alt="">
                    </div>
                    <div class="categories">
                        <a href="http://" target="_blank" rel="noopener noreferrer">PDAX</a>
                        <a href="http://" target="_blank" rel="noopener noreferrer">ETH</a>
                        <a href="http://" target="_blank" rel="noopener noreferrer">Featured</a>
                    </div>
                    <h3>#YourNextMoneyMove - Get free BTC on your first trade.</h3>
                    <p class="author">Lorem Ipsum Dolor</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 co-md-6">
                <div class="content">
                    <div class="image">
                        <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo get_the_title(); ?>" alt="">
                    </div>
                    <div class="categories">
                        <a href="http://" target="_blank" rel="noopener noreferrer">PDAX</a>
                        <a href="http://" target="_blank" rel="noopener noreferrer">ETH</a>
                        <a href="http://" target="_blank" rel="noopener noreferrer">Featured</a>
                    </div>
                    <h3>#YourNextMoneyMove - Get free BTC on your first trade.</h3>
                    <p class="author">Lorem Ipsum Dolor</p>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
$categories = array('beginner-level', 'expert-level', 'intermediate-level');
$count = 0;
foreach ($categories as $category_slug) :

    $category = get_category_by_slug($category_slug);
    
    if ($category) :
        $categoryName = $category->cat_name;
        $category_link = get_category_link($category->term_id);
        $args = array(
            'category_name' => $category_slug,
            'posts_per_page' => 4,
            'post_status' => 'publish',
        );
        $category_query = new WP_Query($args);
        if ($category_query->have_posts()) :
?>
<section class="<?php echo strtolower(str_replace(' ', '_', $categoryName)); ?> template_blog">
    <div class="container-xxl">
        <div class="align-items-center <?php echo $count % 2 == 0 ? 'row-reverse' : 'row' ?>">
            <?php while ($category_query->have_posts()) : $category_query->the_post(); ?>
            <div class="col-12">
                <div class="header">
                    <div class="header_button"><?php echo $categoryName; ?> Blog</div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block <?php echo $count % 2 == 0 ? '' : 'ps-lg-4' ?>">
                <div class="content">
                    <div class="image">
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 <?php echo $count % 2 == 0 ? 'ps-lg-4' : '' ?>">
                <div class="content">
                    <div class="categories">
                        <a href="http://example.com" target="_blank" rel="noopener noreferrer">PDAX</a>
                        <a href="http://example.com" target="_blank" rel="noopener noreferrer">ETH</a>
                        <a href="http://example.com" target="_blank" rel="noopener noreferrer">Featured</a>
                    </div>
                    <h2><?php the_title(); ?></h2>
                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>" class="d-block d-lg-none">
                    <p class="description"><?php echo get_the_excerpt(); ?></p>
                    <p class="author"><?php the_author(); ?></p>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="row">
            <?php while ($category_query->have_posts()) : $category_query->the_post(); ?>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="content">
                    <div class="image">
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                    </div>
                    <div class="categories">
                        <a href="http://example.com" target="_blank" rel="noopener noreferrer">PDAX</a>
                        <a href="http://example.com" target="_blank" rel="noopener noreferrer">ETH</a>
                        <a href="http://example.com" target="_blank" rel="noopener noreferrer">Featured</a>
                    </div>
                    <h3><?php the_title(); ?></h3>
                    <p class="author"><?php the_author(); ?></p>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php
        endif;
        wp_reset_postdata();
        $count++;
    endif;
endforeach;
?>


<section class="exlplore_more_topics">
    <div class="container-xxl">
        <div class="row">
            <div class="header">
                <h2 class="text-center">Explore More Topics</h2>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="content">
                    <div class="main_content_header">
                            <div class="main_content_button">Tokens</div>
                        </div>
                    <div class="main_content">
                        <div class="image">
                            <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo get_the_title(); ?>" alt="">
                        </div>
                        <div class="content">
                            <div class="categories">
                                <a href="http://" target="_blank" rel="noopener noreferrer">PDAX</a>
                                <a href="http://" target="_blank" rel="noopener noreferrer">ETH</a>
                                <a href="http://" target="_blank" rel="noopener noreferrer">Featured</a>
                            </div>
                            <h3 class="title"><?php echo wp_trim_words($title,7);?></h3>
                            <p class="description">In a nutshell: An Ethereum exchange-traded fund (ETF) is an investment vehicle that tracks the price of Ethereum (ETH).<a href="http://" target="_blank" rel="noopener noreferrer" class="read_more">Read More</a></p>
                            <p class="author"><?php the_author(); ?></p>
                        </div>
                    </div>
                    <div class="small_content">
                        <div class="content">
                            <div class="image">
                                <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo get_the_title(); ?>" alt="">
                            </div>
                            <div class="recent_content">
                                <h4 class="title">PDAXScope: Bitcoin Tumbles Below $60K, Ether Under $3K</h4>
                            </div>
                        </div>
                        <div class="content">
                            <div class="image">
                                <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo get_the_title(); ?>" alt="">
                            </div>
                            <div class="recent_content">
                                <h4 class="title">PDAXScope: Bitcoin Tumbles Below $60K, Ether Under $3K</h4>
                            </div>
                        </div>
                        <div class="content">
                            <div class="image">
                                <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo get_the_title(); ?>" alt="">
                            </div>
                            <div class="recent_content">
                                <h4 class="title">PDAXScope: Bitcoin Tumbles Below $60K, Ether Under $3K</h4>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="who_need_all_the_clutter">
  <div class="container-xxl">
    <div class="row align-items-center">
      <div class="col-lg-5 mb-md-4">
        <div class="content">
          <h2 class="blue_font mb-4 text-capitalize">Who Needs All That Clutter</h2>
          <p class="p_font">For streamlined and hassle-free trading, look no further. Sign up for a PDAX account today. </p>
          <a href="https://go.pdax.ph/z7HU/wnsfdkqu" target="_blank" rel="noopener noreferrer" class="d-block">Create an Account</a>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="image">
          <img src="https://pdax.ph/wp-content/themes/pdax/assets/img/homepage-personal/last_section.png" alt="">
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>