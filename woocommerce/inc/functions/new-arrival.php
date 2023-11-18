<?php 
//https://wpbeaches.com/displaying-featured-products-woocommerce
//[new_arrival per_page="10"]



add_shortcode( 'new_arrival', 'wb_new_arrival' );
/*
 *
 * Featured Product Loop
 */
function wb_new_arrival($atts) { 

	if(isset($atts['per_page'])): $per_page = $atts['per_page']; else: $per_page = '-1'; endif;

	$args = array(  
		'post_type'      => 'product',  
		'posts_per_page' => $per_page,
		'post_status'    => 'publish',
		'meta_query'      => array(
			array(
				'key' => 'recent_product',
				'value' => '1',
				'compare' => '='
			),  
		),
	);  
	$recent_product = new WP_Query( $args );  

	if ( $recent_product->have_posts() ) :  

		ob_start();

		echo '<div class="woocommerce columns-4 "><ul class="products columns-4">';
		while ( $recent_product->have_posts() ) : $recent_product->the_post();

			$product               = wc_get_product( $recent_product->post->ID );  
			$post_thumbnail_id     = get_post_thumbnail_id();
			$product_thumbnail     = wp_get_attachment_image_src($post_thumbnail_id, $size = 'full');
			$product_thumbnail_alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );



			?>



			<li class="product img product grid">
				<a href="<?php the_permalink();?>" class="">
					<figure class="effect-bubba">
						<img src="<?php echo site_url(); ?>/wp-content/uploads/product-list-placeholder.png" style="background: url(<?php echo $product_thumbnail[0]; ?>);" width="800" height="800" data-id="1572" alt="<?php the_title();?>">
						<figcaption>

						</figcaption>
					</figure>
					<h2 class="woocommerce-loop-product__title"><?php the_title();?></h2>
					<span class="price"><?php echo $product->get_price_html(); ?></span>
				</a>
			</li>



			<?php

		endwhile;  
		echo '</ul></div>';

	else:

		echo do_shortcode('[recent_products limit="10"]');
	endif;  
	wp_reset_query();

	return ob_get_clean();
}