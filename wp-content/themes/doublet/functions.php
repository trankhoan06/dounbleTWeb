<?php
// Rebuilding rewrite rules on every request is expensive. WordPress only needs
// this after the theme is activated (or when rewrite settings change).
add_action('after_switch_theme', 'flush_rewrite_rules');
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
    $is_home_page = is_page_template('page-templates/index.php')
        || is_page_template('page-templates/template.php')
        || is_front_page()
        || is_home();

    // Global CSS
    $global_css_ver = file_exists(get_template_directory() . '/css/global.css') ? filemtime(get_template_directory() . '/css/global.css') : '1.0.0';
    wp_enqueue_style('global-style', $theme_dir . '/css/global.css', array(), $global_css_ver);
    $style_version = filemtime(get_template_directory() . '/style.css') ?: '1.0.0';
    wp_enqueue_style('themax-style', get_stylesheet_uri(), array(), $style_version);

    // Lenis is optional at runtime: the site keeps native scrolling if the CDN
    // is unavailable, while supported browsers receive smooth wheel scrolling.
    wp_enqueue_script('lenis', 'https://cdn.jsdelivr.net/npm/lenis@1.3.17/dist/lenis.min.js', array(), '1.3.17', true);
    $global_js_ver = file_exists(get_template_directory() . '/js/global.js') ? filemtime(get_template_directory() . '/js/global.js') : '1.0.0';
    wp_enqueue_script('global-js', $theme_dir . '/js/global.js', array('lenis'), $global_js_ver, true);

    // Swiper is 150 KB and is only used by the templates below. Loading it
    // globally delayed every other page unnecessarily.
    $uses_swiper = is_page_template('page-templates/commitment.php')
        || is_page_template('page-templates/index.php')
        || is_page_template('page-templates/template.php')
        || is_front_page()
        || is_home()
        || is_page_template('page-templates/insight-detail.php')
        || is_singular('post')
        || is_single()
        || is_page_template('page-templates/product-service-detail.php')
        || is_page_template('product-service-detail.php')
        || is_singular(array('product-and-service', 'productandservice', 'product-service', 'product_service'));

    if ($uses_swiper) {
        $swiper_css_ver = file_exists(get_template_directory() . '/css/swiper-bundle.min.css') ? filemtime(get_template_directory() . '/css/swiper-bundle.min.css') : '1.0.0';
        $swiper_js_ver = file_exists(get_template_directory() . '/js/swiper-bundle.min.js') ? filemtime(get_template_directory() . '/js/swiper-bundle.min.js') : '1.0.0';
        wp_enqueue_style('swiper-bundle', $theme_dir . '/css/swiper-bundle.min.css', array(), $swiper_css_ver);
        wp_enqueue_script('swiper-bundle-js', $theme_dir . '/js/swiper-bundle.min.js', array(), $swiper_js_ver, true);
    }

    // Template specific CSS & JS
    if (is_page_template('page-templates/career-detail.php') || is_singular('career') || is_singular('careers')) {
        wp_enqueue_style('doublet-career-detail', $theme_dir . '/css/career-detail.css', array(), '1.0.0');
        wp_enqueue_script('doublet-career-detail-js', $theme_dir . '/js/career-detail.js', array('global-js'), '1.0.0', true);
    }
    elseif (is_page_template('page-templates/careers.php')) {
        wp_enqueue_style('doublet-careers', $theme_dir . '/css/careers.css', array(), '1.0.0');
        wp_enqueue_style('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css', array(), '5.0.36');
        wp_enqueue_script('fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array(), '5.0.36', true);
    }
    elseif (is_page_template('page-templates/commitment.php')) {
        $commitment_css_ver = file_exists(get_template_directory() . '/css/commitment.css') ? filemtime(get_template_directory() . '/css/commitment.css') : '1.0.0';
        wp_enqueue_style('doublet-commitment', $theme_dir . '/css/commitment.css', array(), $commitment_css_ver);
        wp_enqueue_script('doublet-commitment-js', $theme_dir . '/js/commitment.js', array('global-js'), '1.0.0', true);
    }
    elseif (is_page_template('page-templates/contact.php')) {
        wp_enqueue_style('doublet-contact', $theme_dir . '/css/contact.css', array(), '1.0.0');
    }
    elseif ($is_home_page) {
        wp_enqueue_style('aos', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css', array(), '2.3.4');
        wp_enqueue_script('aos', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js', array(), '2.3.4', true);
        $home_css_ver = file_exists(get_template_directory() . '/css/home.css') ? filemtime(get_template_directory() . '/css/home.css') : '1.0.0';
        wp_enqueue_style('doublet-home', $theme_dir . '/css/home.css', array(), $home_css_ver);
        $home_js_ver = file_exists(get_template_directory() . '/js/home.js') ? filemtime(get_template_directory() . '/js/home.js') : '1.0.0';
        wp_enqueue_script('doublet-home-js', $theme_dir . '/js/home.js', array('global-js', 'aos'), $home_js_ver, true);
    }
    elseif (is_page_template('page-templates/insight-category.php') || is_category() || is_archive()) {
        wp_enqueue_style('doublet-insight-category', $theme_dir . '/css/insight-category.css', array(), '1.0.0');
        wp_enqueue_script('doublet-insight-category-js', $theme_dir . '/js/insight-category.js', array('global-js'), '1.0.0', true);
    }
    elseif (is_page_template('page-templates/product-service-detail.php') || is_page_template('product-service-detail.php') || is_singular('product-and-service') || is_singular('productandservice') || is_singular('product-service') || is_singular('product_service')) {
        $psd_css_ver = file_exists(get_template_directory() . '/css/product-service-detail.css') ? filemtime(get_template_directory() . '/css/product-service-detail.css') : '1.0.1';
        $psd_js_ver = file_exists(get_template_directory() . '/js/product-service-detail.js') ? filemtime(get_template_directory() . '/js/product-service-detail.js') : '1.0.1';
        wp_enqueue_style('doublet-product-service-detail', $theme_dir . '/css/product-service-detail.css', array(), $psd_css_ver);
        wp_enqueue_script('doublet-product-service-detail-js', $theme_dir . '/js/product-service-detail.js', array('swiper-bundle-js', 'global-js'), $psd_js_ver, true);
    }
    elseif (is_page_template('page-templates/product-service.php')) {
        wp_enqueue_style('doublet-product-service', $theme_dir . '/css/product-service.css', array(), '1.0.0');
        wp_enqueue_script('doublet-product-service-js', $theme_dir . '/js/product-service.js', array('global-js'), '1.0.0', true);
    }
    elseif (is_page_template('page-templates/insight.php')) {
        wp_enqueue_style('doublet-insight', $theme_dir . '/css/insight.css', array(), '1.0.0');
        wp_enqueue_script('doublet-insight-js', $theme_dir . '/js/insight.js', array('global-js'), '1.0.0', true);
    }
    elseif (is_page_template('page-templates/insight-detail.php') || is_singular('post') || is_single()) {
        wp_enqueue_style('doublet-insight-detail', $theme_dir . '/css/insight-detail.css', array(), '1.0.0');
        wp_enqueue_script('doublet-insight-detail-js', $theme_dir . '/js/insight-detail.js', array('global-js'), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'themax_enqueue_assets');

/**
 * The theme contains many hand-written <img> tags, which WordPress cannot
 * automatically enhance. Add native lazy loading and async decoding to images
 * outside the initial header/hero area. Existing explicit attributes always win.
 */
function themax_optimize_theme_images($html) {
    return preg_replace_callback('/<img\b[^>]*>/i', function ($match) {
        $tag = $match[0];

        if (stripos($tag, ' loading=') !== false) {
            return $tag;
        }

        // Header logo and hero imagery affect first paint/LCP, so do not lazy-load them.
        $is_priority = stripos($tag, 'fetchpriority=') !== false
            || stripos($tag, 'header-logo') !== false
            || stripos($tag, 'hero') !== false;

        $attributes = $is_priority
            ? ' loading="eager" fetchpriority="high" decoding="async"'
            : ' loading="lazy" decoding="async"';

        return preg_replace('/\s*\/?>(\s*)$/', $attributes . '>', $tag);
    }, $html);
}

function themax_start_image_optimization_buffer() {
    if (!is_admin() && !is_feed() && !wp_doing_ajax() && !is_robots()) {
        ob_start('themax_optimize_theme_images');
    }
}
add_action('template_redirect', 'themax_start_image_optimization_buffer', 0);

add_filter('body_class', 'themax_custom_body_classes');
function themax_custom_body_classes($classes) {
    if (is_page_template('page-templates/product-service-detail.php') || is_page_template('product-service-detail.php') || is_singular('product-and-service') || is_singular('productandservice') || is_singular('product-service') || is_singular('product_service')) {
        $classes[] = 'product-service-detail-page';
    }
    elseif (is_page_template('page-templates/careers.php')) {
        $classes[] = 'careers-page';
    }
    elseif (is_page_template('page-templates/career-detail.php') || is_singular('career') || is_singular('careers')) {
        $classes[] = 'career-detail-page';
    }
    elseif (is_page_template('page-templates/insight.php')) {
        $classes[] = 'insight-page';
    }
    elseif (is_page_template('page-templates/insight-category.php') || is_category() || is_archive()) {
        $classes[] = 'insight-category-page';
    }
    elseif (is_page_template('page-templates/insight-detail.php') || is_singular('post') || is_single()) {
        $classes[] = 'insight-detail-page';
    }
    return $classes;
}

add_filter('script_loader_tag', 'themax_add_defer_to_scripts', 10, 2);
function themax_add_defer_to_scripts($tag, $handle) {
    $defer_scripts = array(
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

/**
 * Determine if a header navigation item is currently active
 *
 * @param object $item WordPress nav menu item object
 * @return bool
 */
function themax_is_nav_item_active($item) {
    if (!empty($item->current)) {
        return true;
    }
    if (!empty($item->classes) && is_array($item->classes)) {
        if (in_array('current-menu-item', $item->classes) || in_array('current_page_item', $item->classes) || in_array('current-menu-ancestor', $item->classes)) {
            return true;
        }
    }

    $item_url = untrailingslashit(trim($item->url ?? ''));
    $home_url = untrailingslashit(home_url('/'));

    // Check Home page
    if ($item_url === $home_url || $item_url === $home_url . '/' || $item_url === '') {
        return (is_front_page() || is_home());
    }

    // Do not active other items if on front page
    if (is_front_page() || is_home()) {
        return false;
    }

    $item_path = trim(parse_url($item_url, PHP_URL_PATH) ?? '', '/');

    // 1. Commitment
    if (strpos($item_path, 'commitment') !== false) {
        return (is_page('commitment') || is_page_template('page-templates/commitment.php') || is_page_template('commitment.php'));
    }

    // 2. Product & Service
    if (strpos($item_path, 'product-service') !== false || strpos($item_path, 'product') !== false) {
        return (
            is_page('product-service') || 
            is_page_template('page-templates/product-service.php') || 
            is_page_template('product-service.php') || 
            is_page_template('page-templates/product-service-detail.php') || 
            is_page_template('product-service-detail.php') || 
            is_singular('product-and-service') || 
            is_singular('productandservice') || 
            is_singular('product-service') || 
            is_singular('product_service')
        );
    }

    // 3. Insight
    if (strpos($item_path, 'insight') !== false || strpos($item_path, 'tin-tuc') !== false) {
        return (
            is_page('insight') || 
            is_page_template('page-templates/insight.php') || 
            is_page_template('insight.php') || 
            is_page_template('page-templates/insight-category.php') || 
            is_page_template('page-templates/insight-detail.php') || 
            is_category() || 
            is_singular('post') || 
            (is_single() && !is_singular('career') && !is_singular('product-and-service') && !is_singular('productandservice'))
        );
    }

    // 4. Careers
    if (strpos($item_path, 'career') !== false || strpos($item_path, 'tuyen-dung') !== false) {
        return (
            is_page('careers') || 
            is_page('career') || 
            is_page_template('page-templates/careers.php') || 
            is_page_template('careers.php') || 
            is_page_template('page-templates/career-detail.php') || 
            is_page_template('career-detail.php') || 
            is_singular('career') || 
            is_singular('careers')
        );
    }

    // 5. Contact
    if (strpos($item_path, 'contact') !== false || strpos($item_path, 'lien-he') !== false) {
        return (
            is_page('contact') || 
            is_page_template('page-templates/contact.php') || 
            is_page_template('contact.php')
        );
    }

    // 6. Queried object match
    if (!empty($item->object_id) && $item->object_id == get_queried_object_id()) {
        return true;
    }

    // 7. Path match
    $current_path = trim(strtok($_SERVER['REQUEST_URI'] ?? '', '?'), '/');
    if (!empty($item_path) && !empty($current_path)) {
        if ($item_path === $current_path || strpos($current_path, $item_path) === 0) {
            return true;
        }
    }

    return false;
}

/**
 * Lấy danh sách menu items theo ngôn ngữ hiện tại và location
 */
function themax_get_nav_menu_items($location = 'header_menu') {
    $current_lang = function_exists('pll_current_language') ? pll_current_language('slug') : 'en';
    $current_lang = strtolower($current_lang ?: 'en');

    $menu_locations = get_nav_menu_locations();
    $menu_id = !empty($menu_locations[$location]) ? $menu_locations[$location] : 0;

    // Kiểm tra trực tiếp cấu hình Polylang để luôn đảm bảo đúng ngôn ngữ
    if (function_exists('pll_current_language')) {
        $pll_options = get_option('polylang');
        $stylesheet = get_option('stylesheet');
        
        if (!empty($pll_options['nav_menus'][$stylesheet][$location][$current_lang])) {
            $menu_id = $pll_options['nav_menus'][$stylesheet][$location][$current_lang];
        } elseif ($location === 'footer_menu') {
            if (!empty($pll_options['nav_menus'][$stylesheet]['footer_menu'][$current_lang])) {
                $menu_id = $pll_options['nav_menus'][$stylesheet]['footer_menu'][$current_lang];
            } elseif (!empty($pll_options['nav_menus'][$stylesheet]['header_menu'][$current_lang])) {
                $menu_id = $pll_options['nav_menus'][$stylesheet]['header_menu'][$current_lang];
            }
        }
    }

    // Nếu là footer_menu và chưa có menu riêng trong locations, fallback về header_menu
    if (!$menu_id && $location === 'footer_menu') {
        $menu_id = !empty($menu_locations['header_menu']) ? $menu_locations['header_menu'] : 0;
    }

    // Fallback thủ công theo slug menu nếu vẫn chưa tìm thấy
    if (!$menu_id) {
        if ($current_lang === 'vi') {
            $vi_menu = wp_get_nav_menu_object('header_vi') ?: wp_get_nav_menu_object('header-vi');
            if ($vi_menu) {
                $menu_id = $vi_menu->term_id;
            }
        }
        if (!$menu_id) {
            $en_menu = wp_get_nav_menu_object('header') ?: wp_get_nav_menu_object('header_en');
            if ($en_menu) {
                $menu_id = $en_menu->term_id;
            }
        }
    }

    $items = $menu_id ? wp_get_nav_menu_items($menu_id) : false;
    return $items ?: [];
}
