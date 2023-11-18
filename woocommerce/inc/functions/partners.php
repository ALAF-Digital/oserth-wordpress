<?php

////[partners per_page="10"]

add_shortcode( 'partners', 'get_partners' );
/*
 *
 * Featured Product Loop
 */
function get_partners($atts) { 

  if(isset($atts['per_page'])): $per_page = $atts['per_page']; else: $per_page = '-1'; endif;

$args = array(  
  'post_type'      => 'partners',  
  'posts_per_page' => $per_page,
  'post_status'    => 'publish',
  
);  
$partners = new WP_Query( $args );  

if ( $partners->have_posts() ) :  

ob_start();

echo '<div class="owl-carousel owl-theme brands-slide-home">';
while ( $partners->have_posts() ) : $partners->the_post();

$product               = wc_get_product( $partners->post->ID );  
$post_thumbnail_id     = get_post_thumbnail_id();
$product_thumbnail     = wp_get_attachment_image_src($post_thumbnail_id, $size = 'full');
$product_thumbnail_alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );

?>

   <div data-aos-delay="300" data-aos="fade-up" class="item"><img class="res-img" src="<?php echo $product_thumbnail[0]; ?>" alt="<?php echo $product_thumbnail_alt;?>"/></div>


<?php

endwhile;  
echo '</div>';
endif;  
wp_reset_query();

return ob_get_clean();
}