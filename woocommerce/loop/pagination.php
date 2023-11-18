<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
	return;
}
?>
<nav class="woocommerce-pagination">
	<?php
	echo paginate_links(
		apply_filters(
			'woocommerce_pagination_args',
			array( // WPCS: XSS ok.
				'base'      => $base,
				'format'    => $format,
				'add_args'  => false,
				'current'   => max( 1, $current ),
				'total'     => $total,
				'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
				'next_text' => is_rtl() ? '&larr;' : '&rarr;',
				'type'      => 'list',
				'end_size'  => 1,
				'mid_size'  => 1,
			)
		)
	);
	?>

	<?php /* 
	<ul class="page-numbers">
		<?php if(get_previous_posts_link()): ?>
			<li class="previous-link"><?php echo get_previous_posts_link( '←' ) ?></li>
		<?php else: ?>
			<li class="previous-link disabled"><a href="javascript:void(0);"><span>←</span></a></li>
		<?php endif; ?>
		
		<li class="page-text">
			<span>Page <?php echo $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?> of <?php global $wp_query;
echo $wp_query->max_num_pages; ?></span>
		</li>
			
		<?php if(get_next_posts_link()): ?>
			<li class="next-link"><?php echo get_next_posts_link('→'); ?></li>
		<?php else: ?>
			<li class="next-link disabled"><a href="javascript:void(0);"><span>→</span></a></li>
		<?php endif; ?>
	</ul> */ ?>
</nav>
