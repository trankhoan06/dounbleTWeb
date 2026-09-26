<?php
flush_rewrite_rules();
include 'typerocket/init.php';
require dirname( __FILE__ ) . '/inc/init.php';

// TypeRocket Page Templates Configs
require dirname( __FILE__ ) . '/inc/typerocket-career-detail.php';
require dirname( __FILE__ ) . '/inc/typerocket-careers.php';
require dirname( __FILE__ ) . '/inc/typerocket-commitment.php';
require dirname( __FILE__ ) . '/inc/typerocket-contact.php';
require dirname( __FILE__ ) . '/inc/typerocket-home.php';
require dirname( __FILE__ ) . '/inc/typerocket-insight-category.php';
require dirname( __FILE__ ) . '/inc/typerocket-insight-detail.php';
require dirname( __FILE__ ) . '/inc/typerocket-insight.php';
require dirname( __FILE__ ) . '/inc/typerocket-product-service-detail.php';
require dirname( __FILE__ ) . '/inc/typerocket-product-service.php';
add_filter('tr_theme_options_page', function() {
    return get_template_directory() . '/theme-options.php';
});

load_theme_textdomain( 'chloe_pallete', get_template_directory().'/languages' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );

// Register Menus
register_nav_menus( array(
    'header_menu' => esc_html__( 'Header Menu', 'themax' ),
    'footer_menu' => esc_html__( 'Footer Menu', 'themax' ),
) );

//Media Support
add_image_size( 'post-default', 900, 480, true ); // 480 pixels wide by 370 pixels tall, soft proportional crop mode

add_filter('show_admin_bar', '__return_false');

function themax_enqueue_assets() {
    $theme_dir = get_template_directory_uri();

    // Global CSS
    wp_enqueue_style('swiper-bundle', $theme_dir . '/css/swiper-bundle.min.css', array(), '1.0.0');
    wp_enqueue_style('global-style', $theme_dir . '/css/global.css', array(), '1.0.0');
    $style_version = filemtime(get_template_directory() . '/style.css') ?: '1.0.0';
    wp_enqueue_style('themax-style', get_stylesheet_uri(), array(), $style_version);

    // Global JS
    wp_enqueue_script('jquery-3.7.1', $theme_dir . '/js/jquery-3.7.1.min.js', array(), '3.7.1', true);
    wp_enqueue_script('swiper-bundle-js', $theme_dir . '/js/swiper-bundle.min.js', array(), '1.0.0', true);
    wp_enqueue_script('global-js', $theme_dir . '/js/global.js', array('jquery-3.7.1'), '1.0.0', true);

    // Template specific CSS & JS
    if (is_page_template('page-templates/career-detail.php')) {
        wp_enqueue_style('doublet-career-detail', $theme_dir . '/css/career-detail.css', array(), '1.0.0');
        wp_enqueue_script('doublet-career-detail-js', $theme_dir . '/js/career-detail.js', array('global-js'), '1.0.0', true);
    }
    elseif (is_page_template('page-templates/careers.php')) {
        wp_enqueue_style('doublet-careers', $theme_dir . '/css/careers.css', array(), '1.0.0');
    }
    elseif (is_page_template('page-templates/commitment.php')) {
        wp_enqueue_style('doublet-commitment', $theme_dir . '/css/commitment.css', array(), '1.0.0');
        wp_enqueue_script('doublet-commitment-js', $theme_dir . '/js/commitment.js', array('global-js'), '1.0.0', true);
    }
    elseif (is_page_template('page-templates/contact.php')) {
        wp_enqueue_style('doublet-contact', $theme_dir . '/css/contact.css', array(), '1.0.0');
    }
    elseif (is_page_template('page-templates/index.php') || is_front_page() || is_home()) {
        wp_enqueue_style('doublet-home', $theme_dir . '/css/home.css', array(), '1.0.0');
        wp_enqueue_script('doublet-home-js', $theme_dir . '/js/home.js', array('global-js'), '1.0.0', true);
    }
    elseif (is_page_template('page-templates/insight-category.php')) {
        wp_enqueue_style('doublet-insight-category', $theme_dir . '/css/insight-category.css', array(), '1.0.0');
        wp_enqueue_script('doublet-insight-category-js', $theme_dir . '/js/insight-category.js', array('global-js'), '1.0.0', true);
    }
    elseif (is_page_template('page-templates/insight-detail.php')) {
        wp_enqueue_style('doublet-insight-detail', $theme_dir . '/css/insight-detail.css', array(), '1.0.0');
        wp_enqueue_script('doublet-insight-detail-js', $theme_dir . '/js/insight-detail.js', array('global-js'), '1.0.0', true);
    }
    elseif (is_page_template('page-templates/insight.php')) {
        wp_enqueue_style('doublet-insight', $theme_dir . '/css/insight.css', array(), '1.0.0');
        wp_enqueue_script('doublet-insight-js', $theme_dir . '/js/insight.js', array('global-js'), '1.0.0', true);
    }
    elseif (is_page_template('page-templates/product-service-detail.php')) {
        wp_enqueue_style('doublet-product-service-detail', $theme_dir . '/css/product-service-detail.css', array(), '1.0.0');
        wp_enqueue_script('doublet-product-service-detail-js', $theme_dir . '/js/product-service-detail.js', array('global-js'), '1.0.0', true);
    }
    elseif (is_page_template('page-templates/product-service.php')) {
        wp_enqueue_style('doublet-product-service', $theme_dir . '/css/product-service.css', array(), '1.0.0');
        wp_enqueue_script('doublet-product-service-js', $theme_dir . '/js/product-service.js', array('global-js'), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'themax_enqueue_assets');

add_filter('script_loader_tag', 'themax_add_defer_to_scripts', 10, 2);
function themax_add_defer_to_scripts($tag, $handle) {
    $defer_scripts = array(
        'jquery-3.7.1',
        'swiper-bundle-js',
        'global-js',
        'doublet-career-detail-js',
        'doublet-commitment-js',
        'doublet-home-js',
        'doublet-insight-category-js',
        'doublet-insight-detail-js',
        'doublet-insight-js',
        'doublet-product-service-detail-js',
        'doublet-product-service-js'
    );
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}

// Prevent caching for requests coming from Zalo In-App Browser
add_action('send_headers', 'themax_disable_cache_for_zalo');
function themax_disable_cache_for_zalo() {
    $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    if (stripos($user_agent, 'Zalo') !== false) {
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
    }
}
