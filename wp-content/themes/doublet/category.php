<?php
/**
 * The template for displaying Category Archive pages (Insights / News)
 *
 * @package WordPress
 * @subpackage doublet
 */

get_header(); 

$current_lang = function_exists('pll_current_language') ? pll_current_language('slug') : 'en';
$current_lang = strtolower($current_lang ?: 'en');

$breadcrumb_home = $current_lang === 'vi' ? 'Trang chủ' : 'Home';
$breadcrumb_insight = $current_lang === 'vi' ? 'Tin tức' : 'Insights';
$insight_url = home_url($current_lang === 'vi' ? '/insight/' : '/insight/');
$prod_url = home_url($current_lang === 'vi' ? '/product-service/' : '/product-service/');
$view_all_prod_text = $current_lang === 'vi' ? 'XEM TẤT CẢ SẢN PHẨM' : 'VIEW ALL PRODUCTS';
$recent_articles_text = $current_lang === 'vi' ? 'BÀI VIẾT GẦN ĐÂY' : 'RECENT ARTICLES';
$view_all_text = $current_lang === 'vi' ? 'XEM TẤT CẢ' : 'VIEW ALL';
$empty_text = $current_lang === 'vi' ? 'Chưa có bài viết nào trong chuyên mục này.' : 'No articles found in this category.';
?>

    <main class="main" id="mainContent">
        <section class="cat-hero" aria-labelledby="catHeroTitle">
            <div class="cat-hero-inner">
                <div class="cat-hero-panel hero-enter-item hero-enter-panel">
                    <div class="container cat-hero-container">
                        <nav class="cat-breadcrumb txt txt-14 txt-14_tb txt-14_mb" aria-label="Breadcrumb">
                            <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($breadcrumb_home); ?></a>
                            <span class="cat-breadcrumb-devi" aria-hidden="true">/</span>
                            <a href="<?php echo esc_url($insight_url); ?>"><?php echo esc_html($breadcrumb_insight); ?></a>
                            <span class="cat-breadcrumb-devi" aria-hidden="true">/</span>
                            <span class="current" id="catBreadcrumbCurrent"><?php single_cat_title(); ?></span>
                        </nav>
                        <h1 class="heading h1 h2_tb h3_mb cat-hero-title" id="catHeroTitle">
                            <?php single_cat_title(); ?>
                        </h1>
                    </div>
                </div>
                <div class="cat-hero-media desktop hero-enter-item">
                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/hero-img.jpg" class="img-fill" alt="Double T steel processing plant">
                </div>
            </div>
        </section>

        <section class="cat-listing-section page-first-section-reveal reveal-ready" id="categoryListingSection">
            <div class="container">
                <div class="cat-listing-layout">

                    <!-- Left Main Column: Articles Grid -->
                    <div class="cat-main-col">
                        <div class="cat-articles-grid" id="catArticlesGrid">
                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                <article class="cat-article-item" data-post-id="<?php the_ID(); ?>">
                                    <a href="<?php the_permalink(); ?>" class="cat-article-card hover-img">
                                        <div class="cat-article-img cut-tl">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('full', array('class' => 'img-fill')); ?>
                                            <?php else : ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/imgs/product.jpg" class="img-fill" alt="<?php the_title_attribute(); ?>" loading="lazy">
                                            <?php endif; ?>
                                        </div>
                                        <div class="cat-article-body">
                                            <h2 class="txt txt-16 h6_mb txt-semi cat-article-title"><?php the_title(); ?></h2>
                                        </div>
                                    </a>
                                </article>
                            <?php endwhile; else : ?>
                                <article class="cat-article-item">
                                    <div class="cat-article-body">
                                        <p class="txt txt-16"><?php echo esc_html($empty_text); ?></p>
                                    </div>
                                </article>
                            <?php endif; ?>
                        </div>

                        <!-- Pagination Navigation -->
                        <div class="cat-pagination-wrap">
                            <?php
                            the_posts_pagination(array(
                                'mid_size'           => 2,
                                'prev_text'          => '<span class="txt txt-14 txt-semi">&laquo;</span>',
                                'next_text'          => '<span class="txt txt-14 txt-semi">&raquo;</span>',
                                'screen_reader_text' => ' ',
                                'class'              => 'cat-pagination cut-diagonal',
                            ));
                            ?>
                        </div>
                    </div>

                    <!-- Right Sidebar: Widgets Column -->
                    <aside class="cat-sidebar" aria-label="Sidebar highlights">
                        <!-- Widget 1: Promo Banner Card -->
                        <div class="cat-promo-card cut-tl">
                            <div class="cat-promo-img-wrap">
                                <img src="<?php echo get_template_directory_uri(); ?>/imgs/commit-intro.jpg" alt="Double T factory engineer and steel processing" loading="lazy">
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
                                <a href="<?php echo esc_url($prod_url); ?>" class="cat-promo-btn btn-outline btn">
                                    <span class="txt txt-13 txt-semi cat-promo-btn-text"><?php echo esc_html($view_all_prod_text); ?></span>
                                    <span class="cat-promo-btn-accent" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>

                        <!-- Widget 2: Other Posts Card -->
                        <div class="cat-sidebar-widget cut-tl" id="catSidebarOtherWidget">
                            <div class="cat-widget-head">
                                <div class="cat-widget-tag cut-tl" id="catWidgetTag">
                                    <span class="txt txt-14 txt-semi cat-widget-tag-text" id="catWidgetTagText"><?php echo esc_html($recent_articles_text); ?></span>
                                </div>
                            </div>

                            <div class="cat-widget-list" id="catWidgetList">
                                <?php
                                $sidebar_args = array(
                                    'post_type'      => 'post',
                                    'posts_per_page' => 4,
                                    'post_status'    => 'publish',
                                    'exclude'        => array(get_the_ID()),
                                );
                                if (function_exists('pll_current_language')) {
                                    $sidebar_args['lang'] = $current_lang;
                                }
                                $sidebar_posts = get_posts($sidebar_args);
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
                                        <h4 class="txt txt-14 txt-16_mb txt-semi cat-mini-title"><?php echo esc_html(get_the_title($spost->ID)); ?></h4>
                                    </a>
                                <?php
                                    endforeach;
                                    wp_reset_postdata();
                                endif;
                                ?>
                            </div>

                            <div class="cat-widget-footer">
                                <a href="<?php echo esc_url($insight_url); ?>" class="cat-widget-viewall" id="catWidgetViewAllLink" aria-label="View all related articles">
                                    <span class="txt txt-14 txt-semi cat-widget-viewall-text"><?php echo esc_html($view_all_text); ?></span>
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

    </main>

<?php get_footer(); ?>
