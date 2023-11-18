<?php get_header('secondary'); ?>

<!-- moblie-section -->
<section class="product-content about-content about-mobile">
    <div class="container-fluid">
        <div class="detail-head head-mobile d-flex align-items-center">
            <p>Home</p>
            <i class="fa-solid fa-greater-than"></i>
            <p>Journal</p>
            <i class="fa-solid fa-greater-than"></i>
            <p><?php the_title(); ?></p>
        </div>
    </div>
</section>
<!-- moblie-section End-->

<section class="Journaldetails">
    <div class="Journaldetails-banner" style="--bgimg:url('<?php the_post_thumbnail_url(); ?>')">

    </div>
</section>

<section class="cart-content Journaldetails-content">
    <img src="assets/images/faqsvector.png" class="img-fluid wave-line" alt="">

    <div class="container-fluid">
        <div class="detail-head web-head d-flex align-items-center ms-3">
            <p>Home</p>
            <i class="fa-solid fa-greater-than"></i>
            <p>Journal</p>
            <i class="fa-solid fa-greater-than"></i>
            <p><?php the_title(); ?></p>
        </div>
    </div>
    <div class="container">
        <div class="journaldetail-heading">
            <?php the_content() ?>

        </div>
    </div>

</section>
<section class="journaldetail-Img" style="--bgimg:url('<?php the_field('image') ?>') ;">

</section>

<section class="journalPara-section">
    <div class="container">
        <div class="journal-para">
            <?php the_field('content') ?>
        </div>
    </div>
    <img src="<?php echo get_template_directory_uri() . '/images/Vector.png' ?>" class="img-fluid wave-line" alt="">
</section>

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


<?php get_footer(); ?>