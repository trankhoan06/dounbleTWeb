<?php
/**
 * Template Name: Insight Category
 */
get_header(); ?>



    <main class="main" id="mainContent">
        <section class="cat-hero" aria-labelledby="catHeroTitle">
            <div class="cat-hero-inner">
                <div class="cat-hero-panel hero-enter-item hero-enter-panel">
                    <div class="container cat-hero-container">
                        <nav class="cat-breadcrumb txt txt-14 txt-14_tb txt-14_mb" aria-label="Breadcrumb">
                            <a href="./index.html">Home</a>
                            <span class="cat-breadcrumb-devi" aria-hidden="true">/</span>
                            <a class="middle" href="./product-service.html">Product &amp; Service</a>
                            <a class="mobile" href="./product-service.html">...</a>
                            <span class="cat-breadcrumb-devi" aria-hidden="true">/</span>
                            <span class="current">Market News</span>
                        </nav>
                        <h1 class="heading h1 h2_tb h3_mb cat-hero-title" id="catHeroTitle">
                            MARKET NEWS
                        </h1>
                    </div>
                </div>
                <div class="cat-hero-media desktop hero-enter-item">
                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/hero-img.jpg" class="img-fill" alt="Double T steel processing plant" loading="eager" fetchpriority="high" decoding="async">
                </div>
            </div>
        </section>

        <section class="cat-listing-section page-first-section-reveal reveal-ready" id="categoryListingSection">
            <div class="container">
                <div class="cat-listing-layout">

                    <!-- Left Main Column: 3x4 Grid of Articles -->
                    <div class="cat-main-col">
                        <div class="cat-articles-grid" id="catArticlesGrid">

                        </div>

                        <!-- Pagination Navigation matching mockup -->
                        <div class="cat-pagination-wrap">
                            <nav class="cat-pagination cut-diagonal" aria-label="Article page navigation">
                                <a href="#" class="cat-page-btn cut-tl active" aria-current="page" data-page="1">
                                    <span class="txt txt-15 txt-14_tb txt-semi">1</span>
                                </a>
                                <a href="#" class="cat-page-btn" data-page="2">
                                    <span class="txt txt-15 txt-14_tb txt-semi">2</span>
                                </a>
                                <a href="#" class="cat-page-btn" data-page="3">
                                    <span class="txt txt-15 txt-14_tb txt-semi">3</span>
                                </a>
                                <span class="cat-page-dots txt txt-15 txt-14_tb txt-semi" aria-hidden="true">...</span>
                                <a href="#" class="cat-page-btn" data-page="8">
                                    <span class="txt txt-15 txt-14_tb txt-semi">8</span>
                                </a>
                                <a href="#" class="cat-page-btn" data-page="9">
                                    <span class="txt txt-15 txt-14_tb txt-semi">9</span>
                                </a>
                                <a href="#" class="cat-page-btn cut-br" data-page="10">
                                    <span class="txt txt-15 txt-14_tb txt-semi">10</span>
                                </a>
                            </nav>
                        </div>
                    </div>

                    <!-- Right Sidebar: Widgets Column -->
                    <aside class="cat-sidebar" aria-label="Sidebar highlights">
                        <!-- Widget 1: Promo Banner Card -->
                        <div class="cat-promo-card cut-tl">
                            <div class="cat-promo-img-wrap">
                                <img src="<?php echo get_template_directory_uri(); ?>/imgs/commit-intro.jpg" alt="Double T factory engineer and steel processing"
                                    loading="lazy">
                            </div>
                            <div class="cat-promo-content">
                                <div class="cat-promo-watermark" aria-hidden="true">
                                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/logo_marker.png" alt="">
                                </div>
                                <div class="cat-promo-badge label label-red cut-diagonal">
                                    <span class="txt txt-13 txt-bold">PRODUCT DOUBLE T</span>
                                </div>
                                <h3 class="heading h5 h4_mb cat-promo-title">
                                    Professional steel supplier and processor.
                                </h3>
                                <a href="./product-service.html" class="cat-promo-btn btn-outline btn">
                                    <span class="txt txt-13 txt-semi cat-promo-btn-text">VIEW ALL PRODUCTS</span>
                                    <span class="cat-promo-btn-accent" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>

                        <!-- Widget 2: Other Category Card -->
                        <div class="cat-sidebar-widget cut-tl" id="catSidebarOtherWidget">
                            <?php
                            $current_lang = function_exists('pll_current_language') ? pll_current_language('slug') : 'en';
                            $current_lang = strtolower($current_lang ?: 'en');
                            $cat_slug_param = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
                            $current_cat = !empty($cat_slug_param) ? get_category_by_slug($cat_slug_param) : null;
                            $current_cat_id = $current_cat ? (int)$current_cat->term_id : 0;

                            $cat_args = array(
                                'taxonomy'   => 'category',
                                'exclude'    => array($current_cat_id),
                                'hide_empty' => false,
                            );
                            if (function_exists('pll_current_language')) {
                                $cat_args['lang'] = $current_lang;
                            }
                            $other_categories = get_categories($cat_args);

                            if (!empty($other_categories)) {
                                $non_default = array_values(array_filter($other_categories, function($cat) {
                                    return !in_array($cat->slug, array('uncategorized', 'chua-phan-loai'));
                                }));
                                if (!empty($non_default)) {
                                    $other_categories = $non_default;
                                }
                            }

                            $cats_with_posts = array_values(array_filter($other_categories, function($cat) {
                                return (int)$cat->count > 0;
                            }));
                            $eligible_cats = !empty($cats_with_posts) ? $cats_with_posts : $other_categories;

                            $random_cat = null;
                            if (!empty($eligible_cats)) {
                                $rand_key = array_rand($eligible_cats);
                                $random_cat = $eligible_cats[$rand_key];
                            }

                            if ($random_cat) {
                                $widget_cat_title = mb_strtoupper($random_cat->name, 'UTF-8');
                                $widget_cat_url   = get_category_link($random_cat->term_id);

                                $sidebar_args = array(
                                    'post_type'      => 'post',
                                    'posts_per_page' => 4,
                                    'post_status'    => 'publish',
                                    'tax_query'      => array(
                                        array(
                                            'taxonomy' => 'category',
                                            'field'    => 'term_id',
                                            'terms'    => $random_cat->term_id,
                                        ),
                                    ),
                                );
                                if (function_exists('pll_current_language')) {
                                    $sidebar_args['lang'] = $current_lang;
                                }
                                $sidebar_posts = get_posts($sidebar_args);
                            } else {
                                $widget_cat_title = $current_lang === 'vi' ? 'BÀI VIẾT GẦN ĐÂY' : 'RECENT ARTICLES';
                                $widget_cat_url   = home_url('/insight/');

                                $sidebar_args = array(
                                    'post_type'      => 'post',
                                    'posts_per_page' => 4,
                                    'post_status'    => 'publish',
                                );
                                if (function_exists('pll_current_language')) {
                                    $sidebar_args['lang'] = $current_lang;
                                }
                                $sidebar_posts = get_posts($sidebar_args);
                            }
                            ?>
                            <div class="cat-widget-head">
                                <div class="cat-widget-tag cut-tl" id="catWidgetTag">
                                    <span class="txt txt-14 txt-semi cat-widget-tag-text" id="catWidgetTagText"><?php echo esc_html($widget_cat_title); ?></span>
                                </div>
                            </div>

                            <div class="cat-widget-list" id="catWidgetList">
                                <?php
                                if ($sidebar_posts) :
                                    foreach ($sidebar_posts as $spost) :
                                ?>
                                    <a href="<?php echo esc_url(get_permalink($spost->ID)); ?>" class="cat-mini-card hover-img">
                                        <div class="cat-mini-img cut-tl">
                                            <?php if (has_post_thumbnail($spost->ID)) : ?>
                                                <?php echo get_the_post_thumbnail($spost->ID, 'thumbnail', array('class' => 'img-fill')); ?>
                                            <?php else : ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/imgs/product.jpg" class="img-fill" alt="<?php echo esc_attr(get_the_title($spost->ID)); ?>" loading="lazy">
                                            <?php endif; ?>
                                        </div>
                                        <h4 class="txt txt-16 txt-16_mb txt-semi cat-mini-title"><?php echo esc_html(get_the_title($spost->ID)); ?></h4>
                                    </a>
                                <?php
                                    endforeach;
                                    wp_reset_postdata();
                                endif;
                                ?>
                            </div>

                            <div class="cat-widget-footer">
                                <a href="<?php echo esc_url($widget_cat_url); ?>" class="cat-widget-viewall"
                                    id="catWidgetViewAllLink" aria-label="<?php echo esc_attr('View all ' . $widget_cat_title . ' articles'); ?>">
                                    <span class="txt txt-14 txt-semi cat-widget-viewall-text"><?php echo esc_html($current_lang === 'vi' ? 'XEM TẤT CẢ' : 'VIEW ALL'); ?></span>
                                    <svg class="cat-widget-viewall-icon" viewBox="0 0 8 12" aria-hidden="true">
                                        <path d="M1.5 1.5L6 6L1.5 10.5" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </aside>

                </div>
            </div>
        </section>

        <?php render_consultation_cta(); ?>

    </main>

    
<?php get_footer(); ?>
