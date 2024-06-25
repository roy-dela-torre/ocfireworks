<?php $img = get_stylesheet_directory_uri().'/assets/img/homepage';?>
<!-- Wishlist modal -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary wishlist_modal_btn d-none" data-bs-toggle="modal" data-bs-target="#exampleModal" style="visibility: hidden;"></button>

<!-- Modal -->
<div class="product_added_to_wislist">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="product">
                    <img src="" alt="">
                    <div class="product_info">
                        <h5 class="text-uppercase">Added to wish list</h5>
                        <p class="product_name"></p>
                        <p class="price"></p>
                        <a href="<?php echo get_home_url(); ?>/wishlist/" class="view_wishlist" target="_blank">View wish List</a>
                    </div>
                </div>
                <div class="group_button">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <img src="<?php echo $img; ?>/close.png" alt="">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>