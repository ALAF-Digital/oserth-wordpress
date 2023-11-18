<?php 
// Include and instantiate the class.
require_once 'Mobile_Detect.php';

function woo_scripts() {
	
	wp_dequeue_style( 'wooajaxcart' );
	wp_deregister_style( 'wooajaxcart' );
	
	wp_dequeue_style( 'tinvwl' );
	wp_deregister_style( 'tinvwl' );

	wp_dequeue_style( 'tinvwl-webfont' );
	wp_deregister_style( 'tinvwl-webfont' );

	wp_dequeue_style( 'wc-blocks' );
	wp_deregister_style( 'wc-blocks' );

	wp_dequeue_style( 'font-awesome' );
	wp_deregister_style( 'font-awesome' );

	wp_dequeue_style( 'wp-block-library-theme-inline' );
	wp_deregister_style( 'wp-block-library-theme-inline' );

	wp_dequeue_style( 'berocket_aapf_widget-style' );
	wp_deregister_style( 'berocket_aapf_widget-style' );


	wp_dequeue_style( 'woo-address-book' );
	wp_deregister_style( 'woo-address-book' );

	wp_dequeue_style( 'newsletter' );
	wp_deregister_style( 'newsletter' );

	wp_dequeue_style( 'woocommerce-general' );
	wp_deregister_style( 'woocommerce-general' );

	wp_dequeue_style( 'woocommerce-layout' );
	wp_deregister_style( 'woocommerce-layout' );

	wp_dequeue_style( 'woocommerce-smallscreen' );
	wp_deregister_style( 'woocommerce-smallscreen' );


	wp_enqueue_style('product-style', get_stylesheet_directory_uri().'/woocommerce/inc/css/product.css', true, '1.7', 'all' ); 
	wp_enqueue_style('common-style', get_stylesheet_directory_uri().'/woocommerce/inc/css/woo-common.css', true, '1.7', 'all' );  

	wp_enqueue_script('woo-custom', get_stylesheet_directory_uri() .'/woocommerce/inc/js/woo-custom.js', array('jquery'), '20150825', true);

	if(is_cart()){
		wp_enqueue_style('cart-style', get_stylesheet_directory_uri().'/woocommerce/inc/css/cart.css', true, '1.7', 'all' ); 
		
	}else if(is_checkout()){
		
		wp_enqueue_style('checkout-style', get_stylesheet_directory_uri().'/woocommerce/inc/css/checkout.css', true, '1.11', 'all' ); 
	}else if(is_shop() || is_archive()){
		
		wp_enqueue_style('product-listting', get_stylesheet_directory_uri().'/woocommerce/inc/css/product-listting.css', true, '1.14', 'all' ); 
	}else if(is_product()){
		
		wp_enqueue_style('product-detail', get_stylesheet_directory_uri().'/woocommerce/inc/css/product-detail.css', true, '1.11', 'all' ); 
	}else if(is_account_page()){

		wp_enqueue_style('myaccount-style', get_stylesheet_directory_uri().'/woocommerce/inc/css/myaccount.css', true, '1.32', 'all' ); 

	}else{
	}


}

add_action('wp_enqueue_scripts', 'woo_scripts');

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title'  => 'WooCommerce Theme Settings',
		'menu_title'  => 'WooCommerce Theme Settings',
		'menu_slug'   => 'woocommerce-theme-settings',
		'capability'  => 'edit_posts',
		'redirect'    => true
	));


}

add_action( 'after_setup_theme', 'project_setup' );
function project_setup() {
	add_image_size( 'product-thumbnail', 261, 229, true );

}

function wc_disable_select2() {
	if ( class_exists('woocommerce') ) {
		wp_dequeue_style('select2');
		wp_deregister_style('select2');

		// WooCommerce 3.2.1.x and below
		wp_dequeue_script('select2');
		wp_deregister_script('select2');

		// WooCommerce 3.2.1+
		wp_dequeue_script('selectWoo');
		wp_deregister_script('selectWoo');
	} 
}

add_action('wp_enqueue_scripts', 'wc_disable_select2', 100);


global $wp;
$request = explode( '/', $wp->request );

// If NOT in My account dashboard page
if( ! ( end($request) == 'my-account' && is_account_page() ) ){ 
	//show_admin_bar(false);
}



if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : 

	include('functions/register/woocommerce-enable-myaccount-registration.php');

else:
	include('functions/register/single-register-form-extra-fields.php');

endif;


include('functions/quanity-field-style.php');

include('functions/price.php');
include('functions/product-single.php');
include('functions/product-archive.php');
include('functions/my-account.php');
include('functions/cart.php');
include('functions/checkout.php');


include('functions/update-left-nav.php');
add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );

function iconic_cart_count_fragments( $fragments ) {

	$fragments['strong.item-count'] = '<strong class="item-count">' . WC()->cart->get_cart_contents_count() . '</strong>';

	return $fragments;

}


// First remove default wrapper
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Then add new wrappers
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
	echo '<div class="woocommerce">';
}

function my_theme_wrapper_end() {
	echo '</div>';
}

// Translate "You may also like..." - WooCommerce Single Product
function custom_related_products_text( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'Add a review' :
		$translated_text = __( 'Write a Review', 'woocommerce' );
		break;

		case 'Order received' :
		$translated_text = __( 'Order placed', 'woocommerce' );
		break;

		case 'Proceed to Telr' :
		$translated_text = __( 'Pay Now', 'woocommerce' );
		break;  

		case 'Cart totals' :
		$translated_text = __( 'Cart Total', 'woocommerce' );

		break;
		//	case 'Related products' :
		//	$translated_text = __( 'You may also like', 'woocommerce' );

		//	break;
		case '<div class="ivole-vote-button">Yes</div>' :
		$translated_text = __( '<div class="ivole-vote-button">Like</div>', 'woocommerce' );

		break;

		case '<div class="ivole-vote-button">No</div>' :
		$translated_text = __( '<div class="ivole-vote-button">Dislike</div>', 'woocommerce' );

		break;

	}
	return $translated_text;
}
add_filter( 'gettext', 'custom_related_products_text', 20, 3 );




/*add_filter( 'woocommerce_get_breadcrumb', function($crumbs, $Breadcrumb){

	$shop_page_id = wc_get_page_id('shop'); //Get the shop page ID
	if($shop_page_id > 0 && !is_shop()) { //Check we got an ID (shop page is set). Added check for is_shop to prevent Home / Shop / Shop as suggested in comments
		$new_breadcrumb = [
			_x( 'Shop', 'breadcrumb', 'woocommerce' ), //Title
			get_permalink(wc_get_page_id('shop')) // URL
		];
		array_splice($crumbs, 0, 0, [$new_breadcrumb]); //Insert a new breadcrumb after the 'Home' crumb
	}
	return $crumbs;
}, 10, 2 );  */ 

/**
 * Change several of the breadcrumb defaults
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
	return array(
		'delimiter'   => '<span class="delimiter"> / </span>',
		'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><div class="container">',
		'wrap_after'  => '</div></nav>',
		'before'      => '<span>',
		'after'       => '</span>',
		'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ).'',
	);
}

/*add_filter('woocommerce_breadcrumb_defaults', function( $defaults ) {
	unset($defaults['home']); //removes home link.
	return $defaults; //returns rest of links
});*/



// filter structured data price to match tax settings
function filter_woocommerce_structured_data_product_offer( $markup_offer, $product ) { //echo "<pre>"; print_r($markup_offer); echo "</pre>";
	$price_incl_tax = wc_get_price_including_tax( $product ); // price with VAT
	$regular_price = wc_get_price_including_tax($product,array('price'=>$product->get_regular_price())) ;
	$markup_offer['price'] = $price_incl_tax;
	$markup_offer['priceSpecification']['price'] =   $regular_price; // price with VAT;
	$markup_offer['priceSpecification']['valueAddedTaxIncluded'] = 'true';
	return $markup_offer;
};
add_filter( 'woocommerce_structured_data_product_offer', 'filter_woocommerce_structured_data_product_offer', 10, 2 );

add_filter( 'woocommerce_shortcode_products_query', 'extend_products_shortcode_to_certificates', 10, 3 );
function extend_products_shortcode_to_certificates( $query_args, $atts, $loop_name ){
	if ( (! empty($atts['class']) && strpos($atts['class'], 'certificates') !== false) ||  ! empty($atts['class']) && strpos($atts['class'], 'main_category') !== false ) {
		global $wpdb;
		$terms = array_map( 'sanitize_title', explode( ',', $atts['class'] ) );
		array_shift( $terms );
		$terms = implode(',', $terms);
		$terms = str_replace(",", "','", $terms);

		$ids = $wpdb->get_col( "
			SELECT DISTINCT tr.object_id
			FROM {$wpdb->prefix}term_relationships as tr
			INNER JOIN {$wpdb->prefix}term_taxonomy as tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
			INNER JOIN {$wpdb->prefix}terms as t ON tt.term_id = t.term_id
			WHERE tt.taxonomy LIKE 'certificates' AND t.slug IN ('$terms')
			" );

		if ( ! empty( $ids ) ) {
			if ( 1 === count( $ids ) ) {
				$query_args['p'] = $ids[0];
			} else {
				$query_args['post__in'] = $ids;
			}
		}

	}


	//echo "<pre>"; print_r($query_args); echo "</pre>";
	return $query_args;
}




function myscript() {
	?>
	<script>
		setTimeout(function() {
			jQuery('.woocommerce-message').fadeOut('fast');
		}, 5000); 
	</script>
	<?php
}
add_action('wp_footer', 'myscript');



function certificates_taxonomy_columns( $columns ){


	$columns = array(
		'cb' => '<input type="checkbox" />',
		'certificate_logo' => __('Thumbnail'),
		'name' => __('Name'),
		'slug' => __('Slug'),
		'posts' => __('Posts')
	);



	return $columns;
}
add_filter('manage_edit-certificates_columns' , 'certificates_taxonomy_columns');

function certificates_taxonomy_columns_content( $content, $column_name, $term_id ){
	$term = get_term_by('id', $term_id, 'certificates'); 

	switch ($column_name) { 

		case 'certificate_logo': 

		$certificate_logo = get_field('certificate_logo', $term);

		$out .= "<img src=\"{$certificate_logo}\" height=\"83\"/>"; 
		break;

		default:
		break;
	}
	return $out;   


}
add_filter( 'manage_certificates_custom_column', 'certificates_taxonomy_columns_content', 10, 3 );




function get_best_selling_products( $limit = '-1' ){
	global $wpdb;

	$limit_clause = intval($limit) <= 0 ? '' : 'LIMIT '. intval($limit);
	$curent_month = date('Y-m-01 00:00:00');

	return (array) $wpdb->get_results("
		SELECT p.ID as id, COUNT(oim2.meta_value) as count
		FROM {$wpdb->prefix}posts p
		INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta oim
		ON p.ID = oim.meta_value
		INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta oim2
		ON oim.order_item_id = oim2.order_item_id
		INNER JOIN {$wpdb->prefix}woocommerce_order_items oi
		ON oim.order_item_id = oi.order_item_id
		INNER JOIN {$wpdb->prefix}posts as o
		ON o.ID = oi.order_id
		WHERE p.post_type = 'product'
		AND p.post_status = 'publish'
		AND o.post_status IN ('wc-processing','wc-completed')
		AND o.post_date >= '$curent_month'
		AND oim.meta_key = '_product_id'
		AND oim2.meta_key = '_qty'
		GROUP BY p.ID
		ORDER BY COUNT(oim2.meta_value) + 0 DESC
		$limit_clause
		");
}



add_action( 'pre_get_posts', 'product_search_woocommerce_only' );

function product_search_woocommerce_only( $query ) {
	if( ! is_admin() && is_search() && $query->is_main_query() ) {
		$query->set( 'post_type', 'product' );
	}
}
