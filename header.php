<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title><?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo('description'); ?> </title>

    <?php wp_head(); ?>
</head>

<body>


    <!-- SErach ARea  -->
    <div class="offcanvas offcanvas-top" tabindex="-1" id="searchTop" aria-labelledby="searchTopLabel">
        <div class="offcanvas-body">
            <form>
                <div class="input-group">
                    <a href="search.html"> <i class="fa-solid fa-magnifying-glass "></i></a>
                    <input type="text" class="form-control" placeholder="SEARCH">
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </form>
        </div>
    </div>
    <!-- search area end -->

    <!-- header -->
    <header>
        <div class="top-bar">
            <div class="container">
                <p>Lörem ipsum exonomårar antejåktigt reaskapet. Diledes polingar pålogi, eftersom ultradobel.</p>
            </div>
        </div>
        <div class="main-navigation">
            <div class="container-fluid">
                <ul class="social-link">
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-pinterest"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler" type="button" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#mobileNav" aria-controls="mobileNav">
                    <span class="fas fa-bars"></span>
                </button>
                <a href="<?php echo get_site_url(); ?>" class="navbar-brand">
                    <img src="<?php echo get_template_directory_uri() . '/images/headerlogo.svg'?>" class="img-fluid" alt="">
                </a>
                <ul class="more-links">
                    <li><a href="#">عربي</a></li>
                    <li class=" dropdown">
                        <a class="" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            USD
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">USD</a></li>
                            <li><a class="dropdown-item" href="#">AED</a></li>
                            <li><a class="dropdown-item" href="#">GBP</a></li>
                        </ul>
                    </li>
                    <li class="mobile-logo">
                        <a href="<?php echo get_site_url(); ?>" class="navbar-brand">
                            <img src="<?php echo get_template_directory_uri() . '/images/mobilelogo.png'?>" class="img-fluid " alt="">
                        </a>
                    </li>
                    <li class="searchbtn-menu"><a href="#" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#searchTop" aria-controls="searchTop"><i
                                class="fa-solid fa-magnifying-glass"></i></a></li>
                    <li><a href="#"><i class="fa-regular fa-user"></i></a></li>
                    <li class="web-cart"><a href="my-cart.html"><i class="fa-solid fa-bag-shopping"></i></a></li>
                    <li class="mob-cart"><a href="#" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight"><i class="fa-solid fa-bag-shopping"></i></a></li>
                </ul>
            </div>
        </div>


       
    
        <nav class="navbar navbar-expand-md">
            <div class="container">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'top-menu',
                        'menu_class' => "navbar-nav mx-auto",
                        'navbar' => '',
                        'container' => '',
                        'add_a_class'     => 'nav-link',
                        'add_li_class'  => 'nav-item '
                    )
                );
                ?>

                   
                    <div class="shop-menu" id="shop-dropdown">
                        <div class="container">
                            <div class="row g-0 justify-content-between">
                                <div class="col-lg-2 col-md-3">
                                    <h4>Highlight</h4>
                                    <ul>
                                        <li><a href="#">All Products</a></li>
                                        <li><a href="#">Best Sellers</a></li>
                                        <li><a href="#">New Arrivals</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-2 col-md-3">
                                    <h4>Product Type</h4>
                                    <ul>
                                        <li><a href="#">Shampoo </a></li>
                                        <li><a href="#">Hair Mask</a></li>
                                        <li><a href="#">Leave-in</a></li>
                                        <li><a href="#">Hair Oil</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-2 col-md-3">
                                    <h4>Collection</h4>
                                    <ul>
                                        <li><a href="#">Fortify</a></li>
                                        <li><a href="#">Restore</a></li>
                                        <li><a href="#">Smooth</a></li>
                                        <li><a href="#">Volume</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-2 col-md-3">
                                    <h4>Hair Type</h4>
                                    <ul>
                                        <li><a href="#">Dry Hair</a></li>
                                        <li><a href="#">Frizzy Hair</a></li>
                                        <li><a href="#">Damaged Hair</a></li>
                                        <li><a href="#">Oily & Greasy Hair</a></li>
                                        <li><a href="#">Hair Loss </a></li>
                                        <li><a href="#">Sensitive Scalp </a></li>
                                        <li><a href="#">Oily or Dry Scalp </a></li>
                                        <li><a href="#">Fine Thin Hair </a></li>
                                        <li><a href="#">Flat Hair</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- header end -->

      <!-- Mobile navbar -->

      <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileNav" aria-labelledby="mobileNavLabel">
        <div class="offcanvas-header">
            <!-- <h5 class="offcanvas-title" id="mobileNavLabel">Offcanvas</h5> -->
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="searchbox-mobile">
                <input type="search" class="form-control" placeholder="search">
                <button class="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <ul class="link-mobile">
                <li>
                    <a href="product.html" class="mobile-link">Shop</a>
                    <div class="accordion" id="mobileDropdown">
                        <div class="accordion-item">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#highlight" aria-expanded="false" aria-controls="highlight">
                                Highlight
                            </button>
                            <div id="highlight" class="accordion-collapse collapse" data-bs-parent="#mobileDropdown">
                                <div class="accordion-body">
                                    <ul>
                                        <li><a href="#">All Products</a></li>
                                        <li><a href="#">Best Sellers</a></li>
                                        <li><a href="#">New Arrivals</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#productType" aria-expanded="false" aria-controls="productType">
                                Product Types
                            </button>
                            <div id="productType" class="accordion-collapse collapse" data-bs-parent="#mobileDropdown">
                                <div class="accordion-body">
                                    <ul>
                                        <li><a href="#">Shampoo </a></li>
                                        <li><a href="#">Hair Mask</a></li>
                                        <li><a href="#">Leave-in</a></li>
                                        <li><a href="#">Hair Oil</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collection" aria-expanded="false" aria-controls="collection">
                                Collection
                            </button>
                            <div id="collection" class="accordion-collapse collapse" data-bs-parent="#mobileDropdown">
                                <div class="accordion-body">
                                    <ul>
                                        <li><a href="#">Fortify</a></li>
                                        <li><a href="#">Restore</a></li>
                                        <li><a href="#">Smooth</a></li>
                                        <li><a href="#">Volume</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#hairType" aria-expanded="false" aria-controls="hairType">
                                Hair Types
                            </button>
                            <div id="hairType" class="accordion-collapse collapse" data-bs-parent="#mobileDropdown">
                                <div class="accordion-body">
                                    <ul>
                                        <li><a href="#">Dry Hair</a></li>
                                        <li><a href="#">Frizzy Hair</a></li>
                                        <li><a href="#">Damaged Hair</a></li>
                                        <li><a href="#">Oily & Greasy Hair</a></li>
                                        <li><a href="#">Hair Loss </a></li>
                                        <li><a href="#">Sensitive Scalp </a></li>
                                        <li><a href="#">Oily or Dry Scalp </a></li>
                                        <li><a href="#">Fine Thin Hair </a></li>
                                        <li><a href="#">Flat Hair</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li> <a href="aboutus.html" class="mobile-link">About us</a></li>
                <li>
                    <a href="journal.html" class="mobile-link">Journal</a>
                </li>
                <li>
                    <a href="Our-Ingredients.html" class="mobile-link">Ingredients</a>
                </li>
                <li>
                    <a href="contact.html" class="mobile-link">Contact us</a>
                </li>
            </ul>
            <div class="foot-mobilenav">
                <a href="#" class="oserth-email">hello@oserth.com</a>
                <ul class="social-link mt-2 mb-2">
                    <li>
                        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>

                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-pinterest"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                    </li>
                </ul>
                <img src="<?php echo get_template_directory_uri() . '/images/navfoot.png'?>" class="img-fluid" alt="">
            </div>
        </div>
    </div>

    <!-- Mobile navbar End-->


    <!-- My Cart Mobile -->
    <section class="mobilecart">

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">

                <h5 id="offcanvasRightLabel">Cart</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="head">
                    <img src="<?php echo get_template_directory_uri() . '/images/cartheader.png'?>" alt="">
                    <p>User Name</p>
                </div>


                <div class="cart-deta">
                    <div class="cart-data d-flex mb-4">
                        <img src="<?php echo get_template_directory_uri() . '/images/cartoil.png'?>" alt="">
                        <div class="cart-cont">
                            <h4>Oserth Fortify</h4>
                            <p>Smooth Shampoo 300ml</p>
                        </div>
                        <a href="#"><i class="fa-solid fa-x"></i></a>
                    </div>

                    <div class="cart-data d-flex mb-4">
                        <img src="<?php echo get_template_directory_uri() . '/images/cartoil.png'?>" alt="">
                        <div class="cart-cont">
                            <h4>Oserth Fortify</h4>
                            <p>Smooth Shampoo 300ml</p>
                        </div>
                        <a href="#"><i class="fa-solid fa-x"></i></a>
                    </div>


                    <div class="cart-data d-flex mb-4">
                        <img src="<?php echo get_template_directory_uri() . '/images/cartoil.png'?>" alt="">
                        <div class="cart-cont">
                            <h4>Oserth Fortify</h4>
                            <p>Smooth Shampoo 300ml</p>
                        </div>
                        <a href="#"><i class="fa-solid fa-x"></i></a>
                    </div>

                    <div class="cart-data d-flex mb-4">
                        <img src="<?php echo get_template_directory_uri() . '/images/cartoil.png'?>" alt="">
                        <div class="cart-cont">
                            <h4>Oserth Fortify</h4>
                            <p>Smooth Shampoo 300ml</p>
                        </div>
                        <a href="#"><i class="fa-solid fa-x"></i></a>
                    </div>
                </div>



                <div class="cart-add">
                    <div class="cart-data cart-data1 d-flex mb-4">
                        <img src="<?php echo get_template_directory_uri() . '/images/cartshampoo.png'?>" alt="">
                        <div class="cart-cont">
                            <h4>Oserth Fortify</h4>
                            <p>$ 54.00</p>
                        </div>
                        <div class="add-action">
                            <button class="btn">add</button>
                        </div>
                    </div>

                    <div class="cart-data cart-data1 d-flex mb-4">
                        <img src="<?php echo get_template_directory_uri() . '/images/cartshampoo.png'?>" alt="">
                        <div class="cart-cont">
                            <h4>Oserth Fortify</h4>
                            <p>$ 54.00</p>
                        </div>
                        <div class="add-action">
                            <button class="btn">add</button>
                        </div>
                    </div>

                    <div class="cart-data cart-data1 d-flex mb-4">
                        <img src="<?php echo get_template_directory_uri() . '/images/cartshampoo.png'?>" alt="">
                        <div class="cart-cont">
                            <h4>Oserth Fortify</h4>
                            <p>$ 54.00</p>
                        </div>
                        <div class="add-action">
                            <button class="btn">add</button>
                        </div>
                    </div>
                </div>


                <div class="cart-buttons">
                    <p>Currency</p>
                    <div class="buttons">
                        <button class="btn">USD</button>
                        <button class="btn">AED</button>
                        <button class="btn">GBP</button>
                    </div>
                </div>

                <div class="checkout">
                    <button class="btn">Checkout . $200</button>
                </div>
            </div>
        </div>
    </section>
    <!-- My Cart Mobile End -->
