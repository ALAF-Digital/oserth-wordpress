<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<section class="woocommerce-customer-details">

	<?php if ( $show_shipping ) : ?>

		<section class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">


			<div class="woocommerce-column  woocommerce-column--order-address">

				<h2><?php _e('Contact Details', 'woocommerce');?></h2>
				<address>

					<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

						<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
						<li class="woocommerce-order-overview__email email">
							<?php esc_html_e( 'Email:', 'woocommerce' ); ?>
							<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
						</li>
					<?php endif; ?>

					<li class="woocommerce-order-overview__total total">
						<?php esc_html_e( 'Phone:', 'woocommerce' ); ?>
						<strong><?php echo $order->get_billing_phone(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
					</li>
				</ul>
			</address>

		</div>

		<div class="woocommerce-column woocommerce-column--1 woocommerce-column--billing-address col-1">

		<?php endif; ?>

		<h2 class="woocommerce-column__title"><?php esc_html_e( 'Billing address', 'woocommerce' ); ?></h2>

		<address>
			<?php echo wp_kses_post( $order->get_formatted_billing_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?>

			<?php if ( $order->get_billing_phone() ) : ?>
				<p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_billing_phone() ); ?></p>
			<?php endif; ?>

			<?php if ( $order->get_billing_email() ) : ?>
				<p class="woocommerce-customer-details--email"><?php echo esc_html( $order->get_billing_email() ); ?></p>
			<?php endif; ?>
		</address>

		<?php if ( $show_shipping ) : ?>

		</div><!-- /.col-1 -->

		<div class="woocommerce-column woocommerce-column--2 woocommerce-column--shipping-address col-2">
			<h2 class="woocommerce-column__title"><?php esc_html_e( 'Shipping address', 'woocommerce' ); ?></h2>
			<address>
				<?php echo wp_kses_post( $order->get_formatted_shipping_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?>

				<p class="woocommerce-customer-details--phone"><?php echo esc_html( get_post_meta( $order->get_id(), '_shipping_phone', true ) ); ?></p>
				<p class="woocommerce-customer-details--email"><?php echo esc_html( get_post_meta( $order->get_id(), '_shipping_email', true ) ); ?></p>
				

			</address>
		</div><!-- /.col-2 -->

	</section><!-- /.col2-set -->

<?php endif; ?>

<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

</section>
