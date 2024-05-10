<?php get_header();
/*Template Name: Brands*/
?>
<section class="brands">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <?php
                $product_categories = get_terms(array(
                    'taxonomy' => 'product_cat', // assuming 'product_cat' is the taxonomy for WooCommerce product categories
                    'hide_empty' => false, // set to true if you want to hide empty categories
                ));
                if ($product_categories && !is_wp_error($product_categories)) {
                    ?>
                   <?php 
                    foreach ($product_categories as $category) {
                        // Skip the "Uncategorized" category and move to the next iteration
                        if (esc_html($category->name) === "Uncategorized") {
                            continue;
                        }
                        $category_url = get_term_link($category);
                        if (!is_wp_error($category_url)) {

                            ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                                <div class="content position-relative d-flex flex-column align-items-center">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/brands/barnds.png" alt="" class="mb-4">
                                    <h5 class="text-center"><a href="<?php echo esc_url($category_url); ?>" rel="noopener noreferrer" class="stretched-link "></a><?php echo esc_html($category->name); ?></h5>
                                </div>
                            </div>
                            <?php
                        }
                    }
                } else {
                    echo 'No product categories found';
                }
                ?>
                 <div class="paging">
                    <nav class="pagination-container">
                        <button class="pagination-button" id="prev-button" aria-label="Previous page" title="Previous page">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/prev.png" alt="">
                        </button>

                        <div id="pagination-numbers">
                            
                        </div>

                        <button class="pagination-button" id="next-button" aria-label="Next page" title="Next page">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/next.png" alt="">
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
<script>
     function setupPagination() {
        const paginationNumbers = $("#pagination-numbers");
        const paginatedList = $("section.brands .row");
        const listItems = paginatedList.find(".col-xl-3 ");
        const nextButton = $("#next-button");
        const prevButton = $("#prev-button");

        const paginationLimit = 8;
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
    $(document).ready(function () {
        setupPagination();
    });
</script>