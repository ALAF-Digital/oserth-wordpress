<?php 
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );// Remove open link in loop
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );// Remove close link in loop
add_action( 'woocommerce_before_shop_loop_item_title', 'get_item', 10 );//change each product structure
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );//remove star rating
//add_action( 'woocommerce_after_shop_loop_item', 'star_template_loop_rating', 10 );//change postion of star rating
//add_filter( 'woocommerce_get_price_html', 'after_product_title', 100, 2 );//After title in listing page
//add_action( 'woocommerce_after_shop_loop' , 'my_filter', 30 ); //add filter
//add_action( 'woocommerce_after_shop_loop_item', 'wc_shop_buttons', 20 );
//add_action( 'woocommerce_after_add_to_cart_button', 'wc_shop_buttons', 20 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );//Remove Product Price
remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );//Remove Product Title
//add_action('woocommerce_shop_loop_item_title', 'abChangeProductsTitle', 10 );//change product title
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');//Remove Add to Cart
//add_action('woocommerce_after_shop_loop_item_title', 'hover_link_groups');//Hover Links
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );//remove thumbnail/*remove SRCSET*/
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );//remove product count
remove_action( 'woocommerce_after_shop_loop' , 'woocommerce_result_count', 20 );//remove product count
//remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );//remove product ordering
//add_action( 'woocommerce_before_shop_loop', 'custom_woocommerce_result_count', 30 );//customize the product count
//add_action( 'woocommerce_before_shop_loop', 'custom_product_category', 20 );//show product category 
//add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  // To change add to cart text on product archives(Collection) page
add_filter('woocommerce_catalog_orderby', 'wc_customize_product_sorting');//customize Sorting
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
//add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );//custom query in listing page

add_filter( 'woocommerce_default_catalog_orderby_options', 'custom_woocommerce_catalog_orderby' );//order by random
add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby' );//order by random

add_filter( 'woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args' );// Shop random order. View settings drop down order by Woocommerce > Settings > Products > Display


function get_item(){
	global $loop_index, $loop;

	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'full'); 
	$product = wc_get_product(  get_the_ID() );
	$price_html = $product->get_price_html();
	$terms = get_the_terms( get_the_ID(), 'product_cat' );
	foreach ($terms as $term) {
		$product_cat = $term->name;
		break;
	}

	$rating_count = $product->get_rating_count();
	$review_count = $product->get_review_count();
	$average      = $product->get_average_rating();
	get_post_meta($product->get_id(),'total_sales', true);

	$bestsellers = get_bestsellers();
	?>
	<?php if(get_field('new_product') ==1){ ?><span class="badge-newproduct"><?php _e('New') ?></span><?php } ?>
	<?php if(in_array($product->get_id(), $bestsellers)){ ?><span class="badge-bestseller"  style="<?php if(is_tax()){ $current_taxonomy = get_queried_object(); echo 'background: '.get_field('brand_color', $current_taxonomy).';'; } ?>"><?php _e('Best Seller') ?></span><?php } ?>
	<div class="product-image">
		<a href="<?php echo get_the_permalink(); ?>">
			<?php if($image[0] == ''){ ?>
				<img style="background:url(<?php echo get_stylesheet_directory_uri(); ?>/woocommerce/inc/images/no-image-icon.jpg); background-size: cover;" src="<?php echo get_stylesheet_directory_uri(); ?>/woocommerce/inc/images/holder1.png">
			<?php }else{ ?>
				<img style="background:url(<?php echo $image[0]; ?>); background-size: cover;" src="<?php echo get_stylesheet_directory_uri(); ?>/woocommerce/inc/images/holder1.png">
			<?php } ?>
		</a>  
	</div>
	<div class="product-content">
		<!-- <span><?php //echo get_the_term_list( $product->get_id(), 'brands'); ?></span> -->
		<h3><a href="<?php echo get_the_permalink(); ?>">
			<?php 

			$title =  $product->get_name();

			$detect = new Mobile_Detect;
			if( $detect->isMobile() && !$detect->isTablet() ){ 
				$title = wp_trim_words( $title, 6, '...' ); 
				echo $title;

			}else{
				$title =  wp_trim_words( $title, 12, '...' );
				echo $title;
			}
			?>
		</a></h3>
		<h4><a href="<?php echo get_the_permalink($product->get_id()); ?>" class="price"><?php echo $product->get_price_html(); ?></a></h4>
		<a style="<?php if(is_tax()){ $current_taxonomy = get_queried_object(); echo 'background: '.get_field('brand_color', $current_taxonomy).';'; } ?>" href="javascript:void(0)" rel="nofollow" data-product_id="<?php echo $product->get_id() ?>" data-product_name="<?php echo  $product->get_name(); ?>" data-quantity="1" class="product_add_to_cart_button_ajax btn btn-outline"><?php _e('Add to cart','woocommerce'); ?></a>
	</div>
	<div class="over-product" style="display:none;">
		<a href="<?php echo get_the_permalink($product->get_id()); ?>"></a>
		<div class="outer-div">
			<?php echo do_shortcode('[ti_wishlists_addtowishlist product_id="' . $product->get_id() . '" loop="yes"]' ); ?>
			<a href="javascript:void;" data-product_id="<?php echo $product->get_id() ?>" class="add-more-quantity plus">+1</a>
			<span id="product-counter"></span>
		</div>
	</div>

	<?php 
}



function get_bestsellers(){


	$args = array( 
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page' => 10,
		'orderby'  => array( 'meta_value_num' => 'DESC', 'title' => 'ASC' ),
		'meta_key' => 'total_sales'
	);
	$the_query = new WP_Query( $args );

	$best_sellers = array();

// The Loop
	if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) : $the_query->the_post();

			$total_sales =  get_post_meta(get_the_ID(),'total_sales', true);
			if($total_sales>15){ $best_sellers[] = get_the_ID(); }

		endwhile;
	endif;

// Reset Post Data
	wp_reset_postdata();

	return $best_sellers;
}


function custom_woocommerce_result_count(){
	echo '<div class="woocommerce-result-count">Showing 1-8 From '.wc_get_loop_prop( 'total' ).' Products</div>';
}


function custom_product_category(){
	$orderby = 'name';
	$order = 'asc';
	$hide_empty = false ;
	$exclude  = 15;
	$cat_args = array(
		'orderby'    => $orderby,
		'order'      => $order,
		'hide_empty' => $hide_empty,
		'exclude' => $exclude,
	);

	$product_categories = get_terms( 'product_cat', $cat_args );

	if( !empty($product_categories) ){
		echo '<ul class="product-cat">';
		foreach ($product_categories as $key => $category) {
			echo '<li>';
			echo '<a href="'.get_term_link($category).'" >';
			echo $category->name;
			echo '</a>';
			echo '</li>';
		}
		echo '</ul>


		';
	}
}



function wc_customize_product_sorting($sorting_options){
	$sorting_options = array(
		'popularity' => __( 'Most Relevant', 'woocommerce' ),
		'rating'     => __( 'Average rating', 'woocommerce' ),
		'date'       => __( 'Latest First', 'woocommerce' ),
		'price'      => __( 'Low to High', 'woocommerce' ),
		'price-desc' => __( 'High to Low', 'woocommerce' ),
	);

	return $sorting_options;
}


function woocommerce_custom_product_add_to_cart_text() {
	return __( 'Shop Now', 'woocommerce' );
}



function wc_shop_buttons() {

	if(is_shop()){

		global $product;

		if ( $product->is_type( 'variable' ) ) {
			$link = get_the_permalink(get_the_ID());

		}else{
			$link = '?add-to-cart='.get_the_ID();

		}

		//echo "<pre>"; print_r($product); echo "</pre>";
		echo '<div class="wc-shop-buttons"><div class="but-box-pro"><a href="'.$link.'" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="'.get_the_ID().'" data-product_sku="'.$product->get_sku().'" aria-label="Add “'.get_the_title().'” to your cart" rel="nofollow">'.__('Shop Now', 'woocommerce').'</a>';
		echo '<a class="button view_button" href="'.get_the_permalink().'" >'.__('View Details', 'woocommerce').'</a></div></div>';

	}
}

function hover_link_groups(){
	?>

	<span class="wishlisht"><?php echo do_shortcode("[ti_wishlists_addtowishlist loop=yes]"); ?></span>
	<?php
}


function star_template_loop_rating(){
	global $product;


	$rating_count = $product->get_rating_count();
	$review_count = $product->get_review_count();
	$average      = $product->get_average_rating();
	$comments_count = wp_count_comments(get_the_ID());
	$total_comments = $comments_count->total_comments;

	echo '<div class="star">';
	if($total_comments >0){ 
		echo wc_get_rating_html( $average, $rating_count ).'<span class="count-box">('.$total_comments.')</span>'; 
	}else{

		//echo $average; echo $rating_count;
		echo '<div class="star-rating"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div><span class="count-box">('.$total_comments.')</span>';
	}
	echo '</div>';
}


function my_filter(){
	$filter = get_field('product_filter_shortcode', 'option');   echo '<div class="filterProducts">'.do_shortcode($filter).'</div>';
}


function abChangeProductsTitle() {

	$title =  get_the_title();

	$detect = new Mobile_Detect;
	if( $detect->isMobile() && !$detect->isTablet() ){ 
		$title = wp_trim_words( $title, 6, '...' ); // change 2nd number to the number of WORDS you want
		echo '<h2 class="woocommerce-loop-product__title">'.$title.'</h2>';

	}else{
		$title =  wp_trim_words( $title, 12, '...' ); // change 2nd number to the number of WORDS you want
		echo '<h2 class="woocommerce-loop-product__title">'.$title.'</h2>';
	}


}


add_action( 'wp', function() {
	if ( is_product() ){
		remove_action( 'woocommerce_after_shop_loop_item', 'tinvwl_view_addto_htmlloop' );
	} 
} );


function after_product_title($price, $product){ 
	return $price;

}



function custom_woocommerce_get_catalog_ordering_args( $args ) {
	$orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
	if ( 'random_list' == $orderby_value ) {
		$args['orderby'] = 'rand';
		$args['order'] = '';
		$args['meta_key'] = '';
	}
	return $args;
}


function custom_woocommerce_catalog_orderby( $sortby ) {
	$sortby['random_list'] = 'Random';
	return $sortby;
}





function custom_pre_get_posts_query( $q ) {

	if ( ! $q->is_main_query() ) return;
	if ( ! $q->is_post_type_archive() ) return;

	if ( ! is_admin() && is_shop() ) {

		$q->set( 'tax_query', array(array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
                'terms' => array( 'shoes' ), // Display products in the knives category on the shop page
                'operator' => 'IN'
            )));

	}

	remove_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

}