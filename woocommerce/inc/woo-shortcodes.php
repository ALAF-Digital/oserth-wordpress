<?php

//[brands per-page="10" parent-classes="cls"]

add_shortcode( 'brands', 'get_brands' );

function get_brands($atts) { 

  if(isset($atts['per-page'])): $per_page = $atts['per-page']; else: $per_page = '-1'; endif;
  if(isset($atts['parent-classes'])): $parent_classes = $atts['parent-classes']; else: $parent_classes = ''; endif;

	$brands = get_terms( array(
	    'taxonomy' => 'brands',
	    'hide_empty' => false,
	) );

	if ( ! empty( $brands ) && ! is_wp_error( $brands ) ):

		ob_start();

		echo ' <ul class="'.$parent_classes.'">';
			foreach ( $brands as $brand ) : 

				$thumbnail = get_field('brand_image', $brand);
			?>

			<li>
				<a href="<?php echo get_term_link( $brand ); ?>">
						<?php if ( $thumbnail  == '') { ?>
							
							<span style="text-align: center; width: 100%;"><?php echo $brand->name; ?></span>
						<?php }else{ ?>
							<img src="<?php echo $thumbnail; ?>" title="<?php echo $brand->name; ?>" alt="<?php echo $brand->name; ?>">
						<?php } ?>

				</a>
			</li>

		<?php

			endforeach;  
		echo '</ul>';
	endif;  
	wp_reset_query();

	return ob_get_clean();
}



////[categories per-page="10" parent-classes="cls"]

add_shortcode( 'categories', 'get_productcategories' );

function get_productcategories($atts) { 

  if(isset($atts['per-page'])): $per_page = $atts['per-page']; else: $per_page = '-1'; endif;
  if(isset($atts['parent-classes'])): $parent_classes = $atts['parent-classes']; else: $parent_classes = ''; endif;

	$categories = get_terms( array(
	    'taxonomy' => 'product_cat',
	    'hide_empty' => false,
	) );

	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ):

		ob_start();


$shop_id = woocommerce_get_page_id( 'shop' );

		echo ' <ul class="'.$parent_classes.'">';
			foreach ( $categories as $category ) : 

				if ( ! in_array( $category->slug, array( 'uncategorized' ) ) ) {

					    $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
					    $image = wp_get_attachment_url( $thumbnail_id );
					    
					?>

					<li>
						<a href="<?php echo get_term_link( $category ); ?>">

							<div class="home-product-range-icon">
								<?php if ( $image  == '') { ?>
									<img src="<?php echo site_url(); ?>/wp-content/uploads/product-list-placeholder.png" alt="<?php echo $category->name; ?>"  title="<?php echo $category->name; ?>" width="150">
								<?php }else{ ?>
									<img src="<?php echo $image; ?>" alt="<?php echo $category->name; ?>"  title="<?php echo $category->name; ?>">
								<?php } ?>
							</div>

							<div class="product-range-content"><?php echo $category->name; ?></div>
						</a>
					</li>

				<?php
			}

			endforeach;  
		echo '</ul>';
	endif;  
	wp_reset_query();

	return ob_get_clean();
}
