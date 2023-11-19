<?php
/*
Template Name: checkout-templete
*/

get_header();
?>

<section class="product-content about-content about-mobile">
    <div class="container-fluid">
        <div class="detail-head head-mobile d-flex align-items-center">
            <p>Home</p>
            <i class="fa-solid fa-greater-than"></i>
            <p>Contact us</p>
        </div>
    </div>
</section>
<!-- moblie-section End-->

<section class="Journaldetails">
    <div class="cart-banner thankbanner" style="--bgimg:url(../images/thankyoubanner.png)">
        <div class="container">
            <div class="col-md-3">
                <h1>Checkout</h1>
            </div>
        </div>
    </div>
</section>

<img src="assets/images/faqsvector.png" class="img-fluid wave-line" alt="">

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <?php
                if (class_exists('WooCommerce')) {
                    $checkout = WC()->checkout;

                    // If checkout registration is disabled and not logged in, the user cannot checkout.
                    if ($checkout && !$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
                        echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
                        return;
                    }
                } else {
                    // If WooCommerce is not active, provide an error message.
                    echo 'WooCommerce is not active.';
                    return;
                }
                ?>

                <?php if ($checkout->get_checkout_fields()) : ?>

                    <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                    <div class="col2-set" id="customer_details">
                        <div class="col-1">
                            <?php do_action('woocommerce_checkout_billing'); ?>
                        </div>

                        <div class="col-2">
                            <?php do_action('woocommerce_checkout_shipping'); ?>
                        </div>
                    </div>

                    <?php do_action('woocommerce_checkout_after_customer_details'); ?>

                <?php endif; ?>
            </div>

            <div class="col-lg-4">
                <div class="thank-total">
                    <h3 id="order_review_heading"><?php _e('Your order', 'woocommerce'); ?></h3>

                    <?php do_action('woocommerce_checkout_before_order_review'); ?>

                    <div id="order_review" class="woocommerce-checkout-review-order">
                        <?php do_action('woocommerce_checkout_order_review'); ?>
                    </div>

                    <?php do_action('woocommerce_checkout_after_order_review'); ?>
                </div>
            </div>
        </div>
    </div>

    <?php do_action('woocommerce_after_checkout_form', $checkout); ?>

    <script type="text/javascript">
        (function () {
            jQuery(':input').removeAttr('placeholder');
        })(jQuery)
    </script>

</form>

<?php get_footer(); ?>
