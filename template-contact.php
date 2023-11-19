<?php

/**
 * Template Name: Contact Us
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

    <section class="cart-content contact">
        <img src="<?php echo get_template_directory_uri() . '/images/faqsvector.png" class="img-fluid wave-line'?>" alt="">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="get-inTouch">
                        <h3>Get in touch with us</h3>
                        <p>Questions, advice, ideas. Your voice matters, make it heard here</p>

                        <?php echo do_shortcode('[contact-form-7 id="8f84f3d" title="Contact us"]')?>
                        <!-- <form action="">
                            <input type="text" class="text form-control" placeholder="Name*" required>


                            <input type="text" class="text form-control" placeholder="Email*" required>


                            <input type="number" class="text form-control" placeholder="Phone number*" required>


                            <div class="dropdown">
                                <button class="block d-flex justify-content-between align-items-center" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    I’m contacting for
                                    <i class="fa-solid fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu1" aria-labelledby="">
                                    <li><a class="dropdown-item" href="#">I’m contacting for</a></li>
                                    <li><a class="dropdown-item" href="#">I’m contacting for</a></li>
                                    <li><a class="dropdown-item" href="#">I’m contacting for</a></li>
                                </ul>
                            </div>

                            <textarea class="text form-control" rows="5" placeholder="Message" required></textarea>

                            <button class="btn" type="submit">Send Message<i
                                    class="fa-solid fa-arrow-right ms-2"></i></button>
                        </form> -->
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="contact-info">
                        <h3><?php the_field('contact')?></h3>
                        <p class="para"><?php the_field('para')?></p>

                        <div class="contact-details">
                            <p class="sec">Contact :</p>
                            
                            <?php the_content()?>
                            <p class="email"></a></p>
                        </div>

                        <div class="contact-icons">
                            <p>Connect with Us</p>
                            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php get_footer(); ?>