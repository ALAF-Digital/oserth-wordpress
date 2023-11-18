<?php get_header('secondary'); ?>

<section class="details journal">
    <div class="container-fluid">
        <div class="detail-head juournal-head d-flex align-items-center ms-3">
            <p>Home</p>
            <i class="fa-solid fa-greater-than"></i>
            <p>Journal</p>
        </div>
    </div>

    <div class="container">
        <div class="journal-heading text-center mt-3">
            <h3>Journal</h3>
            <p>For sensitive and dry scalp</p>
        </div>

        <?php
        $the_query = new WP_Query(array(
            'posts_per_page' => 1,
        ));

        if ($the_query->have_posts()) :
            while ($the_query->have_posts()) : $the_query->the_post(); ?>

                <div class="journal-mainImg">
                    <a href="<?php the_permalink(); ?>"> <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid" alt=""></a>
                    <div class="journal-mainText">
                        <a href="<?php the_permalink(); ?>">
                            <h3><?php the_title(); ?></h3>
                            <p><?php the_excerpt() ?></p>
                        </a>
                        <a href="<?php the_permalink(); ?>" class="journal-action">
                            <?php
                            $categories = get_the_category();
                            echo esc_html($categories[0]->name);
                            ?></a>
                    </div>
                </div>

        <?php endwhile;
        endif; 
        ?>


        <div class="row">

            <?php get_template_part('includes/content', 'desktopJournal'); ?>

            <?php get_template_part('includes/content', 'mobileJournal'); ?>

        </div>

    </div>
    <img src="<?php echo get_template_directory_uri() . '/images/Vector.png'?>" class="img-fluid wave-line" alt="">
</section>
<!-- Journal End-->


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