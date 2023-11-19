<?php
/*
Template Name: thankyou-templete
*/


get_header(); ?>

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
                    <h1>Your order confirmed</h1>
                </div>
            </div>
        </div>

    </section>


   <?php
$order_id = get_query_var('order-received');

if ($order_id) {
    $order = wc_get_order($order_id);
    $order_data = $order->get_data();
    $order_number = $order_data['id'];
    $subtotal = wc_price($order_data['subtotal']);
    $gift_wrap_fee = wc_price($order_data['fee_total']);
    $grand_total = wc_price($order_data['total']);
}
?>

<section class="cart-content thankcontent">
    <img src="assets/images/faqsvector.png" class="img-fluid wave-line" alt="">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="thank-details">
                    <h1>Thank you!</h1>
                    <p class="para">Your trust and support mean the world to us, and we're thrilled that you found
                        something special in our e-store. <br>
                        We work tirelessly to provide you with a seamless and enjoyable shopping experience, and
                        your satisfaction is our top priority.</p>
                    <h3>Your order # is: <?php echo $order_number; ?></h3>
                    <p>We will email you order confirmation with details and tracking info.</p>
                    <a href="#" class="btn">Continue Shopping<i class="fa-solid fa-arrow-right ms-2"></i></a>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="thank-total">
                    <h3>Cart Totals</h3>
                    <div class="sub">
                        <p>Subtotal</p>
                        <span><?php echo $subtotal; ?></span>
                    </div>
                    <div class="wrap">
                        <p>Gift Wrap</p>
                        <p>Flat rate:</p>
                        <span><?php echo $gift_wrap_fee; ?></span>
                    </div>

                    <div class="grandtotal">
                        <p>Grand Total</p>
                        <h4><?php echo $grand_total; ?></h4>
                    </div>

                    <button class="btn">Download Invoice</button>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
