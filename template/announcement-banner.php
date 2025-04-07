<?php
/*Template Name: Announcement Banner*/
?>
<section class="brands">
    <div class="container-fluid">
        <div class="wrapper">
            <div class="row justify-content-center">
                <div class="header">
                    <h2 class="text-center mb-3">Announcement</h2>
                </div>
                <div class="owl-carousel owl-theme p-0" id="brands">
                    <?php
                    // Get the gallery field (array of images) from ACF
                    $Onecarousel_images = get_field('announce_banner', 12763);

                    if ($Onecarousel_images && is_array($Onecarousel_images)): // Check if there are any images
                        $x = 1; // Initialize a counter variable
                        foreach ($Onecarousel_images as $image): // Loop through the images
                            $galleryimage_fullOne = $image['url']; // THE URL OF THE IMAGE
                    ?>
                            <img src="<?php echo esc_url($galleryimage_fullOne); ?>" class="w-100" alt="Brand Image <?php echo $x; ?>" style="padding: 0;">
                    <?php
                            $x++;
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>