<?php get_header();
/*Template Name: Mini cart*/
?>
<div class="mini_cart_main_container">
    <svg xmlns="http://www.w3.org/2000/svg" width="82" height="39" viewBox="0 0 82 39" fill="none">
        <path d="M41 0L81.7032 39H0.296806L41 0Z" fill="white" />
    </svg>
    <div class="mini_cart d-block position-relative">
        <?php echo woocommerce_mini_cart(); ?>
    </div>
</div>
<?php
get_footer(); ?>