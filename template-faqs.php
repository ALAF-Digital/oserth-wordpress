<?php

/**
 * Template Name: FAQ's
 */
?>


<?php get_header('secondary'); ?>

<!-- moblie-section -->
<section class="product-content about-content about-mobile">
    <div class="container-fluid">
        <div class="detail-head head-mobile d-flex align-items-center">
            <p>Home</p>
            <i class="fa-solid fa-greater-than"></i>
            <p>FAQs</p>

        </div>
    </div>
</section>
<!-- moblie-section End-->

<section class="Journaldetails">
    <div class="cart-banner thankbanner" style="--bgimg:url('<?php the_post_thumbnail_url(); ?>')">
        <div class="container">
            <div class="col-md-3">
                <h1><?php the_title() ?></h1>
            </div>
        </div>
    </div>

</section>

<section class="thankcontent ingredients">
    <img src="<?php echo get_template_directory_uri() . '/images/faqsvector.png' ?>" class="img-fluid wave-line" alt="">
    <div class="container-fluid">
        <div class="detail-head web-head d-flex align-items-center ms-3">
            <p>Home</p>
            <i class="fa-solid fa-greater-than"></i>
            <p>FAQs</p>

        </div>
    </div>

    <div class="container">
        <div class="ingredients-heading faqs-heading">
            <h1><?php the_content() ?></h1>
        </div>


        <div class="faqs-accordion">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="accordion-heading">
                            <h1><?php the_field('returns_&_cancelation') ?></h1>
                        </div>
                        <?php
                        $first_iteration = true;
                        if (have_rows('returns_Content')) :
                            while (have_rows('returns_Content')) : the_row();
                                // Get sub field values.
                                $heading = get_sub_field('question');
                                $desc = get_sub_field('description');
                        ?>
                                <div class="accordion-item">
                                    <?php
                                    $collapseClass = $first_iteration ? 'show' : '';
                                    ?>
                                    <h2 class="accordion-header" id="returns-heading-<?php echo get_row_index(); ?>">
                                        <button class="accordion-button <?php echo $collapseClass; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#returns-collapse-<?php echo get_row_index(); ?>" aria-expanded="false" aria-controls="returns-collapse-<?php echo get_row_index(); ?>">
                                            <?php echo $heading ?>
                                        </button>
                                    </h2>
                                    <div id="returns-collapse-<?php echo get_row_index(); ?>" class="accordion-collapse collapse <?php echo $collapseClass; ?>" aria-labelledby="returns-heading-<?php echo get_row_index(); ?>" data-bs-parent="#returns-accordion">
                                        <div class="accordion-body">
                                            <p>
                                                <?php echo $desc ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        <?php
                                $first_iteration = false;
                            endwhile;
                        endif;
                        wp_reset_query();
                        ?>
                    </div>

                    <div class="col-lg-6">
                        <div class="accordion-heading">
                            <h1><?php the_field('shopping_&_order') ?></h1>
                        </div>
                        <?php
                        $second_iteration = true;
                        if (have_rows('Shopping_Content')) :
                            while (have_rows('Shopping_Content')) : the_row();
                                // Get sub field values.
                                $heading = get_sub_field('question');
                                $desc = get_sub_field('description');
                        ?>
                                <div class="accordion-item">
                                    <?php
                                    $collapseClass = $second_iteration ? 'show' : '';
                                    ?>
                                    <h2 class="accordion-header" id="shopping-heading-<?php echo get_row_index(); ?>">
                                        <button class="accordion-button <?php echo $collapseClass; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#shopping-collapse-<?php echo get_row_index(); ?>" aria-expanded="false" aria-controls="shopping-collapse-<?php echo get_row_index(); ?>">
                                            <?php echo $heading ?>
                                        </button>
                                    </h2>
                                    <div id="shopping-collapse-<?php echo get_row_index(); ?>" class="accordion-collapse collapse <?php echo $collapseClass; ?>" aria-labelledby="shopping-heading-<?php echo get_row_index(); ?>" data-bs-parent="#shopping-accordion">
                                        <div class="accordion-body">
                                            <p>
                                                <?php echo $desc ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        <?php
                                $second_iteration = false;
                            endwhile;
                        endif;
                        wp_reset_query();
                        ?>
                    </div>



                    <div class="col-lg-6">
                        <div class="accordion-heading">
                            <h1><?php the_field('Brand') ?></h1>
                        </div>
                        <?php
                        $first_iteration = true;
                        if (have_rows('brand_content')) :
                            while (have_rows('brand_content')) : the_row();
                                // Get sub field values.
                                $heading = get_sub_field('question');
                                $desc = get_sub_field('description');
                        ?>
                                <div class="accordion-item">
                                    <?php
                                    $collapseClass = $first_iteration ? 'show' : '';
                                    ?>
                                    <h2 class="accordion-header" id="brand-heading-<?php echo get_row_index(); ?>">
                                        <button class="accordion-button <?php echo $collapseClass; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#brand-collapse-<?php echo get_row_index(); ?>" aria-expanded="false" aria-controls="brand-collapse-<?php echo get_row_index(); ?>">
                                            <?php echo $heading ?>
                                        </button>
                                    </h2>
                                    <div id="brand-collapse-<?php echo get_row_index(); ?>" class="accordion-collapse collapse <?php echo $collapseClass; ?>" aria-labelledby="brand-heading-<?php echo get_row_index(); ?>" data-bs-parent="#brand-accordion">
                                        <div class="accordion-body">
                                            <p>
                                                <?php echo $desc ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        <?php
                                $first_iteration = false;
                            endwhile;
                        endif;
                        wp_reset_query();
                        ?>
                    </div>







                    <div class="col-lg-6">
                        <div class="accordion-heading">
                            <h1><?php the_field('Distribution enquiry') ?></h1>
                        </div>
                        <?php
                        $second_iteration = true;
                        if (have_rows('Distribution_Content')) :
                            while (have_rows('Distribution_Content')) : the_row();
                                // Get sub field values.
                                $heading = get_sub_field('question');
                                $desc = get_sub_field('description');
                        ?>
                                <div class="accordion-item">
                                    <?php
                                    $collapseClass = $second_iteration ? 'show' : '';
                                    ?>
                                    <h2 class="accordion-header" id="distribution-heading-<?php echo get_row_index(); ?>">
                                        <button class="accordion-button <?php echo $collapseClass; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#distribution-collapse-<?php echo get_row_index(); ?>" aria-expanded="false" aria-controls="distribution-collapse-<?php echo get_row_index(); ?>">
                                            <?php echo $heading ?>
                                        </button>
                                    </h2>
                                    <div id="distribution-collapse-<?php echo get_row_index(); ?>" class="accordion-collapse collapse <?php echo $collapseClass; ?>" aria-labelledby="distribution-heading-<?php echo get_row_index(); ?>" data-bs-parent="#distribution-accordion">
                                        <div class="accordion-body">
                                            <p>
                                                <?php echo $desc ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        <?php
                                $second_iteration = false;
                            endwhile;
                        endif;
                        wp_reset_query();
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
</section>



<?php get_footer(); ?>