<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="customer_details" id="customer_details">
			<div class="checkout_billing">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="checkout_shipping">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>


	<div class="your-order-col">



		<?php if(!is_user_logged_in()){ ?>
			<div class="create_an_account">
				<h3>Create An Account</h3>
				<h4>Are you a new customer ? Create an account today and save the benefits : </h4>
				<ul >
					<li>Latest Info about Offers and Sales</li>
					<li>Get Coupons for Great Discounts</li>
					<li>Save Addresses for Speedy Checkout</li>
				</ul>
				<br/>

				<a href="<?php echo site_url(); ?>/my-account/?action=register" class="wlp-view-all position-unset"><?php esc_html_e( 'Create New Account', 'woocommerce' ); ?></a>
			</div>
		<?php } ?>

		
		<div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

			<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>

			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>


			<?php do_action( 'woocommerce_checkout_order_review' ); ?>

			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

		</div>
	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
<script type="text/javascript">
    (function(){
        jQuery(':input').removeAttr('placeholder');
    })(jQuery)
</script>