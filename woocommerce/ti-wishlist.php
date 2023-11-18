<?php
/**
 * The Template for displaying wishlist if a current user is owner.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/ti-wishlist.php.
 *
 * @version             1.24.5
 * @package           TInvWishlist\Template
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
wp_enqueue_script('tinvwl');
?>
<div class="tinv-wishlist woocommerce tinv-wishlist-clear">
	<?php do_action('tinvwl_before_wishlist', $wishlist); ?>
	<?php if (function_exists('wc_print_notices') && isset(WC()->session)) {
		wc_print_notices();
	} ?>
	<?php
	$wl_paged = absint(get_query_var('wl_paged'));
	$form_url = tinv_url_wishlist($wishlist['share_key'], $wl_paged, true);
	?>
	<form action="<?php echo esc_url($form_url); ?>" method="post" autocomplete="off">
		<?php do_action('tinvwl_before_wishlist_table', $wishlist); ?>

		<?php do_action('tinvwl_wishlist_contents_before'); ?>

		<ul class="products pro-list-ul columns-4">

			<?php

			global $product, $post;
			// store global product data.
			$_product_tmp = $product;
			// store global post data.
			$_post_tmp = $post;

			foreach ($products as $wl_product) {

				if (empty($wl_product['data'])) {
					continue;
				}

				// override global product data.
				$product = apply_filters('tinvwl_wishlist_item', $wl_product['data']);
				// override global post data.
				$post = get_post($product->get_id());

				unset($wl_product['data']);
				if ($wl_product['quantity'] > 0 && apply_filters('tinvwl_wishlist_item_visible', true, $wl_product, $product)) {
					$product_url = apply_filters('tinvwl_wishlist_item_url', $product->get_permalink(), $wl_product, $product);
					do_action('tinvwl_wishlist_row_before', $wl_product, $product);
					?>
					<li class="item-<?php echo $product->get_id(); ?>">
						<div class="zoom-effect <?php echo esc_attr(apply_filters('tinvwl_wishlist_item_class', 'wishlist_item' , $wl_product, $product)); ?>">
						<div class="product-remove">
							<button type="submit" name="tinvwl-remove"
							value="<?php echo esc_attr($wl_product['ID']); ?>"
							title="<?php _e('Remove', 'ti-woocommerce-wishlist') ?>" class="remove-<?php echo $product->get_id() ?>">
							<i class="icon-cross"></i>
						</button>
					</div>
					<div class="product-thumbnail">
						<?php
						$thumbnail = apply_filters('tinvwl_wishlist_item_thumbnail', $product->get_image(), $wl_product, $product);

						$thumbnail = get_the_post_thumbnail_url( $product->get_id());


						if(!isset($thumbnail)|| $thumbnail == ''){

							$thumbnail = get_stylesheet_directory_uri().'/woocommerce/inc/images/no-image-icon.jpg';

						}


							if (!$product->is_visible()) {
									//echo $thumbnail; // WPCS: xss ok.

								?>
								<img style="background:url(<?php echo $thumbnail ; ?>); background-size: cover;" src="<?php echo get_stylesheet_directory_uri(); ?>/woocommerce/inc/images/holder1.png">
								<?php 
							} else {
									printf('<a href="%s">%s</a>', esc_url($product_url), '<img style="background:url('.$thumbnail.'); background-size: cover;" src="'.get_stylesheet_directory_uri().'/woocommerce/inc/images/holder1.png">' ); // WPCS: xss ok.
							}
							?>
						</div>
						<div class="product-name">
							<?php
							if (!$product->is_visible()) {
								echo apply_filters('tinvwl_wishlist_item_name', is_callable(array(
									$product,
									'get_name'
										)) ? $product->get_name() : $product->get_title(), $wl_product, $product) . '&nbsp;'; // WPCS: xss ok.
							} else {
								echo apply_filters('tinvwl_wishlist_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_url), is_callable(array(
									$product,
									'get_name'
								)) ? $product->get_name() : $product->get_title()), $wl_product, $product); // WPCS: xss ok.
							}

							echo apply_filters('tinvwl_wishlist_item_meta_data', tinv_wishlist_get_item_data($product, $wl_product), $wl_product, $product); // WPCS: xss ok.
							?>
						</div>
						<?php if (isset($wishlist_table_row['colm_price']) && $wishlist_table_row['colm_price']) { ?>
							<div class="product-price">
								<?php
								echo apply_filters('tinvwl_wishlist_item_price', $product->get_price_html(), $wl_product, $product); // WPCS: xss ok.
								?>
							</div>
						<?php } ?>
						<a href="javascript:void(0)" rel="nofollow" data-product_id="<?php echo $product->get_id() ?>" data-product_name="<?php echo  $product->get_name(); ?>" data-quantity="1" class="product_add_to_cart_button_ajax btn btn-block btn-outline"><?php _e('Add to cart','woocommerce'); ?></a>
					</div>

				<!-- </div> -->


						<?php  /*if (isset($wishlist_table_row['add_to_cart']) && $wishlist_table_row['add_to_cart']) { ?>
							<div class="product-action">
								<?php
								if (apply_filters('tinvwl_wishlist_item_action_add_to_cart', $wishlist_table_row['add_to_cart'], $wl_product, $product)) {
									?>
									<button class="button alt" name="tinvwl-add-to-cart"
									value="<?php echo esc_attr($wl_product['ID']); ?>"
									title="<?php echo esc_html(apply_filters('tinvwl_wishlist_item_add_to_cart', $wishlist_table_row['text_add_to_cart'], $wl_product, $product)); ?>">
									<i
									class="ftinvwl ftinvwl-shopping-cart"></i><span
									class="tinvwl-txt"><?php echo wp_kses_post(apply_filters('tinvwl_wishlist_item_add_to_cart', $wishlist_table_row['text_add_to_cart'], $wl_product, $product)); ?></span>
								</button>
							<?php } elseif (apply_filters('tinvwl_wishlist_item_action_default_loop_button', $wishlist_table_row['add_to_cart'], $wl_product, $product)) {
								woocommerce_template_loop_add_to_cart();
							} ?>
						</div>
					<?php }*/  ?>
				</li>
				<?php
				do_action('tinvwl_wishlist_row_after', $wl_product, $product);
				} // End if().
			} // End foreach().
			// restore global product data.
			$product = $_product_tmp;
			// restore global post data.
			$post = $_post_tmp;
			?>


		</ul>
		<?php do_action('tinvwl_wishlist_contents_after'); ?>

		<?php //do_action('tinvwl_after_wishlist_table', $wishlist); ?>
		<?php wp_nonce_field('tinvwl_wishlist_owner', 'wishlist_nonce'); ?>

	</form>
	<?php //do_action('tinvwl_after_wishlist', $wishlist); ?>
	<div class="tinv-lists-nav tinv-wishlist-clear">
		<?php do_action('tinvwl_pagenation_wishlist', $wishlist); ?>
	</div>
</div>