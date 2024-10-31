<?php get_header();
/*Template Name: Wishlist*/
?>
<section class="wishlist">
    <div class="container-fluid">
        <div class="wrapper">
            <?php echo do_shortcode('[yith_wcwl_wishlist]')?>
        </div>
    </div>
</section>
<?php get_footer(); ?>
<script>
    function setupPagination() {
        const paginationNumbers = $("#pagination-numbers");
        paginationNumbers.empty(); // Clear existing pagination numbers

        const paginatedList = $("section.wishlist .row");
        const listItems = paginatedList.find(".col-lg-3 ");
        const nextButton = $("#next-button");
        const prevButton = $("#prev-button");

        const paginationLimit = 4;
        const pageCount = Math.ceil(listItems.length / paginationLimit);
        let currentPage = 1;

        const disableButton = (button) => {
            button.addClass("disabled");
            button.attr("disabled", true);
        };

        const enableButton = (button) => {
            button.removeClass("disabled");
            button.removeAttr("disabled");
        };

        const handlePageButtonsStatus = () => {
            if (currentPage === 1) {
                disableButton(prevButton);
            } else {
                enableButton(prevButton);
            }

            if (pageCount === currentPage) {
                disableButton(nextButton);
            } else {
                enableButton(nextButton);
            }
        };

        const handleActivePageNumber = () => {
            $(".pagination-number").removeClass("active").each(function() {
                const pageIndex = Number($(this).attr("page-index"));
                if (pageIndex === currentPage) {
                    $(this).addClass("active");
                }
            });
        };

        const appendPageNumber = (index) => {
            const pageNumber = $("<button></button>").addClass("pagination-number").html(index).attr("page-index", index).attr("aria-label", "Page " + index);
            paginationNumbers.append(pageNumber);
        };

        const getPaginationNumbers = () => {
            for (let i = 1; i <= pageCount; i++) {
                appendPageNumber(i);
            }
        };

        const setCurrentPage = (pageNum) => {
            currentPage = pageNum;

            handleActivePageNumber();
            handlePageButtonsStatus();

            const prevRange = (pageNum - 1) * paginationLimit;
            const currRange = pageNum * paginationLimit;

            listItems.hide().slice(prevRange, currRange).show();
        };

        getPaginationNumbers();
        setCurrentPage(1);

        prevButton.on("click", function() {
            setCurrentPage(currentPage - 1);
        });

        nextButton.on("click", function() {
            setCurrentPage(currentPage + 1);
        });

        $(document).on("click", ".pagination-number", function() {
            setCurrentPage(parseInt($(this).attr("page-index")));
        });
        console.log('function run again')
    }
$(document).ready(function() {
    setupPagination();
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
                link.closest('.col-lg-3').remove();
                var rowSelector = "section.wishlist .row"; // Replace with your row's selector (e.g., "#example tbody tr")
                var row = $(rowSelector);
                if ($('section.wishlist .product_column').length === 0) {
                    // Reload the page
                    location.reload();
                    
                }
                setupPagination();
            },
            error: function(xhr, status, error) {
                // Handle error, e.g., display an error message
                console.error('Error removing product from wishlist:', error);
            }
        });
        if ($('section.wishlist .product_column').length <= 4) {
            $('nav.pagination-container').hide()
        }
    });
    if ($('section.wishlist .product_column').length <= 4) {
        $('nav.pagination-container').hide()
    }
    
    $('#prev-button,#next-button,button.pagination-number').click(function(event) {
        event.preventDefault(); // Prevent the default behavior
        // Your logic for handling previous button click goes here
    });
});
</script>
