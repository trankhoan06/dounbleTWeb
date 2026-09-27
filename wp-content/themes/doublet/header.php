<?php

/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */

?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?> xmlns:fb="http://ogp.me/ns/fb#">
<!--<![endif]-->

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/GoogleSans-Regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/GoogleSans-Medium.woff2" as="font" type="font/woff2" crossorigin>
    <?php 
    if (is_front_page() || is_home() || is_page_template('page-templates/homepage.php')) {
        $home_banner_video = tr_posts_field('home_banner_video');
        $video_url = $home_banner_video ? wp_get_attachment_url($home_banner_video) : '';
        if ($video_url) {
            echo '<link rel="preload" href="' . esc_url($video_url) . '" as="video" type="video/mp4">';
        }
    }
    ?>

        <?php wp_head(); ?>
</head>

<?php
// Language settings (Polylang)
$current_lang = function_exists('pll_current_language') ? pll_current_language('slug') : 'en';
$current_lang = strtolower($current_lang ?: 'en');
if (!in_array($current_lang, ['en', 'vi'])) {
    $current_lang = 'en';
}

// Header settings from TypeRocket Theme Options
if ($current_lang === 'vi') {
    $header_slogan = tr_options_field('tr_theme_options.header_slogan_vi') ?: 'Cung cấp & Gia công thép chuyên nghiệp';
    $header_cta_text = tr_options_field('tr_theme_options.header_cta_text_vi') ?: 'TƯ VẤN MIỄN PHÍ';
    $header_profile_file = tr_options_field('tr_theme_options.header_profile_file_vi') ?: tr_options_field('tr_theme_options.header_profile_file');
    $header_profile_url = $header_profile_file ? wp_get_attachment_url($header_profile_file) : (tr_options_field('tr_theme_options.header_profile_link_vi') ?: (tr_options_field('tr_theme_options.header_profile_link') ?: '#'));
} else {
    $header_slogan = tr_options_field('tr_theme_options.header_slogan') ?: 'Professional steel supplying & processing';
    $header_cta_text = tr_options_field('tr_theme_options.header_cta_text') ?: 'FREE CONSULTATION';
    $header_profile_file = tr_options_field('tr_theme_options.header_profile_file');
    $header_profile_url = $header_profile_file ? wp_get_attachment_url($header_profile_file) : (tr_options_field('tr_theme_options.header_profile_link') ?: '#');
}

$header_vr360_url = tr_options_field('tr_theme_options.header_vr360_link') ?: '#';
$header_logo_id = tr_options_field('tr_theme_options.header_logo');
$header_logo_url = $header_logo_id ? wp_get_attachment_image_url($header_logo_id, 'full') : (get_template_directory_uri() . '/imgs/logo.png');
$header_cta_link = tr_options_field('tr_theme_options.header_cta_link') ?: '#';

// Nav menu items
$header_nav_items = function_exists('themax_get_nav_menu_items') ? themax_get_nav_menu_items('header_menu') : false;
?>
<body <?php body_class(); ?>>

    <!-- Header -->
    <header class="header">
        <!-- Header Top Bar -->
        <div class="header-top desktop">
            <div class="container header-top-inner">
                <div class="header-top-left">
                    <span class="txt txt-13 txt-italic header-top-slogan"><?php echo esc_html($header_slogan); ?></span>
                </div>
                <div class="header-top-right">
                    <a href="<?php echo esc_url($header_profile_url); ?>" <?php if ($header_profile_file) echo 'target="_blank" download'; ?> class="header-top-link txt txt-13 txt-med">2T Profile</a>
                    <span class="header-top-divider"></span>
                    <a href="<?php echo esc_url($header_vr360_url); ?>" <?php if ($header_vr360_url !== '#') echo 'target="_blank" rel="noopener"'; ?> class="header-top-link txt txt-13 txt-med">VR360</a>
                    <span class="header-top-divider"></span>
<?php
$pll_raw = function_exists('pll_the_languages') ? pll_the_languages(['raw' => 1]) : [];
$en_url = !empty($pll_raw['en']['url']) ? $pll_raw['en']['url'] : (function_exists('pll_home_url') ? pll_home_url('en') : home_url('/'));
$vi_url = !empty($pll_raw['vi']['url']) ? $pll_raw['vi']['url'] : (function_exists('pll_home_url') ? pll_home_url('vi') : home_url('/vi/'));
?>
                    <div class="header-lang" id="headerLang" tabindex="0" role="button" aria-haspopup="true"
                        aria-expanded="false" aria-label="Select language">
                        <div class="header-lang-trigger">
                            <span class="header-lang-flag" id="headerLangCurrentFlag">
                                <?php if ($current_lang === 'vi') : ?>
                                    <svg width="18" height="18" viewBox="0 0 512 512" fill="none">
                                        <mask id="vn-flag-mask-dt" maskUnits="userSpaceOnUse" x="0" y="0" width="512" height="512">
                                            <circle cx="256" cy="256" r="256" fill="#FFFFFF" />
                                        </mask>
                                        <g mask="url(#vn-flag-mask-dt)">
                                            <rect width="512" height="512" fill="#DA251D" />
                                            <polygon points="256,116 288,214 391,214 308,274 340,372 256,312 172,372 204,274 121,214 224,214" fill="#FFFF00" />
                                        </g>
                                    </svg>
                                <?php else : ?>
                                    <svg width="18" height="18" viewBox="0 0 512 512" fill="none">
                                        <mask id="uk-flag-mask-dt" maskUnits="userSpaceOnUse" x="0" y="0" width="512" height="512">
                                            <circle cx="256" cy="256" r="256" fill="#FFFFFF" />
                                        </mask>
                                        <g mask="url(#uk-flag-mask-dt)">
                                            <rect width="512" height="512" fill="#012169" />
                                            <path d="M0 0L512 512M512 0L0 512" stroke="#FFFFFF" stroke-width="60" />
                                            <path d="M0 0L512 512M512 0L0 512" stroke="#C8102E" stroke-width="36" />
                                            <path d="M256 0V512M0 256H512" stroke="#FFFFFF" stroke-width="100" />
                                            <path d="M256 0V512M0 256H512" stroke="#C8102E" stroke-width="60" />
                                        </g>
                                    </svg>
                                <?php endif; ?>
                            </span>
                            <span class="txt txt-13 txt-med header-lang-code" id="headerLangCurrentCode"><?php echo strtoupper($current_lang); ?></span>
                            <svg class="header-lang-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none">
                                <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>

                        <!-- Dropdown Menu -->
                        <div class="header-lang-dropdown">
                            <?php if ($current_lang === 'vi') : ?>
                                <a href="<?php echo esc_url($vi_url); ?>" class="header-lang-item active" data-lang="VI">
                                    <span class="header-lang-flag">
                                        <svg width="18" height="18" viewBox="0 0 512 512" fill="none">
                                            <mask id="vn-flag-opt-dt" maskUnits="userSpaceOnUse" x="0" y="0" width="512"
                                                height="512">
                                                <circle cx="256" cy="256" r="256" fill="#FFFFFF" />
                                            </mask>
                                            <g mask="url(#vn-flag-opt-dt)">
                                                <rect width="512" height="512" fill="#DA251D" />
                                                <polygon
                                                    points="256,116 288,214 391,214 308,274 340,372 256,312 172,372 204,274 121,214 224,214"
                                                    fill="#FFFF00" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="txt txt-13 txt-med header-lang-name">Tiếng Việt</span>
                                    <span class="txt txt-13 header-lang-badge">VI</span>
                                </a>
                                <a href="<?php echo esc_url($en_url); ?>" class="header-lang-item" data-lang="EN">
                                    <span class="header-lang-flag">
                                        <svg width="18" height="18" viewBox="0 0 512 512" fill="none">
                                            <mask id="uk-flag-opt-dt" maskUnits="userSpaceOnUse" x="0" y="0" width="512"
                                                height="512">
                                                <circle cx="256" cy="256" r="256" fill="#FFFFFF" />
                                            </mask>
                                            <g mask="url(#uk-flag-opt-dt)">
                                                <rect width="512" height="512" fill="#012169" />
                                                <path d="M0 0L512 512M512 0L0 512" stroke="#FFFFFF" stroke-width="60" />
                                                <path d="M0 0L512 512M512 0L0 512" stroke="#C8102E" stroke-width="36" />
                                                <path d="M256 0V512M0 256H512" stroke="#FFFFFF" stroke-width="100" />
                                                <path d="M256 0V512M0 256H512" stroke="#C8102E" stroke-width="60" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="txt txt-13 txt-med header-lang-name">English</span>
                                    <span class="txt txt-13 header-lang-badge">EN</span>
                                </a>
                            <?php else : ?>
                                <a href="<?php echo esc_url($en_url); ?>" class="header-lang-item active" data-lang="EN">
                                    <span class="header-lang-flag">
                                        <svg width="18" height="18" viewBox="0 0 512 512" fill="none">
                                            <mask id="uk-flag-opt-dt" maskUnits="userSpaceOnUse" x="0" y="0" width="512"
                                                height="512">
                                                <circle cx="256" cy="256" r="256" fill="#FFFFFF" />
                                            </mask>
                                            <g mask="url(#uk-flag-opt-dt)">
                                                <rect width="512" height="512" fill="#012169" />
                                                <path d="M0 0L512 512M512 0L0 512" stroke="#FFFFFF" stroke-width="60" />
                                                <path d="M0 0L512 512M512 0L0 512" stroke="#C8102E" stroke-width="36" />
                                                <path d="M256 0V512M0 256H512" stroke="#FFFFFF" stroke-width="100" />
                                                <path d="M256 0V512M0 256H512" stroke="#C8102E" stroke-width="60" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="txt txt-13 txt-med header-lang-name">English</span>
                                    <span class="txt txt-13 header-lang-badge">EN</span>
                                </a>
                                <a href="<?php echo esc_url($vi_url); ?>" class="header-lang-item" data-lang="VI">
                                    <span class="header-lang-flag">
                                        <svg width="18" height="18" viewBox="0 0 512 512" fill="none">
                                            <mask id="vn-flag-opt-dt" maskUnits="userSpaceOnUse" x="0" y="0" width="512"
                                                height="512">
                                                <circle cx="256" cy="256" r="256" fill="#FFFFFF" />
                                            </mask>
                                            <g mask="url(#vn-flag-opt-dt)">
                                                <rect width="512" height="512" fill="#DA251D" />
                                                <polygon
                                                    points="256,116 288,214 391,214 308,274 340,372 256,312 172,372 204,274 121,214 224,214"
                                                    fill="#FFFF00" />
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="txt txt-13 txt-med header-lang-name">Tiếng Việt</span>
                                    <span class="txt txt-13 header-lang-badge">VI</span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Main Bar -->
        <div class="header-main">
            <div class="container grid header-main-inner">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo">
                    <img src="<?php echo esc_url($header_logo_url); ?>" class="img-basic" alt="Double T Logo">
                </a>
                <nav class="header-menu">
                    <div class="header-top tablet">
                        <div class="header-top-inner">
                            <div class="header-top-right">
                                <a href="<?php echo esc_url($header_profile_url); ?>" <?php if ($header_profile_file) echo 'target="_blank" download'; ?> class="header-top-link txt txt-13 txt-med">2T Profile</a>
                                <a href="<?php echo esc_url($header_vr360_url); ?>" <?php if ($header_vr360_url !== '#') echo 'target="_blank" rel="noopener"'; ?> class="header-top-link txt txt-13 txt-med">VR360</a>
                                <div class="header-lang" id="headerLangMb" tabindex="0" role="button" aria-haspopup="true"
                                    aria-expanded="false" aria-label="Select language">
                                    <div class="header-lang-trigger">
                                        <span class="header-lang-flag" id="headerLangCurrentFlagMb">
                                            <?php if ($current_lang === 'vi') : ?>
                                                <svg width="18" height="18" viewBox="0 0 512 512" fill="none">
                                                    <mask id="vn-flag-mask-mb" maskUnits="userSpaceOnUse" x="0" y="0"
                                                        width="512" height="512">
                                                        <circle cx="256" cy="256" r="256" fill="#FFFFFF" />
                                                    </mask>
                                                    <g mask="url(#vn-flag-mask-mb)">
                                                        <rect width="512" height="512" fill="#DA251D" />
                                                        <polygon
                                                            points="256,116 288,214 391,214 308,274 340,372 256,312 172,372 204,274 121,214 224,214"
                                                            fill="#FFFF00" />
                                                    </g>
                                                </svg>
                                            <?php else : ?>
                                                <svg width="18" height="18" viewBox="0 0 512 512" fill="none">
                                                    <mask id="uk-flag-mask-mb" maskUnits="userSpaceOnUse" x="0" y="0"
                                                        width="512" height="512">
                                                        <circle cx="256" cy="256" r="256" fill="#FFFFFF" />
                                                    </mask>
                                                    <g mask="url(#uk-flag-mask-mb)">
                                                        <rect width="512" height="512" fill="#012169" />
                                                        <path d="M0 0L512 512M512 0L0 512" stroke="#FFFFFF"
                                                            stroke-width="60" />
                                                        <path d="M0 0L512 512M512 0L0 512" stroke="#C8102E"
                                                            stroke-width="36" />
                                                        <path d="M256 0V512M0 256H512" stroke="#FFFFFF"
                                                            stroke-width="100" />
                                                        <path d="M256 0V512M0 256H512" stroke="#C8102E" stroke-width="60" />
                                                    </g>
                                                </svg>
                                            <?php endif; ?>
                                        </span>
                                        <span class="txt txt-13 txt-med header-lang-code"
                                            id="headerLangCurrentCodeMb"><?php echo strtoupper($current_lang); ?></span>
                                        <svg class="header-lang-arrow" width="10" height="6" viewBox="0 0 10 6"
                                            fill="none">
                                            <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>

                                    <!-- Dropdown Menu -->
                                    <div class="header-lang-dropdown">
                                        <?php if ($current_lang === 'vi') : ?>
                                            <a href="<?php echo esc_url($vi_url); ?>" class="header-lang-item active" data-lang="VI">
                                                <span class="header-lang-flag">
                                                    <svg width="18" height="18" viewBox="0 0 512 512" fill="none">
                                                        <mask id="vn-flag-opt-mb" maskUnits="userSpaceOnUse" x="0" y="0"
                                                            width="512" height="512">
                                                            <circle cx="256" cy="256" r="256" fill="#FFFFFF" />
                                                        </mask>
                                                        <g mask="url(#vn-flag-opt-mb)">
                                                            <rect width="512" height="512" fill="#DA251D" />
                                                            <polygon
                                                                points="256,116 288,214 391,214 308,274 340,372 256,312 172,372 204,274 121,214 224,214"
                                                                fill="#FFFF00" />
                                                        </g>
                                                    </svg>
                                                </span>
                                                <span class="txt txt-13 txt-med header-lang-name">Tiếng Việt</span>
                                                <span class="txt txt-13 header-lang-badge">VI</span>
                                            </a>
                                            <a href="<?php echo esc_url($en_url); ?>" class="header-lang-item" data-lang="EN">
                                                <span class="header-lang-flag">
                                                    <svg width="18" height="18" viewBox="0 0 512 512" fill="none">
                                                        <mask id="uk-flag-opt-mb" maskUnits="userSpaceOnUse" x="0" y="0"
                                                            width="512" height="512">
                                                            <circle cx="256" cy="256" r="256" fill="#FFFFFF" />
                                                        </mask>
                                                        <g mask="url(#uk-flag-opt-mb)">
                                                            <rect width="512" height="512" fill="#012169" />
                                                            <path d="M0 0L512 512M512 0L0 512" stroke="#FFFFFF"
                                                                stroke-width="60" />
                                                            <path d="M0 0L512 512M512 0L0 512" stroke="#C8102E"
                                                                stroke-width="36" />
                                                            <path d="M256 0V512M0 256H512" stroke="#FFFFFF"
                                                                stroke-width="100" />
                                                            <path d="M256 0V512M0 256H512" stroke="#C8102E"
                                                                stroke-width="60" />
                                                        </g>
                                                    </svg>
                                                </span>
                                                <span class="txt txt-13 txt-med header-lang-name">English</span>
                                                <span class="txt txt-13 header-lang-badge">EN</span>
                                            </a>
                                        <?php else : ?>
                                            <a href="<?php echo esc_url($en_url); ?>" class="header-lang-item active" data-lang="EN">
                                                <span class="header-lang-flag">
                                                    <svg width="18" height="18" viewBox="0 0 512 512" fill="none">
                                                        <mask id="uk-flag-opt-mb" maskUnits="userSpaceOnUse" x="0" y="0"
                                                            width="512" height="512">
                                                            <circle cx="256" cy="256" r="256" fill="#FFFFFF" />
                                                        </mask>
                                                        <g mask="url(#uk-flag-opt-mb)">
                                                            <rect width="512" height="512" fill="#012169" />
                                                            <path d="M0 0L512 512M512 0L0 512" stroke="#FFFFFF"
                                                                stroke-width="60" />
                                                            <path d="M0 0L512 512M512 0L0 512" stroke="#C8102E"
                                                                stroke-width="36" />
                                                            <path d="M256 0V512M0 256H512" stroke="#FFFFFF"
                                                                stroke-width="100" />
                                                            <path d="M256 0V512M0 256H512" stroke="#C8102E"
                                                                stroke-width="60" />
                                                        </g>
                                                    </svg>
                                                </span>
                                                <span class="txt txt-13 txt-med header-lang-name">English</span>
                                                <span class="txt txt-13 header-lang-badge">EN</span>
                                            </a>
                                            <a href="<?php echo esc_url($vi_url); ?>" class="header-lang-item" data-lang="VI">
                                                <span class="header-lang-flag">
                                                    <svg width="18" height="18" viewBox="0 0 512 512" fill="none">
                                                        <mask id="vn-flag-opt-mb" maskUnits="userSpaceOnUse" x="0" y="0"
                                                            width="512" height="512">
                                                            <circle cx="256" cy="256" r="256" fill="#FFFFFF" />
                                                        </mask>
                                                        <g mask="url(#vn-flag-opt-mb)">
                                                            <rect width="512" height="512" fill="#DA251D" />
                                                            <polygon
                                                                points="256,116 288,214 391,214 308,274 340,372 256,312 172,372 204,274 121,214 224,214"
                                                                fill="#FFFF00" />
                                                        </g>
                                                    </svg>
                                                </span>
                                                <span class="txt txt-13 txt-med header-lang-name">Tiếng Việt</span>
                                                <span class="txt txt-13 header-lang-badge">VI</span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($header_nav_items)) : ?>
                        <?php foreach ($header_nav_items as $item) : 
                            $is_current = function_exists('themax_is_nav_item_active') && themax_is_nav_item_active($item) ? ' active' : '';
                        ?>
                            <a href="<?php echo esc_url($item->url); ?>" class="header-menu-item<?php echo $is_current; ?>" <?php if (!empty($item->target)) echo 'target="' . esc_attr($item->target) . '"'; ?>>
                                <span class="txt txt-14 txt-med"><?php echo esc_html(mb_strtoupper($item->title, 'UTF-8')); ?></span>
                            </a>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="header-menu-item<?php if (is_front_page() || is_home()) echo ' active'; ?>">
                            <span class="txt txt-14 txt-med">HOME</span>
                        </a>
                        <a href="<?php echo esc_url(home_url('/commitment/')); ?>" class="header-menu-item<?php if (is_page('commitment') || is_page_template('page-templates/commitment.php') || is_page_template('commitment.php')) echo ' active'; ?>">
                            <span class="txt txt-14 txt-med">OUR COMMITMENT</span>
                        </a>
                        <a href="<?php echo esc_url(home_url('/product-service/')); ?>" class="header-menu-item<?php if (is_page('product-service') || is_page_template('page-templates/product-service.php') || is_page_template('product-service.php') || is_page_template('page-templates/product-service-detail.php') || is_page_template('product-service-detail.php') || is_singular('product-and-service') || is_singular('productandservice') || is_singular('product-service') || is_singular('product_service')) echo ' active'; ?>">
                            <span class="txt txt-14 txt-med">PRODUCT &amp; SERVICE</span>
                        </a>
                        <a href="<?php echo esc_url(home_url('/insight/')); ?>" class="header-menu-item<?php if (is_page('insight') || is_page_template('page-templates/insight.php') || is_page_template('insight.php') || is_page_template('page-templates/insight-category.php') || is_page_template('page-templates/insight-detail.php') || is_category() || is_singular('post') || (is_single() && !is_singular('career') && !is_singular('product-and-service') && !is_singular('productandservice'))) echo ' active'; ?>">
                            <span class="txt txt-14 txt-med">INSIGHT</span>
                        </a>
                        <a href="<?php echo esc_url(home_url('/careers/')); ?>" class="header-menu-item<?php if (is_page('careers') || is_page('career') || is_page_template('page-templates/careers.php') || is_page_template('careers.php') || is_page_template('page-templates/career-detail.php') || is_page_template('career-detail.php') || is_singular('career') || is_singular('careers')) echo ' active'; ?>">
                            <span class="txt txt-14 txt-med">CAREERS</span>
                        </a>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="header-menu-item<?php if (is_page('contact') || is_page_template('page-templates/contact.php') || is_page_template('contact.php')) echo ' active'; ?>">
                            <span class="txt txt-14 txt-med">CONTACT</span>
                        </a>
                    <?php endif; ?>
                    <div class="header-cta-wrap tablet">
                        <a href="<?php echo esc_url($header_cta_link); ?>" class="header-cta btn btn-primary" <?php if ($header_cta_link === '#' || empty($header_cta_link)) echo 'data-modal-target="consultationModal"'; ?>>
                            <span class="txt txt-14 txt-semi"><?php echo esc_html($header_cta_text); ?></span>
                        </a>
                    </div>
                    <div class="header_menu_caption tablet"><?php echo esc_html($header_slogan); ?></div>
                </nav>
                <div class="header-iconmenu tablet">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="header-cta-wrap desktop">
                    <a href="<?php echo esc_url($header_cta_link); ?>" class="header-cta btn btn-primary" <?php if ($header_cta_link === '#' || empty($header_cta_link)) echo 'data-modal-target="consultationModal"'; ?>>
                        <span class="txt txt-14 txt-semi"><?php echo esc_html($header_cta_text); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </header>