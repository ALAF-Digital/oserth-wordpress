<?php 
//https://wpbeaches.com/displaying-featured-products-woocommerce
//[woo_featured per_page="10"]



add_shortcode( 'woo_featured', 'wb_woo_featured' );
/*
 *
 * Featured Product Loop
 */
function wb_woo_featured($atts) { 

	if(isset($atts['per_page'])): $per_page = $atts['per_page']; else: $per_page = '-1'; endif;

$args = array(  
	'post_type'      => 'product',  
	'posts_per_page' => $per_page,
	'post_status'    => 'publish',
	'tax_query'      => array(
		array(
			'taxonomy' => 'product_visibility',
			'field'    => 'name',
			'terms'    => 'featured',
			'operator' => 'IN'
		),  
	),
);  
$featured_product = new WP_Query( $args );  

if ( $featured_product->have_posts() ) :  

ob_start();

echo '<ul>';
while ( $featured_product->have_posts() ) : $featured_product->the_post();

$product               = wc_get_product( $featured_product->post->ID );  
$post_thumbnail_id     = get_post_thumbnail_id();
$product_thumbnail     = wp_get_attachment_image_src($post_thumbnail_id, $size = 'full');
$product_thumbnail_alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );


 
?>

          <li>
             <div class="home-product-img">
             <a href="<?php the_permalink();?>">
                <img src="<?php echo $product_thumbnail[0]; ?>" alt="" class="responsive-img">
             </a>
             </div>
             <h3><?php the_title();?></h3>
             <h5><?php echo $product->get_price_html(); ?></h5>
          </li>



<?php

endwhile;  
echo '</ul>';
endif;  
wp_reset_query();

return ob_get_clean();
}