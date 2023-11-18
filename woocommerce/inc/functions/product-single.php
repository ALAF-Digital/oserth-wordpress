<?php

//remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0); 
//add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 4, 0); //Change breadcrumb position


/*-----woocommerce_single_product_summary----*/

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 ); //remove star rating
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 4,2 );//change star rating position
add_action( 'woocommerce_single_product_summary', 'display_brand_before_title', 4 ); // add content before product title
add_action( 'woocommerce_single_product_summary', 'custom_action_after_single_product_title', 6 ); // content after title
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);//remove excerpt
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 ); //remove meta content
//add_action( 'woocommerce_single_product_summary', 'bbloomer_show_return_policy', 20 );//Add Custom Content Before 'Add To Cart' Button On Product Page
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );//Remove related products output
add_action( 'woocommerce_after_single_product_summary', 'product_custom_content', 10);//add custom text after tab
//add_action( 'woocommerce_after_single_product_summary', '_show_reviews', 15 );//show Review
// add_action( 'woocommerce_before_single_product_summary', 'woocommerce_get_availability', 5);//change stock html position
add_filter( 'woocommerce_get_availability', 'custom_get_availability', 1, 2);

/*-----woocommerce_single_product_summary----*/


/*------------Gallery Starts-----------*/

//add_filter('woocommerce_single_product_image_thumbnail_html', 'remove_featured_image', 10, 2); //Remove Fetured Image from gallery
//add_action( 'woocommerce_before_single_product_summary', 'add_above_wc_product_image' );//add content above image gallery

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );// Remove image from product pages
add_action( 'woocommerce_before_single_product_summary' , 'my_custom_gallery', 30 );//Customize Gallery

//add_action( 'woocommerce_before_single_product_summary' , 'after_thumbnail', 30 );//Content after gallery

/*------------Gallery Starts-----------*/


/*------------Tab Starts-----------*/

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );// Remove the tabs
//add_filter( 'woocommerce_product_tabs', 'customize_additional_information', 98 );// Add custom info to Additional Information product tab
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' ); // Add New tab in the tab list
add_filter( 'woocommerce_product_tabs', 'reorder_tabs', 98); // reorder the tabs
add_filter( 'woocommerce_product_description_heading', '__return_null' );//Remove "Description" Heading Title @ WooCommerce Single Product Tabs
add_filter( 'woocommerce_product_description_tab_title', 'rename_description_product_tab_label' );//Rename Description Product Tab Label @ WooCommerce Single Product

/*------------Tab Ends-----------*/



/*------------Ajax add to cart Start-----------*/

add_action('wp_enqueue_scripts', 'ql_woocommerce_ajax_add_to_cart_js');// enqueue ajax add to cart script
add_action('wp_ajax_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart'); //ajax add to cart
add_action('wp_ajax_nopriv_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart'); //ajax add to cart

/*------------Ajax add to cart Ends-----------*/




/*------------Variant Dropdown Starts-----------*/

//add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'cinchws_filter_dropdown_args', 10 );//change choose an option text in variant dropdown 
add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'filter_dropdown_option_html_remove', 12, 2 );// Removing choose an option option completelly**:
add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'filter_dropdown_option_html_none', 12, 2 );// Remove only the text "Select an option" (you will have an option without label name):

/*------------Variant Dropdown Ends-----------*/



add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); // To change add to cart text on single product page
add_action( 'woocommerce_after_add_to_cart_button', 'add_content_after_addtocart_button_func' , 40 );//add content after add to cart button

add_action('woocommerce_share', 'woocommerce_share',50);//social share

add_filter( 'woocommerce_products_general_settings', 'woocommerce_weight_unit' );//change weight unit
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );//Change Related Product posts per page


function custom_get_availability( $availability, $_product ) {

	// Change In Stock Text
	if ( $_product->is_in_stock() ) {
		$availability['availability'] = __('', 'woocommerce');
	}
	// Change Out of Stock Text
	if ( ! $_product->is_in_stock() ) {
		$availability['availability'] = __('Sold Out', 'woocommerce');
	}
	return $availability;
}




function add_above_wc_product_image() { 
	echo do_shortcode('[ti_wishlists_addtowishlist loop=yes]');
}

function display_brand_before_title(){
	global $product;
	$product_id = $product->get_id();
	$taxonomy_exist = taxonomy_exists( 'brands' );
	if($taxonomy_exist ==  true){
		$brands = wp_get_post_terms( $product_id, 'brands' ); 
		if(isset($brands) && !empty($brands)){
			foreach( $brands as $brand ){
				echo '<a href="'.get_term_link($brand).'" class="category uppercase is-smaller no-text-overflow product-cat op-7">';
				echo $brand->name;
				echo '</a>';
			}
		}
	}
}


function woocommerce_custom_single_add_to_cart_text() {
	return __( 'Quick Buy', 'woocommerce' ); 
}

function woocommerce_share(){
	global $product;

	?>
	<div class="share-box">
		<ul>
			<li><span class="shipping-icon"></span>Free Shipping Over AED 250</li>
			<li><span class="creditcard-icon"></span>Credit Card Accepted</li>
		</ul>
	</div>

<?php }


function after_thumbnail() {
	global $post;
	$certificates = wp_get_post_terms( $post->ID, 'certificates', array( 'fields' => 'all' ) ); //print_r($certificates);
	echo '<div class="certificates"><ul>';
	foreach ($certificates as $key => $value) {
		echo '<li><img src="'.get_field('certificate_logo', $value).'" alt="'.$value->name.'"  /><span>'.$value->name.'</span></li>';
	}
	echo '</ul></div>';



}


function remove_featured_image($html, $attachment_id ) {
	global $post, $product;

	$featured_image = get_post_thumbnail_id( $post->ID );

	if ( $attachment_id == $featured_image )
		$html = '';

	return $html;
}




function my_custom_gallery() {

	global $post, $product;

	//echo "<pre>"; print_r( $product);echo "</pre>"; 
	?>


	<div id="slider" class="flexslider">

		<ul class="slides">

			<?php 

			$i=0;

			$featured_imageId = get_post_thumbnail_id( $post->ID );
			if($featured_imageId!=''){

				$featuredimage_link = wp_get_attachment_url( $featured_imageId );
				$i= $i+1;
				?>
				<li>
					<a data-fancybox="gallery" href="<?php echo $featuredimage_link; ?>"  data-thumb="<?php echo wp_get_attachment_image_url( $featured_imageId, 'thumbnail');  ?>" data-index="<?php echo $i; ?>">
						<img class="shop-product__image" src="<?php echo get_stylesheet_directory_uri(); ?>/woocommerce/inc/images/holder1.png" style="background: url(<?php echo $featuredimage_link; ?>); background-size: cover !important;" data-src="<?php echo $featuredimage_link; ?>">
					</a>
				</li>
				<?php 

			}else{
				?>
				<li>
					<a data-fancybox="gallery" href="javascript:;" data-index="<?php echo $i; ?>">
						<img class="shop-product__image" src="<?php echo get_stylesheet_directory_uri(); ?>/woocommerce/inc/images/holder1.png" style="background: url(<?php echo get_stylesheet_directory_uri(); ?>/woocommerce/inc/images/no-image-icon.jpg); background-size: cover !important;" data-src="<?php echo get_stylesheet_directory_uri(); ?>/woocommerce/inc/images/no-image-icon.jpg">
					</a>
				</li>
				<?php

			}

			$attachment_ids = $product->get_gallery_image_ids();
			if($attachment_ids){

				foreach( $attachment_ids as $attachment_id ) {
					$image_link = wp_get_attachment_url( $attachment_id );
					$i= $i+1;
					?>
					<li>
						<a data-fancybox="gallery" href="<?php echo $image_link; ?>"  data-thumb="<?php echo wp_get_attachment_image_url( $attachment_id, 'thumbnail');  ?>" data-index="<?php echo $i; ?>">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/woocommerce/inc/images/holder1.png" style="background: url(<?php echo $image_link; ?>); background-size: cover !important;" data-src="<?php echo $image_link; ?>">
						</a>
					</li>
				<?php  } 
			} ?>
		</ul>

	</div>




	<?php 
	$i=0; if($attachment_ids){ ?> 
		<div id="carousel" class="flexslider">
			<ul class="slides">
				<?php 
				$featured_imageId = get_post_thumbnail_id( $post->ID );
				if($featured_imageId!=''){

					$featuredimage_link = wp_get_attachment_url( $featured_imageId );
					$i= $i+1;
					?>
					<li>
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/woocommerce/inc/images/holder1.png" style="background: url(<?php echo $featuredimage_link; ?>); background-size: cover !important;" data-src="<?php echo $featuredimage_link; ?>">
					</li>
					<?php 

				}




				foreach( $attachment_ids as $attachment_id ) {
					$image_link = wp_get_attachment_url( $attachment_id );
					$i= $i+1;
					?>
					<li>
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/woocommerce/inc/images/holder1.png" style="background: url(<?php echo $image_link; ?>); background-size: cover !important;" data-src="<?php echo $image_link; ?>">
					</li>

				<?php  }
				?>

			</ul>
		</div>
	<?php  }  ?>

	<?php  
}

function custom_action_after_single_product_title() { 
	global $product, $post; 


	$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt ); 

	echo $short_description;
	//echo $short_description.'<a data-fancybox data-src="#read-more"  href="javascript:;">Read more</a><div id="read-more" class="read-more" style="display: none;">'.apply_filters('the_content', $post->post_content).'</div>';


}

function woo_remove_product_tabs( $tabs ) {
	//unset( $tabs['description'] ); // Remove the description tab
	//unset( $tabs['reviews'] ); // Remove the reviews tab
	unset( $tabs['additional_information'] );   // Remove the additional information tab
	return $tabs;
}




function customize_additional_information( $tabs ) {
	global $product;
	$tabs['additional_information']['callback'] = 'custom_additional_information'; // this is the function name which is included below
	return $tabs;
}

function custom_additional_information(){ 
	woocommerce_product_additional_information_tab(); // This function calls  wc_get_template( 'single-product/tabs/additional-information.php' );
	
}


function rename_description_product_tab_label() {
	return 'Product Description';
}


function woo_new_product_tab( $tabs ) {
	if(get_field('is_nutrition_info_and_allergies_tab_required') == 1){
		// Adds the new tab
		$tabs['desc_tab'] = array(
			'title'     => __( 'Nutrition Info and Allergies', 'woocommerce' ),
			'priority'  => 50,
			'callback'  => 'woo_new_product_tab_content'
		);
	}
	return $tabs;
}

function woo_new_product_tab_content() {
	if(get_field('is_nutrition_info_and_allergies_tab_required') == 1){ 
		echo '<div class="product-allergies">'.get_field('add_nutrition_info_and_allergies_details').'</div>'; //add anything you want to show after the default tab content 
	}
}


function reorder_tabs($tabs) {
	if(get_field('is_nutrition_info_and_allergies_tab_required') == 1){
		$tabs['desc_tab']['priority'] = 10;
		$tabs['reviews']['priority'] = 20;
	}
	return $tabs;
}


function product_custom_content() {
	?>
</div>
</div>
</div>




<?php
}


function _show_reviews() {
	global $product;
	$rating_count = $product->get_rating_count();
	$review_count = $product->get_review_count();
	$average      = $product->get_average_rating();

	?>

	<section class="customers-say bg-gray">
		<div class="wrap" style="visibility: visible; ">
			<div class="title">
				<h2>What our customers are saying</h2>
			</div>

			<?php if( $review_count == 0){ ?>
				<div class="shop-more-view text-center">
					<a data-fancybox data-src="#more-review"  href="javascript:;" class="shop-btn">Write a Review</a><script>jQuery('.woocommerce-tabs').hide();jQuery('.woocommerce-tabs').attr('id','more-review');</script>
				</div>

			<?php }else{ ?>

				<!--<a data-fancybox data-src="#cr-ajax-reviews-review-form"  href="javascript:;" class="shop-btn">Write a Review</a>-->
				<div class="wrap">
					<?php echo do_shortcode('[cusrev_reviews_grid count="3" show_products="false" product_links="true" sort_by="date" sort="DESC" categories="" product_tags="" products="'.get_the_ID().'" color_ex_brdr="#ebebeb" color_brdr="#ebebeb" color_ex_bcrd="" color_bcrd="#ffffff" color_pr_bcrd="#f4f4f4" color_stars="#FFD707" shop_reviews="false" count_shop_reviews="1" inactive_products="false" avatars="initials" show_more="0" min_chars="0" show_summary_bar="false"]'); ?>
				</div>
				<div class="shop-more-view text-center">
					<a data-fancybox data-src="#more-review"  href="javascript:;" class="shop-btn">see more reviews</a><script>jQuery('.woocommerce-tabs').hide();jQuery('.woocommerce-tabs').attr('id','more-review');</script>
				</div>

			<?php } ?>

		</div> 

	</section>




	<?php
}


function bbloomer_show_return_policy() {
	$product_installment_text  =  get_field('product_installment_text'); 
	$product_postpay_tooltip  =  get_field('product_postpay_tooltip');
	echo '<div class="installment"><p>'.$product_installment_text;
	if($product_postpay_tooltip!=''){ echo '<span class="info-a tooltip">!<span class="tooltiptext">'.$product_postpay_tooltip.'</span></span>'; }
	echo '</p></div>';
}

function add_content_after_addtocart_button_func() {

	echo do_shortcode('[ti_wishlists_addtowishlist]');
}





/**
 * This adds the new unit to the WooCommerce admin
 */
function woocommerce_weight_unit( $settings ) {

	foreach ( $settings as &$setting ) {

		if ( 'woocommerce_weight_unit' == $setting['id'] ) {
			$setting['options']['ml'] = __( 'ml' );  // new unit
		}
	}

	return $settings;
}


function ql_woocommerce_ajax_add_to_cart_js() {

	// if (function_exists('is_product') && is_product()) {  

	wp_enqueue_script('custom_script', get_bloginfo('stylesheet_directory') . '/woocommerce/inc/js/ajax-add-to-cart.js', array('jquery'),'.13' );

	//  }

}


function ql_woocommerce_ajax_add_to_cart() {  

	$product_id = apply_filters('ql_woocommerce_add_to_cart_product_id', absint($_POST['product_id']));

	$quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);

	$variation_id = absint($_POST['variation_id']);

	$passed_validation = apply_filters('ql_woocommerce_add_to_cart_validation', true, $product_id, $quantity);

	$product_status = get_post_status($product_id); 

	if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) { 

		do_action('ql_woocommerce_ajax_added_to_cart', $product_id);

		if ('yes' === get_option('ql_woocommerce_cart_redirect_after_add')) { 

			wc_add_to_cart_message(array($product_id => $quantity), true); 

		} 

		WC_AJAX :: get_refreshed_fragments(); 

	} else { 

		$data = array( 

			'error' => true,

			'product_url' => apply_filters('ql_woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

		echo wp_send_json($data);

	}

	wp_die();

}



function jk_related_products_args( $args ) {
	$args['posts_per_page'] = get_field('how_many_related_products_in_one_row', 'option'); // 4 related products
	$args['columns'] = 4; // arranged in 2 columns
	return $args;
}




function cinchws_filter_dropdown_args( $args ) {
	$args['show_option_none'] = 'Volume';
	return $args;
}


function filter_dropdown_option_html_remove( $html, $args ) {
	$show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' );
	$show_option_none_html = '<option value="">' . esc_html( $show_option_none_text ) . '</option>';

	$html = str_replace($show_option_none_html, '', $html);

	return $html;
}


function filter_dropdown_option_html_none( $html, $args ) {
	$show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' );
	$show_option_none_text = esc_html( $show_option_none_text );

	$html = str_replace($show_option_none_text, '', $html);

	return $html;
}