<?php $img = get_stylesheet_directory_uri().'/assets/img/homepage'; ?>
<section class="brands px-0">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h2 class="text-center"><?php echo $title?></h2>
            <div class="owl-carousel owl-theme p-0" id="brands">
                <?php for($i=1;$i<=10;$i++){ ?>
                    <img src="<?php echo $img; ?>/logo<?php echo $i; ?>.png" alt="" width="186" height="186">
                <?php }?>
            </div>
            <a href="<?php echo get_home_url(); ?>/brands" target="_blank" rel="noopener noreferrer" class="view_all red_button">View All</a>
        </div>
    </div>
</section>
<style>
    section.brands h2 {
        margin-bottom: 50px;
    }

    section.brands #brands {
        margin-bottom: 50px;
    }
</style>