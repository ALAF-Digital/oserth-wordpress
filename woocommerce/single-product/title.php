<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $product;
?> 
<div class="detail-title-box"><div class="pro-title-box-a">
    <?php if(get_field( 'sub_title' )): ?><h2 class="product_sub_title"><?php the_field( 'sub_title' ); ?></h2><?php endif; ?>    
    <?php if(get_field('new_product') ==1){ ?><span class="info-tag"><?php _e('NEW','woocommerce'); ?></span><?php } ?>
    <?php if(get_field('product_award') ==1){ ?><span class="info-tag pro-award"><?php the_field('award_title'); ?></span><?php } ?>
    <h1 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h1>
    <!-- SKU / Model Number -->
    <?php /* if($product->get_sku()): ?><span class="model">Style #: <?php echo $product->get_sku(); ?></span><?php endif; */ ?>
    <!-- <?php// if($product->get_sku()): ?><span class="model">Style #: <?php //echo $product->get_sku(); ?></span><?php //endif; ?> -->
    <!-- /SKU / Model Number -->
