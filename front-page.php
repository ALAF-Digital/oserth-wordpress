<?php get_header(); ?>

<!-- Hero Section -->

<section class="main-hero" style="--bgimg:url(../images/mainbg.png)">

    <div class="swiper ">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="<?php echo get_template_directory_uri() . '/images/mainheroimg.png' ?>" alt="" class="main-img">
                <div class="container">
                    <div class="col-lg-5">
                        <div class="text-caption">
                            <h1>Get Perfect Hair</h1>
                            <p>Your hair is the crown you never take off ut posueree stibulum tempus</p>
                            <a href="#" class="btn  btn-theme">Explore Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide" style="background-image: url(<?php echo get_template_directory_uri() . '/images/sliderbg1.png'; ?>);">
                <div class="container">
                    <div class="col-lg-5">
                        <div class="text-caption">
                            <h1>Get Perfect Hair</h1>
                            <p>Your hair is the crown you never take off ut posueree stibulum tempus</p>
                            <a href="#" class="btn  btn-theme">Explore Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide" style="background-image: url(<?php echo get_template_directory_uri() . '/images/sliderbg2.png'; ?>);">
                <div class="container">
                    <div class="col-lg-5">
                        <div class="text-caption">
                            <h1>Get Perfect Hair</h1>
                            <p>Your hair is the crown you never take off ut posueree stibulum tempus</p>
                            <a href="#" class="btn  btn-theme">Explore Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
<!-- Hero Section End-->

<!-- About Section -->
<section class="about-section">

    <div class="container-fluid">
        <?php
        if (have_rows('essence_of_oserth_banner')) :
            while (have_rows('essence_of_oserth_banner')) : the_row();
                // Get sub field values.

                // $Image = get_sub_field('image');
                $heading = get_sub_field('main_heading');
                $para = get_sub_field('main_paragraph');

        ?>
                <div class="essence-head text-center">
                    <h1><?php echo $heading ?></h1>
                    <p class="mt-3"><?php echo $para ?></p>
                </div>
        <?php endwhile;
        endif; ?>
        <div class="row mt-4">

            <div class="col-md-4 col-6 ">
            <?php
            if (have_rows('essence_of_oserth_content', 'option')) :
                while (have_rows('essence_of_oserth_content' , 'option')) : the_row();
                    // Get sub field values.

                    $image = get_sub_field('image');
                    $head = get_sub_field('heading');
                    $desc = get_sub_field('description');
            ?>
                        <div class="essence-friendly mb-5">
                            <img src="<?php echo $image ?>" class="img-fluid" alt="">
                            <h3><?php echo $head ?></h3>
                            <p class="friendly-para"><?php echo $desc ?></p>
                        </div>
                <?php endwhile;
                endif;
                wp_reset_query(); ?>
            </div>

            <?php
            if (have_rows('essence_of_oserth_banner')) :
                while (have_rows('essence_of_oserth_banner')) : the_row();
                    // Get sub field values.

                    $mainImage = get_sub_field('main_banner');
            ?>
                    <div class="col-md-4 essence-thumbnail">
                        <img src="<?php echo $mainImage ?>" class="img-fluid" alt="">
                    </div>
            <?php endwhile;
            endif;
            wp_reset_query(); ?>

            <div class="col-md-4 col-6  text-end">
            <?php
            if (have_rows('essence_of_oserth_content_right', 'option')) :
                while (have_rows('essence_of_oserth_content_right' , 'option')) : the_row();
                    // Get sub field values.

                    $image = get_sub_field('image');
                    $head = get_sub_field('heading');
                    $desc = get_sub_field('description');
            ?>
                        <div class="essence-friendly mb-5">
                            <img src="<?php echo $image ?>" class="img-fluid" alt="">
                            <h3><?php echo $head ?></h3>
                            <p class="friendly-para"><?php echo $desc ?></p>
                        </div>
                <?php endwhile;
                endif;
                wp_reset_query(); ?>

            </div>
        </div>
    </div>
</section>


<!-- About Section End -->



<!-- Best Seller -->
<section class="best-seller ">
    <img src="<?php echo get_template_directory_uri() . '/images/Vector.png' ?>" class="img-fluid wave-line" alt="">
    <div class="container-fluid">
        <div class="seller-head text-center ">
            <h1>Best Seller</h1>
        </div>

        <div class="row pro-row">
        <?php
            // the query
            $the_query = new WP_Query(array(
               'post_type'  => 'product',
               'posts_per_page' => 4,

            ));

            if ($the_query->have_posts()) :
               while ($the_query->have_posts()) : $the_query->the_post();
                  $product = wc_get_product(get_the_ID());
            ?>
            <div class="col-lg-3 col-sm-6 col-6">
                <div class="seller-card">
                    <figure>
                        <div class="productImg">
                            <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid" alt="">
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
                                <img src="<?php echo get_template_directory_uri() . '/images/leaf-icon.png' ?>" class="img-fluid" alt="">
                                <span>Natural</span>
                            </li>
                        </ul>
                    </figure>

                    <div class="seller-body">
                        <a href="<?php the_permalink(); ?>">
                            <h4 class="mb-3"><?php the_field('collection') ?></h4>
                        </a>
                        <p class="mb-3"><?php echo the_excerpt() ?></p>
                        <p class="mb-3">$ 55.36</p>
                        <a href="<?php the_permalink(); ?>" class="btn">Add to cart <span class="ms-2">+</span></a>
                    </div>
                </div>
            </div>
            <?php endwhile;
            endif;
            wp_reset_query();
            ?>
          

        </div>

        <div class="discover">
            <a href="product.html" class="btn">Discover More</a>
        </div>
    </div>
</section>
<!-- Best Seller End-->

<!-- Vegan Section -->
<?php
if (have_rows('vegan_section')) :
    while (have_rows('vegan_section')) : the_row();
        // Get sub field values.

        $Bgimage = get_sub_field('bg_image');
        $heading = get_sub_field('heading');
        $para = get_sub_field('para');
        $link = get_sub_field('action');
?>
        <section class="cta-section" style="--bgimg:url('<?php echo $Bgimage ?>')">
            <img src="<?php echo get_template_directory_uri() . '/images/wave1.png' ?>" class="img-fluid wave-line" alt="">
            <div class="container ">
                <div class="vegan-content ">
                    <h3><?php echo $heading ?></h3>

                    <a href="<?php echo $link ?>" class="btn">Choose your color</a>
                </div>
            </div>
        </section>
<?php endwhile;
endif;
wp_reset_query(); ?>
<!-- Vegan Section  End-->


<!-- Our Collection -->

<section class="our-collection">
    <div class="container-fluid">
        <?php
        if (have_rows('our_collectin')) :
            while (have_rows('our_collectin')) : the_row();
                // Get sub field values.

                $heading = get_sub_field('heading');
                $desc = get_sub_field('description');
        ?>
                <div class="collection-head text-center">
                    <h1><?php echo $heading ?></h1>
                    <p><?php echo $desc ?></p>
                </div>
        <?php endwhile;
        endif;
        wp_reset_query(); ?>
        <div class="slider">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php
                    if (have_rows('our_collection_card')) :
                        while (have_rows('our_collection_card')) : the_row();
                            // Get sub field values.

                            $CImage = get_sub_field('card_image');
                            $Ctitle = get_sub_field('card_title');
                            $Cdesc = get_sub_field('card_description');
                            $caction = get_sub_field('card_action');
                    ?>
                            <div class="swiper-slide">
                                <div class="collectionCard">
                                    <figure>
                                        <img src="<?php echo $CImage ?>" class="img-fluid small" alt="">

                                    </figure>

                                    <div class="card-body ">
                                        <h3><?php echo $Ctitle ?></h3>
                                        <p><?php echo $Cdesc ?></p>
                                        <a href="<?php echo $caction ?>" class="btn">Find more</a>
                                    </div>
                                </div>
                            </div>
                    <?php endwhile;
                    endif;
                    wp_reset_query(); ?>

                </div>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>

<!-- Our Collection End-->

<!-- Oue Collection Mobile -->

<section class="best-seller our-collection-mobile">
    <div class="container-fluid">
        <?php
        if (have_rows('our_collectin')) :
            while (have_rows('our_collectin')) : the_row();
                // Get sub field values.

                $heading = get_sub_field('heading');
                $desc = get_sub_field('description');
        ?>
                <div class="collection-head text-center">
                    <h1><?php echo $heading ?></h1>
                    <p><?php echo $desc ?></p>
                </div>
        <?php endwhile;
        endif;
        wp_reset_query(); ?>

        <div class="row pro-row">
            <?php
            if (have_rows('our_collection_card')) :
                while (have_rows('our_collection_card')) : the_row();
                    // Get sub field values.

                    $CImage = get_sub_field('card_image');
                    $Ctitle = get_sub_field('card_title');
                    $Cdesc = get_sub_field('card_description');
                    // $caction = get_sub_field('card_action');
            ?>
                    <div class="col-lg-3 col-sm-6 col-6">

                        <div class="seller-card">
                            <figure>
                                <div class="productImg">
                                    <img src="<?php echo $CImage ?>" class="img-fluid" alt="">
                                </div>

                            </figure>

                            <div class="seller-body">
                                <a href="product-details.html">
                                    <h4 class="mb-3"><?php echo $Ctitle ?></h4>
                                </a>
                                <p><?php echo $Cdesc ?></p>
                                <a href="<?php echo $caction ?>" class="btn">Find more</a>
                            </div>
                        </div>

                    </div>

            <?php endwhile;
            endif;
            wp_reset_query(); ?>
        </div>

    </div>
</section>

<!-- Oue Collection Mobile End -->

<!-- Our Brand -->
<section class="our-brand">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <?php
            if (have_rows('brand_story')) :
                while (have_rows('brand_story')) : the_row();
                    // Get sub field values.

                    $Mheading = get_sub_field('main_heading');
                    $Fimage = get_sub_field('first_image');
                    $Simage = get_sub_field('second_image');
                    $Sheading = get_sub_field('sub_heading');
                    $desc = get_sub_field('description');
                    $action = get_sub_field('action');
            ?>
                    <div class="col-md-6 ">
                        <div class="our-heading">
                            <h1><?php echo $Mheading ?></h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6 p-0">
                        <div class="brand-image">
                            <img src="<?php echo $Fimage ?>" alt="">
                        </div>
                    </div>


                    <div class="col-md-6 col-sm-6 col-6 p-0">
                        <div class="brand-image">
                            <img src="<?php echo $Simage ?>" alt="">
                        </div>
                    </div>

                    <div class="col-md-6 ">
                        <div class="our-heading1">
                            <h1><?php echo $Sheading ?></h1>
                            <p><?php echo $desc ?></p>

                            <a href="<?php echo $action ?>" class="btn">Know More</a>
                        </div>

                    </div>
            <?php endwhile;
            endif;
            wp_reset_query(); ?>
        </div>
    </div>

</section>

<!-- Our Brand End-->

<!-- Circle Images -->
<section class="circle-images">
    <div class="container-fluid">
        <ul class="circleimage">
            <?php
            if (have_rows('circle_image', 'option')) :
                while (have_rows('circle_image' , 'option')) : the_row();
                    // Get sub field values.

                    $image = get_sub_field('image');
            ?>
                    <li>
                        <img src="<?php echo $image ?>" alt="">
                    </li>
            <?php endwhile;
            endif;
            wp_reset_query(); ?>

            <li class="circle-group">
                <img src="<?php echo get_template_directory_uri() . '/images/circlegroup.png' ?>" alt="">
            </li>
        </ul>
    </div>

    <img src="<?php echo get_template_directory_uri() . '/images/Vector.png' ?>" class="img-fluid wave-line" alt="">
</section>
<!-- Circle Images End-->

<!-- join-oserth -->

<section class="join-oserth" style="--bgimg:url(../images/joinbanner.png) ;">

    <div class="container-fluid">

        <div class="join-content">
            <h3>Join Oserth World</h3>
            <p>Lörem ipsum nivining tresa exopåmin. Kad min i sott månade.</p>
            <form>
                <div class="join-input d-flex">
                    <input type="text" class="text form-control" placeholder="Enter your email here" required>
                    <button type="submit" class="d-flex  align-items-center">Submit <img src="assets/images/joinicon.png" class="ms-2 " alt=""></button>
                </div>
            </form>
        </div>

    </div>
</section>


<!-- join-oserth end-->

<!-- Join The Inspiration -->

<section class="Inspiration">
    <div class="container-fluid">
        <div class="head text-center">
            <h1>Join the Inspiration</h1>
            <a href="#">
                <i class="fa-brands fa-instagram"></i>
                Oserth
            </a>
        </div>

        <div class="Inspiration-content">

            <ul class="instimages">
                <?php
                if (have_rows('join_the_inspiration')) :
                    while (have_rows('join_the_inspiration')) : the_row();
                        // Get sub field values.

                        $image = get_sub_field('image');
                ?>
                        <li>
                            <img src="<?php echo $image ?>" alt="">
                        </li>
                <?php endwhile;
                endif;
                wp_reset_query(); ?>

            </ul>

        </div>
    </div>

</section>
<!-- Join The Inspiration End-->

<?php get_footer(); ?>