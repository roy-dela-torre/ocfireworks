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
$catalog_orderby_options = array(
    'default' => 'Select order',
    'date' => 'Sort by latest',
    'price' => 'Sort by price: low to high',
    'price-desc' => 'Sort by price: high to low',
    'rand' => 'Sort by random order',
    // Add other orderby options here as needed
);
?>
 <div id="overlay">
	<div class="cv-spinner">
		<span class="spinner"></span>
	</div>
</div>
<form class="woocommerce-ordering" method="get">
    <div class="dropdown">
		<span>Sort by:</span>
        <button class="btn btn-secondary dropdown-toggle" type="button" id="orderbyDropdown" data-bs-toggle="dropdown" aria-expanded="false" aria-label="<?php esc_attr_e('Shop order', 'woocommerce'); ?>">
            <?php
                echo isset($catalog_orderby_options[$orderby]) ? esc_html($catalog_orderby_options[$orderby]) : 'Select order';
            ?>
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
				<path d="M11.9831 16.5C11.7201 16.4981 11.4603 16.4426 11.2195 16.3369C10.9788 16.2312 10.7622 16.0776 10.5831 15.8854L5.25311 10.1972C5.0796 10.0028 4.98914 9.74835 5.00104 9.48827C5.01294 9.2282 5.12625 8.98306 5.31679 8.80519C5.50733 8.62732 5.76001 8.5308 6.02089 8.53624C6.28177 8.54167 6.53018 8.64864 6.71311 8.8343L11.9831 14.4626L17.2531 8.8343C17.3418 8.73488 17.4496 8.65418 17.57 8.59695C17.6904 8.53972 17.8211 8.50711 17.9544 8.50104C18.0877 8.49497 18.2208 8.51557 18.346 8.56161C18.4711 8.60766 18.5858 8.67823 18.6832 8.76917C18.7806 8.86011 18.8588 8.96957 18.9132 9.09112C18.9676 9.21266 18.997 9.34383 18.9998 9.47691C19.0026 9.60998 18.9786 9.74226 18.9294 9.86597C18.8802 9.98968 18.8066 10.1023 18.7131 10.1972L13.3871 15.8844C13.2076 16.0772 12.9905 16.2313 12.749 16.3372C12.5075 16.4431 12.2469 16.4985 11.9831 16.5Z" fill="#212121"/>
			</svg>
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
                $('#orderbyDropdown').append(`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
				<path d="M11.9831 16.5C11.7201 16.4981 11.4603 16.4426 11.2195 16.3369C10.9788 16.2312 10.7622 16.0776 10.5831 15.8854L5.25311 10.1972C5.0796 10.0028 4.98914 9.74835 5.00104 9.48827C5.01294 9.2282 5.12625 8.98306 5.31679 8.80519C5.50733 8.62732 5.76001 8.5308 6.02089 8.53624C6.28177 8.54167 6.53018 8.64864 6.71311 8.8343L11.9831 14.4626L17.2531 8.8343C17.3418 8.73488 17.4496 8.65418 17.57 8.59695C17.6904 8.53972 17.8211 8.50711 17.9544 8.50104C18.0877 8.49497 18.2208 8.51557 18.346 8.56161C18.4711 8.60766 18.5858 8.67823 18.6832 8.76917C18.7806 8.86011 18.8588 8.96957 18.9132 9.09112C18.9676 9.21266 18.997 9.34383 18.9998 9.47691C19.0026 9.60998 18.9786 9.74226 18.9294 9.86597C18.8802 9.98968 18.8066 10.1023 18.7131 10.1972L13.3871 15.8844C13.2076 16.0772 12.9905 16.2313 12.749 16.3372C12.5075 16.4431 12.2469 16.4985 11.9831 16.5Z" fill="#212121"/>
			</svg>`)
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