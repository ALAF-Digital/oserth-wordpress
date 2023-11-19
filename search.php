<?php

/**
 * Search result page.
 */

get_header('secondary');
global $wp_query;
?>


<!-- moblie-section -->
<section class="product-content about-content about-mobile">
    <div class="container-fluid">
        <div class="detail-head head-mobile d-flex align-items-center">
            <p>Home</p>
            <i class="fa-solid fa-greater-than"></i>
            <p>12 results for "<?php the_search_query(); ?>"</p>
        </div>
    </div>
</section>
<!-- moblie-section End-->



<!-- Journal -->

<section class="journal search">

    <div class="container">
        <div class="journal-heading search-heading text-center mt-3">
            <h3>Search</h3>
            <p><?php _e( '12 results for', 'locale' ); ?>: "<?php the_search_query(); ?>"</p>
        </div>
        <!-- Mobile Category -->
        <section class="canva-category">
            <div class="canava">
                <button class="btn canvabutton search-canva" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Sort by
                    <i class="fa-solid fa-angle-down"></i>
                </button>

                <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">

                    <div class="offcanvas-body small">
                        <button class="btn">Featured</button>
                        <button class="btn">Best selling</button>
                        <button class="btn">Alphabetically, A-Z</button>
                        <button class="btn">Alphabetically, Z-A</button>
                        <button class="btn">Price, low to high </button>
                        <button class="btn">Price, high to low </button>
                        <button class="btn">Date, old to new </button>
                        <button class="btn">Date, new to old</button>
                    </div>
                </div>

            </div>
        </section>
        <!-- Mobile Category End-->

        <div class="row">
       
        <?php 
         $the_query = new WP_Query(array(
        ));
        if (have_posts()) {
                while (have_posts()) : the_post(); ?>
            <div class="col-lg-4 col-sm-6 col-6">
                <div class="journal-card">
                    <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid" alt="">
                    <div class="joural-cardText">
                        <h3><?php the_title(); ?></h3>
                        <a href="<?php the_permalink(); ?>" class="card-action"> <?php
                            $categories = get_the_category();
                            echo esc_html($categories[0]->name);
                            ?></a>
                        <p><?php the_excerpt() ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; }
			else { ?>
				<p> No Results </p>
			<?php }
			?>



            <div class="more-result">
                <a href="#" class="result">more results</a>
                <a href="#" class="one">1</a>
                <a href="#" class="one">2</a>
                <a href="#" class="one">3</a>
                <a href="#" class="one">4</a>
                <a href="#" class="one">5</a>
                <a href="#" class="one"><i class="fa-solid fa-arrow-right"></i></a>

            </div>
        </div>
        <img src="<?php echo get_template_directory_uri() . '/images/Vector.png' ?>" class="img-fluid wave-line" alt="">

    
</section>
<!-- Journal End-->

<!-- join-oserth -->

<section class="join-oserth search-bottom" style="--bgimg:url(../images/joinbanner.png) ;">

    <div class="container-fluid">

        <div class="join-content">
            <h3>Join Oserth World</h3>
            <p>Lörem ipsum nivining tresa exopåmin. Kad min i sott månade.</p>
            <form>
                <div class="join-input d-flex">
                    <input type="text" class="text form-control" placeholder="Enter your email here" required>
                    <button type="submit" class="d-flex  align-items-center">Submit <img src="<?php echo get_template_directory_uri() . '/images/joinicon.png'?>" class="ms-2 " alt=""></button>
                </div>
            </form>
        </div>

    </div>
</section>


<!-- join-oserth end-->


<?php get_footer(); ?>