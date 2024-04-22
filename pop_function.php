<?php $img = get_stylesheet_directory_uri().'/assets/img/homepage';?>
function replaceIcons(element, imgUrl) {
		console.log('icon replace')
		element.html(`<img src="${imgUrl}" alt="">`);
	}
function handleProductColumns(columns) {
    columns.each(function() {
        $(this).find('.yith-wcwl-add-button img').on('click', function() {
            $('.wishlist_modal_btn').trigger('click');
            updateWishlistModal($(this));
        });
    });
}
function updateWishlistModal(button) {
    var contentContainer = button.closest('.product_content');
    var productName = contentContainer.find('h3.text-center').text();
    var productPrice = contentContainer.find('.price').text();
    var productImage = contentContainer.find('.product_image img').attr('src');
    $('.product_added_to_wislist .product img').attr('src', productImage);
    $('.product_added_to_wislist p.product_name').text(productName);
    $('.product_added_to_wislist p.price').text(productPrice);
}
$('.yith-wcwl-wishlistexistsbrowse').hide();
replaceIcons($('i.yith-wcwl-icon.fa.fa-heart-o'), '<?php echo $img; ?>/add_to_wishlist.png');
replaceIcons($('section.product_main .yith-wcwl-add-to-wishlist.exists.wishlist-fragment.on-first-load'), '<?php echo $img; ?>/added_to_wishlist.png');
handleProductColumns($('section.product_main .row .product_column'));
$('button.btn-close').click(function() {
    console.log('click')
    setTimeout(() => {
        $('section.product_main a[data-title="Browse wishlist"]').html(`<img src="<?php echo $img; ?>/added_to_wishlist.png" alt="">`)
    }, 1000);
});