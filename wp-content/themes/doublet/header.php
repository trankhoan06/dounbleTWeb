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

<body>

    <!-- Header -->
    <header class="header">
        <!-- Header Top Bar -->
        <div class="header-top desktop">
            <div class="container header-top-inner">
                <div class="header-top-left">
                    <span class="txt txt-13 txt-italic header-top-slogan">Professional steel supplying &amp;
                        processing</span>
                </div>
                <div class="header-top-right">
                    <a href="#" class="header-top-link txt txt-13 txt-med">2T Profile</a>
                    <span class="header-top-divider"></span>
                    <a href="#" class="header-top-link txt txt-13 txt-med">VR360</a>
                    <span class="header-top-divider"></span>
                    <div class="header-lang" id="headerLang" tabindex="0" role="button" aria-haspopup="true"
                        aria-expanded="false" aria-label="Select language">
                        <div class="header-lang-trigger">
                            <span class="header-lang-flag" id="headerLangCurrentFlag">
                                <svg width="18" height="18" viewBox="0 0 512 512" fill="none">
                                    <mask id="uk-flag-mask" maskUnits="userSpaceOnUse" x="0" y="0" width="512"
                                        height="512">
                                        <circle cx="256" cy="256" r="256" fill="#FFFFFF" />
                                    </mask>
                                    <g mask="url(#uk-flag-mask)">
                                        <rect width="512" height="512" fill="#012169" />
                                        <path d="M0 0L512 512M512 0L0 512" stroke="#FFFFFF" stroke-width="60" />
                                        <path d="M0 0L512 512M512 0L0 512" stroke="#C8102E" stroke-width="36" />
                                        <path d="M256 0V512M0 256H512" stroke="#FFFFFF" stroke-width="100" />
                                        <path d="M256 0V512M0 256H512" stroke="#C8102E" stroke-width="60" />
                                    </g>
                                </svg>
                            </span>
                            <span class="txt txt-13 txt-med header-lang-code" id="headerLangCurrentCode">EN</span>
                            <svg class="header-lang-arrow" width="10" height="6" viewBox="0 0 10 6" fill="none">
                                <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>

                        <!-- Dropdown Menu -->
                        <div class="header-lang-dropdown">
                            <div class="header-lang-item active" data-lang="EN">
                                <span class="header-lang-flag">
                                    <svg width="18" height="18" viewBox="0 0 512 512" fill="none">
                                        <mask id="uk-flag-opt" maskUnits="userSpaceOnUse" x="0" y="0" width="512"
                                            height="512">
                                            <circle cx="256" cy="256" r="256" fill="#FFFFFF" />
                                        </mask>
                                        <g mask="url(#uk-flag-opt)">
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
                            </div>
                            <div class="header-lang-item" data-lang="VI">
                                <span class="header-lang-flag">
                                    <svg width="18" height="18" viewBox="0 0 512 512" fill="none">
                                        <mask id="vn-flag-opt" maskUnits="userSpaceOnUse" x="0" y="0" width="512"
                                            height="512">
                                            <circle cx="256" cy="256" r="256" fill="#FFFFFF" />
                                        </mask>
                                        <g mask="url(#vn-flag-opt)">
                                            <rect width="512" height="512" fill="#DA251D" />
                                            <polygon
                                                points="256,116 288,214 391,214 308,274 340,372 256,312 172,372 204,274 121,214 224,214"
                                                fill="#FFFF00" />
                                        </g>
                                    </svg>
                                </span>
                                <span class="txt txt-13 txt-med header-lang-name">Tiếng Việt</span>
                                <span class="txt txt-13 header-lang-badge">VI</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Main Bar -->
        <div class="header-main">
            <div class="container grid header-main-inner">
                <a href="./index.html" class="header-logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/logo.png" class="img-basic" alt="Double T Logo">
                </a>
                <nav class="header-menu">
                    <div class="header-top tablet">
                        <div class="header-top-inner">
                            <div class="header-top-right">
                                <a href="#" class="header-top-link txt txt-13 txt-med">2T Profile</a>
                                <a href="#" class="header-top-link txt txt-13 txt-med">VR360</a>
                                <div class="header-lang" id="headerLang" tabindex="0" role="button" aria-haspopup="true"
                                    aria-expanded="false" aria-label="Select language">
                                    <div class="header-lang-trigger">
                                        <span class="header-lang-flag" id="headerLangCurrentFlag">
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
                                        </span>
                                        <span class="txt txt-13 txt-med header-lang-code"
                                            id="headerLangCurrentCode">EN</span>
                                        <svg class="header-lang-arrow" width="10" height="6" viewBox="0 0 10 6"
                                            fill="none">
                                            <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>

                                    <!-- Dropdown Menu -->
                                    <div class="header-lang-dropdown">
                                        <div class="header-lang-item active" data-lang="EN">
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
                                        </div>
                                        <div class="header-lang-item" data-lang="VI">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="./index.html" class="header-menu-item">
                        <span class="txt txt-14 txt-med">HOME</span>
                    </a>
                    <a href="./commitment.html" class="header-menu-item">
                        <span class="txt txt-14 txt-med">OUR COMMITMENT</span>
                    </a>
                    <a href="./product-service.html" class="header-menu-item">
                        <span class="txt txt-14 txt-med">PRODUCT &amp; SERVICE</span>
                    </a>
                    <a href="./insight.html" class="header-menu-item">
                        <span class="txt txt-14 txt-med">INSIGHT</span>
                    </a>
                    <a href="./careers.html" class="header-menu-item">
                        <span class="txt txt-14 txt-med">CAREERS</span>
                    </a>
                    <a href="#" class="header-menu-item">
                        <span class="txt txt-14 txt-med">CONTACT</span>
                    </a>
                    <div class="header-cta-wrap tablet">
                        <a href="#" class="header-cta btn btn-primary">
                            <span class="txt txt-14 txt-semi">FREE CONSULTATION</span>
                        </a>
                    </div>
                    <div class="header_menu_caption tablet">Professional steel supplying & processing</div>
                </nav>
                <div class="header-iconmenu tablet">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="header-cta-wrap desktop">
                    <a href="#" class="header-cta btn btn-primary">
                        <span class="txt txt-14 txt-semi">FREE CONSULTATION</span>
                    </a>
                </div>
            </div>
        </div>
    </header>