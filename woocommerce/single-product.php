<?php

get_header('secondary');

$product = wc_get_product(get_the_ID());
?>

<section class="details">
	<div class="container-fluid">

		<div class="detail-head d-flex align-items-center ms-3">
			<p>Home</p>
			<i class="fa-solid fa-greater-than"></i>
			<p>Products</p>
			<i class="fa-solid fa-greater-than"></i>
			<p><?php echo the_title() ?></p>
		</div>

	</div>


	<div class="container">
		<div class="detail-heading text-center mt-3">
			<div class="container-fluid notices-container">
	        <!-- This is where WooCommerce notices will be displayed -->
	    </div>
			<h3><?php echo the_title() ?></h3>
			<p><?php echo the_excerpt() ?></p>
			
		</div>

		<div class="row mt-5">
			<div class="col-lg-1 ">
				<div class="detail-side">
					<figure>
					<?php
                        $attachment_ids = $product->get_gallery_image_ids();
                        if ($attachment_ids) {
                            foreach ($attachment_ids as $attachment_id) {
                                echo '<a href="' . esc_url(wp_get_attachment_image_url($attachment_id, 'full')) . '" class="woocommerce-product-gallery__image">';
                                echo wp_get_attachment_image($attachment_id, 'woocommerce_thumbnail', false, array('class' => 'img-fluid'));
                                echo '</a>';
                            }
                        } else {
                            // Display placeholder image if no gallery images are available
                            echo '<a href="#"> <img src="' . get_template_directory_uri() . '/images/productview.png" alt=""></a>';
                        }
                        ?>
					</figure>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="swiper produuct-imgdetail">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<div class="seller-card proDetailImg ">
								<figure>
									<div class="promainImg">
										<?php $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'single-post-thumbnail');
										 	$image_url = $product_image[0]; 
									 	?>
										<img src="<?php echo esc_url($image_url); ?>" class="img-fluid" alt="">
									</div>
									<ul class="badge-group product-badge">
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
											<img src="assets/images/leaficon1.png" class="img-fluid" alt="">
											<span>Natural</span>
										</li>
									</ul>
								</figure>
							</div>
						</div>

						<div class="swiper-slide">
							<div class="seller-card proDetailImg ">
								<figure>
									<div class="promainImg">
										<img src="assets/images/prodetaillarge.png" class="img-fluid" alt="">
									</div>
									<ul class="badge-group product-badge">
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
											<img src="assets/images/leaficon1.png" class="img-fluid" alt="">
											<span>Natural</span>
										</li>
									</ul>
								</figure>
							</div>
						</div>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>

			<div class="col-lg-5">
				<div class="detail-content">
					<div class="details-buttons d-flex">
					    <?php
					    $attributes = $product->get_attributes();

					    foreach ($attributes as $attribute) {
					        $attribute_name = $attribute->get_name();
					        $attribute_values = $attribute->get_options();

					        if ($attribute_name === 'Size' || $attribute_name === 'Capacity') {
					            foreach ($attribute_values as $value) {
					                echo '<button class="me-3">' . esc_html($value) . '</button>';
					            }
					        }
					    }
					    ?>
					</div>

					<?php $currency_code = get_woocommerce_currency(); ?>
					<h3><?php echo $currency_code; ?>
					    <?php
					    $sale_price = $product->get_sale_price();
					    $regular_price = $product->get_price();

					    if (!empty($sale_price) && $sale_price != $regular_price) {
					        echo $sale_price;
					    } else {
					        echo $regular_price;
					    }
					    ?>
					</h3>

					<div class="review-icon d-flex align-items-center">
					    <?php
					    // Get the average rating and total number of reviews for the product
					    $average_rating = $product->get_average_rating();
					    $review_count = $product->get_review_count();
					    
					    for ($i = 1; $i <= 5; $i++) {
					        if ($i <= $average_rating) {
					            echo '<a href="#"><i class="fa-regular fa-star"></i></a>';
					        } else {
					            echo '<a href="#"><i class="fa-regular fa-star"></i></a>';
					        }
					    }
					    
					    // Output the review count
					    echo '<p>(' . $review_count . ' Reviews)</p>';
					    ?>
					</div>

					<div class="review-content">
						<p><?php echo the_content() ?></p>
						<p><strong>HAIR TYPE:</strong> <span><?php the_field('hair_type') ?></span></p>
						<p><strong>RESULTS:</strong><span><?php the_field('results') ?> </span></p>
						<div class="detail-container">

						</div>
						<div class="detail-action">
						    <a href="#" class="quantity-control" data-action="decrease">-</a>
						    <input type="number" name="quantity" value="1" class="quantity-input" />
						    <a href="#" class="quantity-control" data-action="increase">+</a>
						</div>
 						<button class="add-to-cart-btn" data-product-id="<?php echo get_the_ID(); ?>">Add to Cart <i class="fa-solid fa-bag-shopping ms-1"></i></button>
						<div class="delivery d-flex align-items-center">
							<img src="<?php echo get_template_directory_uri() . ' /images/truck.png' ?>" class="img-fluid me-1" alt="">
							<p><?php the_field('delivery') ?></p>
						</div>
						<div class="purchase d-flex align-items-center">
							<img src="<?php echo get_template_directory_uri() . '/images/purchaseicon.png' ?>" class="img-fluid me-1" alt="">
							<p><?php the_field('first_purchase') ?></p>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>


<section class="vegan-friendly">
	<div class="container-fluid">
		<div class="row ">
			<div class="col-lg-6 d-flex justify-content-between text-center ">
				<div class="essence-friendly essence-friendly1">
					<img src="assets/images/Group (1).png" class="img-fluid" alt="">
					<h3>Animal Friendly</h3>

				</div>
				<div class="essence-friendly essence-friendly1">
					<img src="assets/images/Group.png" class="img-fluid" alt="">
					<h3>Vegan Friendly</h3>

				</div>
				<div class="essence-friendly essence-friendly1">
					<img src="assets/images/Group (2).png" class="img-fluid" alt="">
					<h3>Clean Beauty</h3>
				</div>
			</div>

			<div class="col-lg-6 d-flex justify-content-between text-center ">
				<div class="essence-friendly essence-friendly1">
					<img src="assets/images/Green.png" class="img-fluid" alt="">
					<h3>I’m Green</h3>

				</div>
				<div class="essence-friendly essence-friendly1">
					<img src="assets/images/Sun.png" class="img-fluid" alt="">
					<h3>Made By Sun</h3>

				</div>
				<div class="essence-friendly essence-friendly1">
					<img src="assets/images/Recyclable.png" class="img-fluid" alt="">
					<h3>Recyclable</h3>

				</div>
			</div>
		</div>
	</div>
	</div>

</section>

<section class="Accordion-section">
	<div class="container-fluid" style="--bgimg:url(../images/signle-Ing-bg.png)">
		<div class="accordion-buttons">
			<div class="accordion accordion-flush" id="accordionFlushExample">
				<div class="accordion-item">
					<h2 class="accordion-header" id="flush-headingOne">
						<button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
							Key ingredients
						</button>
					</h2>
					<div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
						<div class="accordion-body">

							<div class="accordion-content">
								<div class="row">

									<div class="col-lg-4">
										<h4>01</h4>
										<h3>NIACINAMIDE</h3>
										<p>Vitamin B3
											<br> / evens out skin tone <br>
											/ reduces redness <br>
											/ minimizes pore size
										</p>
									</div>

									<div class="col-lg-4">
										<h4>02</h4>
										<h3>CERAMIDES</h3>
										<p>CERAMIDE NP
											<br> / PROTECT SKIN'S BARRIER <br>
											/ IMPROVE HYDRATION <br>
											/ SOOTHE THE SKIN
										</p>
									</div>

									<div class="col-lg-4">
										<h4>03</h4>
										<h3>BAKUCHIOL</h3>
										<p>SYTENOL® A
											<br> / BOOSTS CELL RENEWAL <br>
											/ SUPPORTS COLLAGEN <br>
											/ IMPROVES SKIN TONE
										</p>
									</div>

									<div class="col-lg-4">
										<h4>04</h4>
										<h3>HYALURONIC ACID</h3>
										<p>PRO-Vitamin B5
											<br>/ HYDRATES THE SKIN <br>
											/ OFFERS BARRIER PROTECTION <br>
											/ SOOTHES INFLAMMATION
										</p>
									</div>

									<div class="col-lg-4">
										<h4>05</h4>
										<h3>PEPTIDES</h3>
										<p>VEGAN
											<br>/ INCREASE SKIN FIRMNESS <br>
											/ BOOST COLLAGEN <br>
											/ ANTIOXIDANT PROTECTION
										</p>
									</div>

									<div class="col-lg-4">
										<h4>06</h4>
										<h3>VITAMIN C</h3>
										<p>SODIUM ASCORBYL PHOSPHATE
											<br>/ ANTIOXIDANT PROTECTION <br>
											/ BRIGHTENS DARK SPOTS <br>
											/ BOOSTS COLLAGEN
										</p>
									</div>
									<div class="col-lg-4">
										<h4>06</h4>
										<h3>VITAMIN C</h3>
										<p>SODIUM ASCORBYL PHOSPHATE
											<br>/ ANTIOXIDANT PROTECTION <br>
											/ BRIGHTENS DARK SPOTS <br>
											/ BOOSTS COLLAGEN
										</p>
									</div>
									<div class="col-lg-4">
										<h4>06</h4>
										<h3>VITAMIN C</h3>
										<p>SODIUM ASCORBYL PHOSPHATE
											<br>/ ANTIOXIDANT PROTECTION <br>
											/ BRIGHTENS DARK SPOTS <br>
											/ BOOSTS COLLAGEN
										</p>
									</div>
									<div class="col-lg-4">
										<h4>06</h4>
										<h3>VITAMIN C</h3>
										<p>SODIUM ASCORBYL PHOSPHATE
											<br>/ ANTIOXIDANT PROTECTION <br>
											/ BRIGHTENS DARK SPOTS <br>
											/ BOOSTS COLLAGEN
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="accordion-item">
					<h2 class="accordion-header" id="flush-headingTwo">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
							Benefits
						</button>
					</h2>
					<div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
						<div class="accordion-body">

						</div>
					</div>
				</div>
				<div class="accordion-item">
					<h2 class="accordion-header" id="flush-headingThree">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
							who's it for
						</button>
					</h2>
					<div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
						<div class="accordion-body">

						</div>
					</div>
				</div>

				<div class="accordion-item">
					<h2 class="accordion-header" id="flush-headingFour">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
							full ingredient list
						</button>
					</h2>
					<div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
						<div class="accordion-body">
						</div>
					</div>
				</div>

				<div class="accordion-item">
					<h2 class="accordion-header" id="flush-headingFive">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
							FAQ
						</button>
					</h2>
					<div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
						<div class="accordion-body">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>

<section class="productBGsection">
	<div class="product-panel col-7">
		<div class="productcontent">
			<div class="product-panel-text">
				<h1>HOW TO USE</h1>
				<p>Moisturizing and conditioning shampoo for dry, brittle, and frizzy hair. With active
					formula
					of calendula oil and marula oil, leaves your hair feeling soft, silky, hydrated and full
					of
					beautiful shine. Use: Apply on wet hair and massage in. Rinse thoroughly and repeat.
					Warnings: Keep out of reach of children. Avoid contact with eyes. Wash immediately in
					case
					of contact. Keep in cool dry place away from sunlight. External use.</p>
			</div>
			<div class="product-panel-images">
				<figure>
					
					<img src="<?php echo get_template_directory_uri() . '/images/productpanel.png'?>" alt="">
					<img src="<?php echo get_template_directory_uri() . '/images/productpanel1.png'?>" alt="">
					<img src="<?php echo get_template_directory_uri() . '/images/productpanel2.png'?>" alt="">
					<img src="<?php echo get_template_directory_uri() . '/images/productpanel3.png'?>" alt="">
				</figure>
			</div>
		</div>
	</div>

	<div class="proPanelBg col-5" style="--bgimg:url(../images/prodetailsbg.png)">

	</div>

</section>


<section class="product-swiper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3 oserh-lover-card">
				<div class="oserh-lover">
					<div class="oserthicon d-flex justify-content-center align-items-center ">
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
					</div>
					<p class="review">100 reviews</p>
					<h3>Oserth Lovers</h3>
					<p class="write">Write your reviews</p>
				</div>
			</div>


			<div class="col-lg-9">
				<div class="oserh-lover web">
					<div class="oserthicon d-flex justify-content-center align-items-center ">
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
					</div>
					<p class="review">100 reviews</p>
					<h3>Oserth Lovers</h3>
				</div>

				<div class="slider">
					<div class="swiper mySwiper3">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<div class="prodetailCard">
									<div class="d-flex justify-content-between">
										<div class="cardicon d-flex  align-items-center ">
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>

										</div>
										<div class="cardpara ">
											<p>20 May 2022</p>
										</div>
									</div>
									<div class="pro-body ">
										<p class="pro-para">Ove Sundström</p>
										<h3>Gura demär. Sur nevis.</h3>
										<p class="pro-para1">Märås dolig. Tetraselig hexaprektig. Nisesa döda.
											Nelig. Bemir gigat. Loss megariligen. Kusk. Negikagisk spelarat.
											Plavyd figon.</p>
									</div>
								</div>
							</div>


							<div class="swiper-slide">
								<div class="prodetailCard">
									<div class="d-flex justify-content-between">
										<div class="cardicon d-flex  align-items-center ">
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>

										</div>
										<div class="cardpara ">
											<p>20 May 2022</p>
										</div>
									</div>
									<div class="pro-body ">
										<p class="pro-para">Ove Sundström</p>
										<h3>Gura demär. Sur nevis.</h3>
										<p class="pro-para1">Märås dolig. Tetraselig hexaprektig. Nisesa döda.
											Nelig. Bemir gigat. Loss megariligen. Kusk. Negikagisk spelarat.
											Plavyd figon.</p>
									</div>
								</div>
							</div>


							<div class="swiper-slide">
								<div class="prodetailCard">
									<div class="d-flex justify-content-between">
										<div class="cardicon d-flex  align-items-center ">
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>

										</div>
										<div class="cardpara ">
											<p>20 May 2022</p>
										</div>
									</div>
									<div class="pro-body ">
										<p class="pro-para">Ove Sundström</p>
										<h3>Gura demär. Sur nevis.</h3>
										<p class="pro-para1">Märås dolig. Tetraselig hexaprektig. Nisesa döda.
											Nelig. Bemir gigat. Loss megariligen. Kusk. Negikagisk spelarat.
											Plavyd figon.</p>
									</div>
								</div>
							</div>


							<div class="swiper-slide">
								<div class="prodetailCard">
									<div class="d-flex justify-content-between">
										<div class="cardicon d-flex  align-items-center ">
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>

										</div>
										<div class="cardpara ">
											<p>20 May 2022</p>
										</div>
									</div>
									<div class="pro-body ">
										<p class="pro-para">Ove Sundström</p>
										<h3>Gura demär. Sur nevis.</h3>
										<p class="pro-para1">Märås dolig. Tetraselig hexaprektig. Nisesa döda.
											Nelig. Bemir gigat. Loss megariligen. Kusk. Negikagisk spelarat.
											Plavyd figon.</p>
									</div>
								</div>
							</div>

						</div>
						<div class="swiper-pagination"></div>
					</div>

				</div>
				<div class="oserh-lover web">
					<button class="write">Write your reviews</button>

				</div>

			</div>
		</div>
	</div>
</section>






<!-- Best Seller -->
<section class="best-seller product-related">
	<div class="container-fluid">
		<div class="seller-head text-center ">
			<h1>Related Products</h1>
		</div>

		<div class="row pro-row">
			<div class="col-lg-3 col-sm-6 col-6">
				<div class="seller-card">
					<!-- style="--bg:#E9D69E;"  -->
					<figure>
						<div class="productImg">
							<img src="assets/images/homeproduct.png" class="img-fluid" alt="">
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
								<img src="assets/images/leaf-icon.png" class="img-fluid" alt="">
								<span>Natural</span>
							</li>
						</ul>
					</figure>

					<div class="seller-body">
						<a href="#">
							<h4 class="mb-3">Fortify Masque</h4>
						</a>
						<p class="mb-3">Lorem ipsum dolor sit amet consectetur.</p>
						<p class="mb-3">$ 55.36</p>
						<a href="#" class="btn">Add to cart <span class="ms-2">+</span></a>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-6">
				<div class="seller-card">
					<!-- style="--bg:#6FCFEB;" -->
					<figure>
						<img src="assets/images/homeproduct1.png" class="img-fluid" alt="">

						<ul class="badge-group badge-group1">
							<li>
								<p>Best<br>
									Seller</p>
							</li>
							<li>
								<span>pure</span>
								<p>Vegan</p>
								<span>one</span>
							</li>

						</ul>
					</figure>

					<div class="seller-body">
						<a href="#">
							<h4 class="mb-3">Fortify Masque</h4>
						</a>
						<p class="mb-3">Lorem ipsum dolor sit amet consectetur.</p>
						<p class="mb-3">$ 55.36</p>
						<a href="#" class="btn">Add to cart <span class="ms-2">+</span></a>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-6">
				<div class="seller-card">
					<!-- style="--bg:#AEDAB5;" -->
					<figure>
						<img src="assets/images/homeproduct2.png" class="img-fluid" alt="">

						<ul class="badge-group badge-group2">
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
								<img src="assets/images/leaficon1.png" class="img-fluid" alt="">
								<span>Natural</span>
							</li>
						</ul>
					</figure>
					<div class="seller-body">
						<a href="#">
							<h4 class="mb-3">Fortify Masque</h4>
						</a>
						<p class="mb-3">Lorem ipsum dolor sit amet consectetur.</p>
						<p class="mb-3">$ 55.36</p>
						<a href="#" class="btn">Add to cart <span class="ms-2">+</span></a>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-6">
				<div class="seller-card">

					<!-- style="--bg:#E3B5E0;" -->
					<figure>
						<img src="assets/images/homeproduct3.png" class="img-fluid" alt="">

						<ul class="badge-group badge-group3">
							<li>
								<p>Best<br>
									Seller</p>
							</li>
							<li>
								<span>pure</span>
								<p>Vegan</p>
								<span>one</span>
							</li>

						</ul>
					</figure>
					<div class="seller-body">
						<a href="#">
							<h4 class="mb-3">Fortify Masque</h4>
						</a>
						<p class="mb-3">Lorem ipsum dolor sit amet consectetur.</p>
						<p class="mb-3">$ 55.36</p>
						<a href="#" class="btn">Add to cart <span class="ms-2">+</span></a>
					</div>
				</div>
			</div>

		</div>

		<div class="discover">
			<a href="#" class="btn">Discover More</a>
		</div>
	</div>
</section>
<!-- Best Seller End-->


<?php get_footer(); ?>