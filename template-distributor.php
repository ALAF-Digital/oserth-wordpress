<?php

/**
 * Template Name: Distributor
 */
?>

<?php get_header('secondary'); ?>

    <!-- moblie-section -->
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
        <div class="cart-banner thankbanner" style="--bgimg:url('<?php the_post_thumbnail_url(); ?>')">
            <div class="container">
                <div class="col-md-3">
                    <h1><?php the_title()?></h1>
                </div>
            </div>
        </div>

    </section>

    <section class="cart-content contact distribution">

        <img src="<?php echo get_template_directory_uri() . '/images/faqsvector.png'?>" class="img-fluid wave-line" alt="">


        <div class="container-fluid">

            <div class="get-inTouch distribution-content">
                <?php the_content()?>

                
                <?php echo do_shortcode('[contact-form-7 id="2909d50" title="Distributor"]')?>
                    <!-- <div class="col-lg-6">
                        <div class="first">
                            <input type="text" class="text form-control" placeholder="First name*" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="first">
                            <input type="text" class="text form-control" placeholder="Last name*" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="first">
                            <input type="text" class="text form-control" placeholder="Email*" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="first">
                            <input type="number" class="text form-control" placeholder="Phone number*" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="dropdown">
                            <button class="block d-flex justify-content-between align-items-center" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                City, Countrey
                                <i class="fa-solid fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu1" aria-labelledby="">
                                <li><a class="dropdown-item" href="#">City, Countrey</a></li>
                                <li><a class="dropdown-item" href="#">City, Countrey</a></li>
                                <li><a class="dropdown-item" href="#">City, Countrey</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="dropdown">
                            <button class="block d-flex justify-content-between align-items-center" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Nature of the business
                                <i class="fa-solid fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu1" aria-labelledby="">
                                <li><a class="dropdown-item" href="#">Nature of the business</a></li>
                                <li><a class="dropdown-item" href="#">Nature of the business</a></li>
                                <li><a class="dropdown-item" href="#">Nature of the business</a></li>
                            </ul>
                        </div>
                    </div>

                    <textarea class="text form-control" rows="5" placeholder="Message" required></textarea>

                    <button class="btn" type="submit">Send Message<i class="fa-solid fa-arrow-right ms-2"></i></button> -->
                
            </div>
        </div>
    </section>




    <?php get_footer(); ?>