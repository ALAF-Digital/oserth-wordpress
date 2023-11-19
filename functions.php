<?php

/**
 * Enqueue styles.
 */
function Os_styles()
{

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), wp_get_theme()->get('Version'));
    wp_enqueue_style('swiper', get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), wp_get_theme()->get('Version'));
    wp_enqueue_style('OS', get_template_directory_uri() . '/css/style.css', array(), wp_get_theme()->get('Version'));
    wp_enqueue_style('OS-res', get_template_directory_uri() . '/css/responsive.css', array(), wp_get_theme()->get('Version'));
}

add_action('wp_enqueue_scripts', 'Os_styles');



// load-js //
function load_js()
{
    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-3.7.1.min.js', array(), wp_get_theme()->get('Version'), true);
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), wp_get_theme()->get('Version'), true);
    wp_enqueue_script('swiper-js', get_template_directory_uri() . '/js/swiper-bundle.min.js', array('jquery'), wp_get_theme()->get('Version'), true);
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery', 'swiper-js'), wp_get_theme()->get('Version'), true);
}

add_action('wp_enqueue_scripts', 'load_js');

function enqueue_cart_scripts() {
    
    if (function_exists('is_woocommerce') && is_woocommerce()) {
        wp_enqueue_script('wc-add-to-cart', plugins_url('woocommerce/assets/js/frontend/add-to-cart.min.js'), array('jquery'), false, true);
         wp_enqueue_script('cart-js', get_template_directory_uri() . '/js/woo-cutom-cart.js', array('jquery'), wp_get_theme()->get('Version'), true);

        // Localize the script with new data
        $localized_params = array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'wc_ajax_url' => admin_url('admin-ajax.php'),
            'i18n_view_cart' => esc_attr__('View cart', 'woocommerce'),
            'cart_url' => wc_get_cart_url(),
            'is_cart' => is_cart(),
            'cart_redirect_after_add' => get_option('woocommerce_cart_redirect_after_add'),
            'loading' => esc_attr__('Updating cart...', 'woocommerce'),
        );

        wp_localize_script('wc-add-to-cart', 'wc_add_to_cart_params', apply_filters('wc_add_to_cart_params', $localized_params));
    }
}

add_action('wp_enqueue_scripts', 'enqueue_cart_scripts');



// header-menu //

add_theme_support('menus');
add_theme_support('post-thumbnails');


// Menu //

register_nav_menus(
    array(
        'top-menu' => __('Top Menu', 'theme'),
    )
);

register_nav_menus(
    array(
        'footer' => __('Footer', 'theme'),
    )
);

// Add Li Class
function add_additional_class_on_li($classes, $item, $args)
{
    if (isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);


// Add a Class //
function add_additional_class_on_a($classes, $item, $args)
{
    if (isset($args->add_a_class)) {
        $classes['class'] = $args->add_a_class;
    }
    return $classes;
}

add_filter('nav_menu_link_attributes', 'add_additional_class_on_a', 1, 3);


class Quick_Links_Walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
    }
}


// Replace Posts label as Articles in Admin Panel 

function change_post_menu_label()
{
    global $menu;
    global $submenu;
    $menu[5][0] = 'Journals';
    $submenu['edit.php'][5][0] = 'Journals';
    $submenu['edit.php'][10][0] = 'Add Journals';
    echo '';
}
function change_post_object_label()
{
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Journals';
    $labels->singular_name = 'Journal';
    $labels->add_new = 'Add Journal';
    $labels->add_new_item = 'Add Journal';
    $labels->edit_item = 'Edit Journal';
    $labels->new_item = 'Journal';
    $labels->view_item = 'View Journal';
    $labels->search_items = 'Search Journals';
    $labels->not_found = 'No Journals found';
    $labels->not_found_in_trash = 'No Journals found in Trash';
    $labels->name_admin_bar = 'Add Journal';
}
add_action('init', 'change_post_object_label');
add_action('admin_menu', 'change_post_menu_label');

function mytheme_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'mytheme_add_woocommerce_support');



add_action('wp_ajax_add_to_cart', 'add_to_cart_ajax_callback');
add_action('wp_ajax_nopriv_add_to_cart', 'add_to_cart_ajax_callback');

function add_to_cart_ajax_callback() {
    $product_id = isset($_POST['product_id']) ? absint($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? wc_stock_amount(sanitize_text_field($_POST['quantity'])) : 1;

    if ($product_id > 0) {
        // Add the product to the cart with the specified quantity
        WC()->cart->add_to_cart($product_id, $quantity);

        // Display a notice
        wc_add_notice('Product added to the cart successfully!', 'success');

        // Return the updated cart fragments for frontend updates
        ob_start();
        woocommerce_mini_cart();
        $mini_cart = ob_get_clean();

        wp_send_json_success(array(
            'message' => 'Product added to the cart successfully!',
            'mini_cart' => $mini_cart,
        ));
    } else {
        wp_send_json_error('Invalid product ID');
    }
}

function funct_template_redirect() {
    // Check if it's cart page
    if (is_page('cart')) {

        include(get_template_directory() . '/cart-template.php');
        exit; 
    }
    if (is_order_received_page() ) {
        include(get_template_directory() . '/thank-you.php');
        exit; 
    }
}
add_action('template_redirect', 'funct_template_redirect');