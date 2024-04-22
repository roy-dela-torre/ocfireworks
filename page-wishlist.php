<?php get_header();
/*Template Name: Wishlist*/
?>
<style>
    /* ajax loading spinner */

.wishlist #overlay {
    position: fixed;
    top: 0;
    z-index: 100;
    width: 100%;
    height: 100%;
    display: none;
    background: rgba(0, 0, 0, 0.6);
    left: 0;
}

.wishlist .cv-spinner {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.wishlist .spinner {
    width: 40px;
    height: 40px;
    border: 4px #ddd solid;
    border-top: 4px #2e93e6 solid;
    border-radius: 50%;
    animation: sp-anime 0.8s infinite linear;
}

@keyframes sp-anime {
    100% {
        transform: rotate(360deg);
    }
}

.wishlist .is-hide {
    display: none;
}

</style>
<section class="wishlist">
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
    <div class="container-fluid">
        <div class="wrapper">
            <?php echo do_shortcode('[yith_wcwl_wishlist]')?>
        </div>
    </div>
</section>
<?php get_footer(); ?>
<script>
$(document).ready(function() {
    $('.remove_from_wishlist').on('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior
        var link = $(this);
        var url = link.attr('href');
        $.ajax({
            url: url, // Use the URL from the link
            method: 'GET', // Make a GET request (since the link is a GET request)
            beforeSend: function(xhr) {
                $("#overlay").show();
            },
            success: function(response) {
                $("#overlay").hide();
                // Find the closest col-md-3 element containing the content element and remove it
                link.closest('.col-md-3').remove();
                var rowSelector = "section.wishlist .row"; // Replace with your row's selector (e.g., "#example tbody tr")
                var row = $(rowSelector);
                if (row.length && row.children().length === 0) {
                    // Reload the page
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                // Handle error, e.g., display an error message
                console.error('Error removing product from wishlist:', error);
            }
        });
    });
});
</script>
