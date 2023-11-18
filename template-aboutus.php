<?php

/**
 * Template Name: About Us
 */
?>
<?php get_header('secondary'); ?>

<!-- moblie-section -->
<section class="product-content about-content about-mobile">
    <div class="container-fluid">
        <div class="detail-head head-mobile d-flex align-items-center">
            <p>Home</p>
            <i class="fa-solid fa-greater-than"></i>
            <p>About us</p>
        </div>
    </div>
</section>
<!-- moblie-section End-->

<section class="product" style="--bgimg: url('<?php the_post_thumbnail_url(); ?>');">
    <div class="container">
        <div class="col-md-6 mx-auto">
            <div class="product-heading about-heading">
                <h1><?php the_field('page_title')?></h1>
            </div>
        </div>
    </div>
</section>

<section class="product-content about-content">
    <div class="container-fluid">
        <div class="detail-head about-head d-flex align-items-center ms-3">
            <p>Home</p>
            <i class="fa-solid fa-greater-than"></i>
            <p>About us</p>
        </div>
    </div>


    <div class="container">
        <div class="about-oserth">
            <p><?php the_content() ?></p>

            <div class="newlogo-Wrapper">
                <div class="tooltp">
                    <p>The Sky to guide us</p>
                    <span>Sky</span>
                    <div class="line"></div>
                </div>

                <div class="new-hover-logo">
                    <img src="<?php echo get_template_directory_uri() . '/images/logo-o.png' ?>" class="img-fluid" alt="">
                    <img src="<?php echo get_template_directory_uri() . '/images/logo-s.png' ?>" class="img-fluid" alt="">
                    <img src="<?php echo get_template_directory_uri() . '/images/logo-erth.png' ?>" class="img-fluid" alt="">
                </div>
                <div class="tooltiwrap">
                    <div class="tooltp tooltp2">
                        <div class="line"></div>
                        <span>Sky</span>
                        <p>The Sky to guide us</p>
                    </div>
                    <div class="tooltp tooltp3">
                        <div class="line"></div>
                        <span>Sky</span>
                        <p>The Sky to guide us</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            if (have_rows('about_us')) :
                while (have_rows('about_us')) : the_row();
                    // Get sub field values.

                    $heading = get_sub_field('heading');
                    $Collec = get_sub_field('collecttion');
                    $desc = get_sub_field('description');
                    // $caction = get_sub_field('card_action');
            ?>
                    <div class="col-lg-4">
                        <div class="about-card">
                            <div class="our-ocean">
                                <h3><?php echo $heading ?></h3>
                                <p class="collect"><?php echo $Collec ?></p>
                                <p class="inspire"><?php echo $desc ?></p>
                            </div>
                        </div>
                    </div>

            <?php endwhile;
            endif;
            wp_reset_query(); ?>



            <?php
            if (have_rows('our_body')) :
                while (have_rows('our_body')) : the_row();
                    // Get sub field values.

                    $content = get_sub_field('Our Body Content');
                    $image = get_sub_field('image');
            ?>
                    <div class="col-lg-6 d-flex justify-content-center align-items-center ">
                        <div class="our-body">
                            <h3><?php echo $content ?></h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="our-body-img">
                            <img src="<?php echo $image ?>" class="img-fluid" alt="">
                        </div>
                    </div>
            <?php endwhile;
            endif;
            wp_reset_query(); ?>
        </div>
    </div>
</section>


<section class="we-care">
    <div class="container">
        <div class="wecare-heading">
            <h1><?php the_field('we_care') ?></h1>
        </div>



        <div class="row">
            <?php
            if (have_rows('clean_beauty')) :
                while (have_rows('clean_beauty')) : the_row();
                    // Get sub field values.

                    $heading = get_sub_field('heading');
                    $para = get_sub_field('paragraph');
                    $image = get_sub_field('image');
            ?>
                    <div class="col-lg-6">
                        <div class="beautyImg">
                            <img src="<?php echo $image ?>" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-center align-items-center">
                        <div class="beauty-content">
                            <h3><?php echo $heading ?></h3>
                            <p><?php echo $para ?></p>
                        </div>
                    </div>
            <?php endwhile;
            endif;
            wp_reset_query(); ?>

        </div>

        <div class="row sustain">

            <?php
            if (have_rows('Sustainability')) :
                while (have_rows('Sustainability')) : the_row();
                    // Get sub field values.

                    $heading = get_sub_field('heading');
                    $para = get_sub_field('paragraph');
                    $image = get_sub_field('image');
            ?>
                    <div class="col-lg-6 order-lg-2">
                        <div class="beautyImg">
                            <img src="<?php echo $image ?>" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex justify-content-center align-items-center order-lg-1">
                        <div class="beauty-content">
                            <h3><?php echo $heading ?></h3>
                            <p><?php echo $para ?></p>
                        </div>
                    </div>
            <?php endwhile;
            endif;
            wp_reset_query(); ?>
        </div>

        <div class="row">
            <?php
            if (have_rows('Cruelty Free')) :
                while (have_rows('Cruelty Free')) : the_row();
                    // Get sub field values.

                    $heading = get_sub_field('heading');
                    $para = get_sub_field('paragraph');
                    $image = get_sub_field('image');
            ?>
                    <div class="col-lg-6">
                        <div class="beautyImg">
                            <img src="<?php echo $image ?>" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-center align-items-center">
                        <div class="beauty-content">
                            <h3><?php echo $heading ?></h3>
                            <p><?php echo $para ?></p>
                        </div>
                    </div>
            <?php endwhile;
            endif;
            wp_reset_query(); ?>
        </div>

        <div class="row cruelty">
            <?php
            if (have_rows('Cruelty')) :
                while (have_rows('Cruelty')) : the_row();
                    // Get sub field values.

                    $heading = get_sub_field('heading');
                    $para = get_sub_field('paragraph');
                    $image = get_sub_field('image');
            ?>
                    <div class="col-lg-6 order-lg-2">
                    <div class="beautyImg">
                            <img src="<?php echo $image ?>" class="img-fluid" alt="">
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex justify-content-center align-items-center order-lg-1">
                    <div class="beauty-content">
                            <h3><?php echo $heading ?></h3>
                            <p><?php echo $para ?></p>
                        </div>
                    </div>
            <?php endwhile;
            endif;
            wp_reset_query(); ?>
        </div>
    </div>
    </div>
</section>

<?php get_footer(); ?>