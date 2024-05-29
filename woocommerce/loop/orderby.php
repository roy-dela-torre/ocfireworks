<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$img = get_stylesheet_directory_uri().'/assets/img/homepage';
?>
 <div id="overlay">
	<div class="cv-spinner">
		<span class="spinner"></span>
	</div>
</div>
<form class="woocommerce-ordering" method="get">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="orderbyDropdown" data-bs-toggle="dropdown" aria-expanded="false" aria-label="<?php esc_attr_e('Shop order', 'woocommerce'); ?>">
            <?php
                echo isset($catalog_orderby_options[$orderby]) ? esc_html($catalog_orderby_options[$orderby]) : 'Select order';
            ?>
        </button>
        <ul class="dropdown-menu" aria-labelledby="orderbyDropdown">
            <?php foreach ($catalog_orderby_options as $id => $name) : ?>
				<li style="cursor: pointer" class="dropdown-item" onclick="setOrderBy('<?php echo esc_attr($id); ?>'); return false;"><?php echo esc_html($name); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <input type="hidden" name="orderby" id="orderbyInput" value="<?php echo esc_attr($orderby); ?>" />
    <input type="hidden" name="paged" value="1" />
    <?php wc_query_string_form_fields(null, ['orderby', 'submit', 'paged', 'product-page']); ?>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    <?php 
    function getCurrentUrl() {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $url = $scheme . '://' . $host . $requestUri;
        return $url;
    }
    ?>
	function setOrderBy(value) {
		event.preventDefault();
		$('#orderbyInput').val(value);
		$.ajax({
			url: "<?php echo getCurrentUrl(); ?>" + '?orderby=' + value,
			method: 'GET',
			beforeSend: function() {
				$("#overlay").show();
			},
			success: function(response) {
				$("#overlay").hide();
				
				const tempDiv = $('<div>').html(response);
				const newContent = tempDiv.find('section.product_main ul.products.row.columns-4').html();
				$('section.product_main ul.products.row.columns-4').html(newContent);
			},
			error: function(xhr, status, error) {
				$("#overlay").hide();
				console.error('Error:', error);
			}
		});
	}



    $(document).ready(function() {
        
        $(document).on('change', '#orderbyInput', function(event) {
            event.preventDefault(); 
            setOrderBy($(this).val()); 
        });
		$('li.dropdown-item').on('click', function(e) {
			var newText = $(this).text();
			$(this).closest('.dropdown').find('.btn').text(newText);
		});
    });
</script>