<section class="product_video p-0">
  <!--Video Modal -->
  <button type="button" class="btn btn-primary d-none video_modal" data-bs-toggle="modal" data-bs-target="#video_modal">
  </button>

  <div class="modal fade" id="video_modal" tabindex="-1" aria-labelledby="video_modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5 text-white" id="video_modalLabel">Modal title</h3>
        </div>
        <div class="modal-body">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/video_thumbnail.jpg" alt="" class="video_thumbnail">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/global/play.png" alt="" class="play_button">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close video</button>
        </div>
      </div>
    </div>
  </div>
</section>