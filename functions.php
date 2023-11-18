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
