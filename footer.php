 <!-- Footer -->

 <footer>
     <div class="container-fluid">
         <div class="row  justify-content-between pb-3">

             <div class="col-xl-2 col-lg-3">
                 <a href="<?php echo get_site_url(); ?>" class="footerlogo"><img src="<?php echo get_template_directory_uri() . '/images/footerlogo.png' ?>" class="img-fluid" alt=""></a>

             </div>
             <div class="col-xl-4 col-lg-5">
                 <h4>Subscribe to our newsletter</h4>
                 <form action="">
                     <div class="form"><input type="text" class="form-control" placeholder="Enter your email here">
                         <button class="btn">Submit <img src="<?php echo get_template_directory_uri() . '/images/plane.png' ?>" class="ms-2" alt=""></button>
                     </div>

                     <label>
                         <input type="checkbox"><span>By entering your email you confirm you have read the
                             Privacy
                             Policy
                             and you agree to receive (just great) emails from Fler.</span>
                     </label>
                 </form>
             </div>

             <div class="col-xl-4 col-lg-4">
             <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'footer',
                                    'container' => 'ul',
                                    'menu_class' => "quicklink",
                                    'container_class'  => "",
                                )
                            );
                            ?>

                

                 <!-- <ul class="quicklink">
                         <li><a href="#">About us</a></li>
                         <li><a href="#">Shop</a></li>
                         <li><a href="#">Journal</a></li>
                         <li><a href="#">Ingredients</a></li>
                         <li><a href="FAQ's.html">FAQ’s</a></li>
                         <li><a href="#">Contact us</a></li>
                         <li><a href="login.html">Login</a></li>
                         <li><a href="distributor.html">Become a Distributor</a></li>
                     </ul> -->

             </div>

         </div>
         <img src="<?php echo get_template_directory_uri() . '/images/footervector.png' ?>" class="img-fluid wave-line" alt="">


         <div class="row footer-bottom justify-content-between mt-5">
             <div class="col-xl-2 col-lg-3">
                 <p class="copyright">© 2023 Oserth | All rights reserved</p>
             </div>
             <div class="col-xl-4 col-lg-5">
                 <div class="footer-payment d-flex justify-content-between">
                     <p>Secure payments</p>

                     <figure class="d-flex justify-content-between align-items-center">
                         <img src="<?php echo get_template_directory_uri() . '/images/paymentimg.png' ?>" alt="">
                         <img src="<?php echo get_template_directory_uri() . '/images/payment1.png' ?>" alt="">
                         <img src="<?php echo get_template_directory_uri() . '/images/payment2.png' ?>" alt="">
                         <img src="<?php echo get_template_directory_uri() . '/images/payment3.png' ?>" alt="">
                         <img src="<?php echo get_template_directory_uri() . '/images/payment4.png' ?>" alt="">
                         <img src="<?php echo get_template_directory_uri() . '/images/payment5.png' ?>" alt="">
                         <img src="<?php echo get_template_directory_uri() . '/images/payment6.png' ?>" alt="">
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




 <?php wp_footer(); ?>
 </body>

 </html>
 <!-- Library CDN -->
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

 <!-- Custom JS -->
 <!-- <script src="/js/script.js"></script> -->