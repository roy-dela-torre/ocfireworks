<?php get_header();
/*Template Name: My Account*/
$imgPath = get_stylesheet_directory_uri() . '/assets/img/homepage/'; ?>
<?php if (is_user_logged_in()) : ?>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/my_account.css">
  <section class="my_account">
    <div class="wrapper">
      <div class="container-fluid">
        <?php echo do_shortcode('[woocommerce_my_account]'); ?>
      </div>
    </div>
  </section>
<?php else : ?>
  <?php echo do_shortcode('[woocommerce_my_account]'); ?>
<?php endif; ?>
<?php get_footer(); ?>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<script>
  $(document).ready(function() {
    $('button.clear_message').click(function(event) {
      console.log('hahahah')
      event.preventDefault()
      $('form.om-messenger-sending-form textarea').val('').change()
    })

    $('button.button[name="save_address"]').click(function() {
      $('section.my_account .woocommerce-MyAccount-content form').submit()
    })
    $('#order_content_desktop').DataTable({
      
    });

    $('#order_content_mobile').DataTable({
    });

    $(".row.mt-2.justify-content-between:not(.dt-layout-table)").remove()
  })
</script>