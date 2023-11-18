 <!-- Desktop Only -->
 <?php
    $the_query = new WP_Query(array(
        'offset' => 1,
    ));

    if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post(); ?>

         <div id="journalDesktopCard" class="col-lg-4">
             <div class="journal-card">
                 <a href="<?php the_permalink(); ?>"> <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid" alt=""></a>
                 <div class="joural-cardText">
                     <a href="<?php the_permalink(); ?>">
                         <h3><?php the_title(); ?></h3>
                     </a>
                     <a href="<?php the_permalink(); ?>" class="card-action"> <?php
                                                                                $categories = get_the_category();
                                                                                echo esc_html($categories[0]->name);
                                                                                ?></a>
                     <a href="<?php the_permalink(); ?>">
                         <p><?php the_excerpt() ?> </p>
                     </a>
                 </div>
             </div>
         </div>

 <?php endwhile;
    endif; 
   ?>