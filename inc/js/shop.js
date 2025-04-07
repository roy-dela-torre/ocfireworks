$(document).ready(function () {
    // Handle category click event
    var data_url = []
    $('#categores li').click(function () {
        const slug = $(this).find('a').attr('data-url'); // Get the slug
        // Check if the slug is already in the array
        if (data_url.includes(slug)) {
            // If the slug exists, remove it from the array
            const index = data_url.indexOf(slug);
            data_url.splice(index, 1); // Removes the element at the specified index
            data_url = data_url.filter(item => item !== undefined);
        } else {
            // If the slug is not in the array, add it
            data_url.push(slug);
        }
        console.log(data_url)
        const ajax_url = `${window.location.origin}${window.location.pathname}?brands=${data_url}`; // Construct the URL
        console.log(ajax_url)
        $.ajax({
            url: ajax_url,
            method: 'GET',
            beforeSend: () => $('#overlay').show(),
            success: (response) => {
                // Update product list with the response
                $('.product_list').html($(response).find('.product_list').html());
                $('#overlay').hide();
                updatePagination();
            },
            error: () => {
                $('#overlay').hide();
                alert('Failed to load products. Please try again.');
            },
        });

        // Toggle checkbox state and trigger first category click if checked
        $(this).find('input[type="checkbox"]').prop('checked', (i, val) => {
            return !val;
        });
    });

    // Update pagination with images
    const updatePagination = () => {
        setTimeout(() => {
            const next = $('<img>', {
                src: `${window.location.origin}/wp-content/themes/ocfireworks/assets/img/search/next.png`,
                alt: 'Next',
            });
            const prev = $('<img>', {
                src: `${window.location.origin}/wp-content/themes/ocfireworks/assets/img/search/prev.png`,
                alt: 'Previous',
            });
            $('a.next.page-numbers').html(next);
            $('a.prev.page-numbers').html(prev);
        }, 2000);
    };

    // Update pagination when price input changes
    $('#min-price, #max-price').on('input change', updatePagination);
});