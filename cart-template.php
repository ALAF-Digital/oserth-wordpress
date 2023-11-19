<?php
/*
Template Name: Cart-templete
*/

function get_delivery_charges() {
    $packages = WC()->shipping->get_packages();
    $chosen_shipping_methods = WC()->session->get('chosen_shipping_methods');
    
    // Ensure we have a shipping method chosen
    if (empty($chosen_shipping_methods[0])) {
        return '0.00';
    }

    // Get the chosen shipping method
    $chosen_shipping_method = $chosen_shipping_methods[0];

    // Loop through packages and get shipping costs
    foreach ($packages as $package) {
        if (!empty($package['rates'][$chosen_shipping_method])) {
            $shipping_rate = reset($package['rates'][$chosen_shipping_method]);
            return $shipping_rate->cost;
        }
    }

    return '0.00';
}

?>

<!doctype html>
<html lang="en">

<?php get_header(); ?>

<body>

    <!-- moblie-section -->
    <section class="product-content about-content about-mobile">
        <div class="container-fluid">
            <div class="detail-head head-mobile d-flex align-items-center">
                <p>Home</p>
                <i class="fa-solid fa-greater-than"></i>
                <p>Journal</p>
                <i class="fa-solid fa-greater-than"></i>
                <p>All Products</p>
            </div>
        </div>
    </section>
    <!-- moblie-section End-->

    <section class="Journaldetails">
        <div class="cart-banner" style="--bgimg:url(../images/cartbanner1.svg)">
            <div class="container">
                <div class="col-md-3">
                    <h1>My cart</h1>
                </div>
            </div>
        </div>

    </section>

<section class="Journaldetails-content cart-content">
    <img src="assets/images/faqsvector.png" class="img-fluid wave-line" alt="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-pad">
                    <div class="cart-shipped">
                        <h1>Products shipped immediately</h1>

                        <?php
                        // Check if WooCommerce is active
                        if (class_exists('WooCommerce')) {
                            // Get the cart contents
                            $cart_items = WC()->cart->get_cart();

                            // Loop through each cart item
                            foreach ($cart_items as $cart_item_key => $cart_item) {
                                // Get product details
                                $product_id = $cart_item['product_id'];
                                $product = wc_get_product($product_id);

                                // Output HTML for each product
                                echo '<div class="cart-details">';
                                echo '<img src="' . get_the_post_thumbnail_url($product_id) . '" class="img-fluid" alt="">';
                                echo '<div class="cart-para">';
                                echo '<h3>' . $product->get_name() . '</h3>';
                                echo '<p>' . $product->get_sku() . ' - ' . $product->get_short_description() . '</p>';
                                echo '</div>';
                                echo '<a href="#" class="cartaction">' . $cart_item['quantity'] . ' <span class="mb-1"></span></a>';
                                echo '<p class="total">' . wc_price($product->get_price()) . '</p>';
                                echo '<a href="' . esc_url(wc_get_cart_remove_url($cart_item_key)) . '" class="cartaction1"><i class="fa-solid fa-x"></i></a>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
    <div class="cart-total">
        <h1>Cart Totals</h1>
        <?php $currency_code = get_woocommerce_currency(); ?>
        <div class="cartsub">
            <p>Subtotal</p>
            <p><?php echo $currency_code; ?> <?php echo WC()->cart->get_subtotal(); ?></p>
        </div>

        <div class="cartsub">
            <p>Delivery Charges</p>
            <p><?php echo $currency_code; ?>  <?php echo get_delivery_charges(); ?></p>
        </div>

        <form action="">
            <input type="text" class="form-control" placeholder="Discount coupon code here">
            <button class="btn">Apply</button>
        </form>

        <div class="grand-total">
            <p>Grand Total</p>

            <h3><?php echo WC()->cart->get_total(); ?></h3>
        </div>

        <a  href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="proceed btn">Proceed to checkout <i class="fa-solid fa-arrow-right ms-2"></i></a>

        <div class="secure">
            <p>Secure payments</p>
            <img src="assets/images/paymentimg.png" alt="">
            <img src="assets/images/payment1.png" alt="">
            <img src="assets/images/payment2.png" alt="">
            <img src="assets/images/payment3.png" alt="">
            <img src="assets/images/payment4.png" alt="">
            <img src="assets/images/payment5.png" alt="">
            <img src="assets/images/payment6.png" alt="">
        </div>
    </div>
</div>

        </div>
    </div>
</section>




   <!-- Best Seller -->
<section class="best-seller">
    <img src="<?php echo get_template_directory_uri() . '/images/Vector.png' ?>" class="img-fluid wave-line" alt="">
    <div class="container-fluid">
        <div class="seller-head text-center">
            <h1>Best Seller</h1>
        </div>

        <div class="row pro-row">
            <?php
            // the query
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 4,
            );

            $the_query = new WP_Query($args);

            if ($the_query->have_posts()) :
                while ($the_query->have_posts()) : $the_query->the_post();
                    global $product; // Make sure to use global $product

                    ?>
                    <div class="col-lg-3 col-sm-6 col-6">
                        <div class="seller-card">
                            <figure>
                                <div class="productImg">
                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-fluid" alt="">
                                </div>

                                <ul class="badge-group">
                                    <li>
                                        <p>Best<br>
                                            Seller</p>
                                    </li>
                                    <!-- Add other badges or labels as needed -->
                                </ul>
                            </figure>

                            <div class="seller-body">
                                <a href="<?php the_permalink(); ?>">
                                    <h4 class="mb-3"><?php the_title(); ?></h4>
                                </a>
                                <p class="mb-3"><?php echo get_the_excerpt(); ?></p>
                                <p class="mb-3"><?php echo $product->get_price_html(); ?></p>
                                <a href="<?php echo esc_url(get_permalink()); ?>" class="btn">Add to cart <span
                                            class="ms-2">+</span></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); // Reset the post data after the loop
            endif;
            ?>
        </div>

        <div class="discover">
            <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn">Discover More</a>
        </div>
    </div>
</section>
<!-- Best Seller End-->


    <!-- Mobile card -->
    <section class="best-seller cart-product mobile-card">
        <div class="container-fluid">
            <div class="seller-head text-center ">
                <h1>Find more collections</h1>
            </div>

            <div class="row pro-row justify-content-center">
                <div class="col-lg-3  col-8">
                    <div class="seller-card">
                        <figure>
                            <div class="productImg">
                                <img src="assets/images/homeproduct.png" class="img-fluid" alt="">
                            </div>
                            <ul class="badge-group">
                                <li>
                                    <p>Best<br>
                                        Seller</p>
                                </li>
                                <li>
                                    <span>pure</span>
                                    <p>Vegan</p>
                                    <span>one</span>
                                </li>
                                <li class="bg">
                                    <img src="assets/images/leaf-icon.png" class="img-fluid" alt="">
                                    <span>Natural</span>
                                </li>
                            </ul>
                        </figure>

                        <div class="seller-body">
                            <a href="#">
                                <h4 class="mb-3">Fortify Masque</h4>
                            </a>
                            <p class="mb-3">Lorem ipsum dolor sit amet consectetur.</p>
                            <p class="mb-3">$ 55.36</p>
                            <a href="#" class="btn">Add to cart <span class="ms-2">+</span></a>
                        </div>
                    </div>
                </div>
               
            </div>

            <div class="discover">
                <a href="#" class="btn">Discover More</a>
            </div>
        </div>
    </section>

    <!-- Mobile card end -->

    <!-- Footer -->

    <footer>
        <div class="container-fluid">
            <div class="row  justify-content-between pb-3">
                <div class="col-xl-2 col-lg-3">
                    <a href="#" class="footerlogo"><img src="assets/images/footerlogo.png" class="img-fluid" alt=""></a>

                </div>
                <div class="col-xl-4 col-lg-5">
                    <h4>Subscribe to our newsletter</h4>
                    <form action="">
                        <div class="form"><input type="text" class="form-control" placeholder="Enter your email here">
                            <button class="btn">Submit <img src="assets/images/plane.png" class="ms-2" alt=""></button>
                        </div>

                        <label>
                            <input type="checkbox"><span>By entering your email you confirm you have read the Privacy
                                Policy
                                and you agree to receive (just great) emails from Fler.</span>
                        </label>
                    </form>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <ul class="quicklink">
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Shop</a></li>
                        <li><a href="#">Journal</a></li>
                        <li><a href="#">Ingredients</a></li>
                        <li><a href="#">FAQ’s</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Become a Distributor</a></li>
                    </ul>
                </div>
            </div>
            <img src="assets/images/footervector.png" class="img-fluid wave-line" alt="">


            <div class="row footer-bottom justify-content-between mt-5">
                <div class="col-xl-2 col-lg-3">
                    <p class="copyright">© 2023 Oserth | All rights reserved</p>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="footer-payment d-flex justify-content-between">
                        <p>Secure payments</p>

                        <figure class="d-flex justify-content-between align-items-center">
                            <img src="assets/images/paymentimg.png" alt="">
                            <img src="assets/images/payment1.png" alt="">
                            <img src="assets/images/payment2.png" alt="">
                            <img src="assets/images/payment3.png" alt="">
                            <img src="assets/images/payment4.png" alt="">
                            <img src="assets/images/payment5.png" alt="">
                            <img src="assets/images/payment6.png" alt="">
                        </figure>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <ul class="termlinks">
                        <li><a href="#">terms & conditions</a></li>
                        <li><a href="#">privacy policy</a></li>
                        <li><a href="#">cookie policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->



    <!-- Mobile navbar -->

    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileNav" aria-labelledby="mobileNavLabel">
        <div class="offcanvas-header">
            <!-- <h5 class="offcanvas-title" id="mobileNavLabel">Offcanvas</h5> -->
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="searchbox-mobile">
                <input type="search" class="form-control" placeholder="search">
                <button class="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <ul class="link-mobile">
                <li>
                    <a href="product.html" class="mobile-link">Shop</a>
                    <div class="accordion" id="mobileDropdown">
                        <div class="accordion-item">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#highlight" aria-expanded="false" aria-controls="highlight">
                                Highlight
                            </button>
                            <div id="highlight" class="accordion-collapse collapse" data-bs-parent="#mobileDropdown">
                                <div class="accordion-body">
                                    <ul>
                                        <li><a href="#">All Products</a></li>
                                        <li><a href="#">Best Sellers</a></li>
                                        <li><a href="#">New Arrivals</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#productType" aria-expanded="false" aria-controls="productType">
                                Product Types
                            </button>
                            <div id="productType" class="accordion-collapse collapse" data-bs-parent="#mobileDropdown">
                                <div class="accordion-body">
                                    <ul>
                                        <li><a href="#">Shampoo </a></li>
                                        <li><a href="#">Hair Mask</a></li>
                                        <li><a href="#">Leave-in</a></li>
                                        <li><a href="#">Hair Oil</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collection" aria-expanded="false" aria-controls="collection">
                                Collection
                            </button>
                            <div id="collection" class="accordion-collapse collapse" data-bs-parent="#mobileDropdown">
                                <div class="accordion-body">
                                    <ul>
                                        <li><a href="#">Fortify</a></li>
                                        <li><a href="#">Restore</a></li>
                                        <li><a href="#">Smooth</a></li>
                                        <li><a href="#">Volume</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#hairType" aria-expanded="false" aria-controls="hairType">
                                Hair Types
                            </button>
                            <div id="hairType" class="accordion-collapse collapse" data-bs-parent="#mobileDropdown">
                                <div class="accordion-body">
                                    <ul>
                                        <li><a href="#">Dry Hair</a></li>
                                        <li><a href="#">Frizzy Hair</a></li>
                                        <li><a href="#">Damaged Hair</a></li>
                                        <li><a href="#">Oily & Greasy Hair</a></li>
                                        <li><a href="#">Hair Loss </a></li>
                                        <li><a href="#">Sensitive Scalp </a></li>
                                        <li><a href="#">Oily or Dry Scalp </a></li>
                                        <li><a href="#">Fine Thin Hair </a></li>
                                        <li><a href="#">Flat Hair</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li> <a href="#" class="mobile-link">About us</a></li>
                <li>
                    <a href="journal.html" class="mobile-link">Journal</a>
                </li>
                <li>
                    <a href="Our-Ingredients.html" class="mobile-link">Ingredients</a>
                </li>
                <li>
                    <a href="contact.html" class="mobile-link">Contact us</a>
                </li>
            </ul>
            <div class="foot-mobilenav">
                <a href="#" class="oserth-email">hello@oserth.com</a>
                <ul class="social-link mt-2 mb-2">
                    <li>
                        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>

                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-pinterest"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                    </li>
                </ul>
                <img src="assets/images/navfoot.png" class="img-fluid" alt="">
            </div>
        </div>
    </div>

    <!-- Mobile navbar End-->


    <!-- My Cart Mobile -->
    <section class="mobilecart">
        <!-- <button class="btn btn-primary" type="button"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
        aria-controls="offcanvasRight">Toggle right offcanvas</button> -->

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">

                <h5 id="offcanvasRightLabel">Cart</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="head">
                    <img src="assets/images/cartheader.png" alt="">
                    <p>User Name</p>
                </div>


                <div class="cart-deta">
                    <div class="cart-data d-flex mb-4">
                        <img src="assets/images/cartoil.png" alt="">
                        <div class="cart-cont">
                            <h4>Oserth Fortify</h4>
                            <p>Smooth Shampoo 300ml</p>
                        </div>
                        <a href="#"><i class="fa-solid fa-x"></i></a>
                    </div>

                    <div class="cart-data d-flex mb-4">
                        <img src="assets/images/cartoil.png" alt="">
                        <div class="cart-cont">
                            <h4>Oserth Fortify</h4>
                            <p>Smooth Shampoo 300ml</p>
                        </div>
                        <a href="#"><i class="fa-solid fa-x"></i></a>
                    </div>


                    <div class="cart-data d-flex mb-4">
                        <img src="assets/images/cartoil.png" alt="">
                        <div class="cart-cont">
                            <h4>Oserth Fortify</h4>
                            <p>Smooth Shampoo 300ml</p>
                        </div>
                        <a href="#"><i class="fa-solid fa-x"></i></a>
                    </div>

                    <div class="cart-data d-flex mb-4">
                        <img src="assets/images/cartoil.png" alt="">
                        <div class="cart-cont">
                            <h4>Oserth Fortify</h4>
                            <p>Smooth Shampoo 300ml</p>
                        </div>
                        <a href="#"><i class="fa-solid fa-x"></i></a>
                    </div>
                </div>



                <div class="cart-add">
                    <div class="cart-data cart-data1 d-flex mb-4">
                        <img src="assets/images/cartshampoo.png" alt="">
                        <div class="cart-cont">
                            <h4>Oserth Fortify</h4>
                            <p>$ 54.00</p>
                        </div>
                        <div class="add-action">
                            <button class="btn">add</button>
                        </div>
                    </div>

                    <div class="cart-data cart-data1 d-flex mb-4">
                        <img src="assets/images/cartshampoo.png" alt="">
                        <div class="cart-cont">
                            <h4>Oserth Fortify</h4>
                            <p>$ 54.00</p>
                        </div>
                        <div class="add-action">
                            <button class="btn">add</button>
                        </div>
                    </div>

                    <div class="cart-data cart-data1 d-flex mb-4">
                        <img src="assets/images/cartshampoo.png" alt="">
                        <div class="cart-cont">
                            <h4>Oserth Fortify</h4>
                            <p>$ 54.00</p>
                        </div>
                        <div class="add-action">
                            <button class="btn">add</button>
                        </div>
                    </div>
                </div>


                <div class="cart-buttons">
                    <p>Currency</p>
                    <div class="buttons">
                        <button class="btn">USD</button>
                        <button class="btn">AED</button>
                        <button class="btn">GBP</button>
                    </div>
                </div>

                <div class="checkout">
                    <button class="btn">Checkout . $200</button>
                </div>
            </div>
        </div>
    </section>
    <!-- My Cart Mobile End -->

</body>

</html>
<?php get_footer(); ?>
