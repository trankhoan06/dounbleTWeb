<?php
/**
 * Template Name: Insight
 */
get_header();

// 1. Hero Section Fields
$insight_hero_bg_id = tr_posts_field('insight_hero_bg');
$insight_hero_bg_url = $insight_hero_bg_id ? wp_get_attachment_image_url($insight_hero_bg_id, 'full') : get_template_directory_uri() . '/imgs/commit-vison.jpg';
$insight_hero_breadcrumb = tr_posts_field('insight_hero_breadcrumb') ?: 'Insight';
$insight_hero_title = tr_posts_field('insight_hero_title') ?: 'NEWS &amp; OPERATIONS';

// 2. Insight Categories & Articles Fields
$insight_categories = tr_posts_field('insight_categories');
if (!is_array($insight_categories) || empty($insight_categories)) {
    $insight_categories = [
        [
            'tag' => 'MARKET NEWS',
            'slug' => 'market-news',
            'view_all_text' => 'VIEW ALL',
            'view_all_link' => './insight-category.html?category=market-news',
            'featured_title' => 'Lorem ipsum dolor sit amet consectetur. Nisl lobortis porta pharetra aliquam at.',
            'featured_excerpt' => 'Lorem ipsum dolor sit amet consectetur. Sit nam amet tellus gravida risus tellus. Interdum duis sollicitudin arcu dignissim. Dolor dis mattis sed quam sagittis massa pulvinar volutpat enim.',
            'featured_image' => '',
            'default_featured_image' => get_template_directory_uri() . '/imgs/product.jpg',
            'featured_link' => './insight-detail.html?id=1',
            'sub_articles' => [
                [
                    'title' => 'Global Steel Market Updates and Industry Insights',
                    'link' => './insight-detail.html?id=2',
                    'image' => '',
                    'default_image' => get_template_directory_uri() . '/imgs/service-item1.jpg',
                    'alt' => 'Modern automated steel manufacturing facility'
                ],
                [
                    'title' => 'Latest Trends Shaping the Global Steel Market',
                    'link' => './insight-detail.html?id=3',
                    'image' => '',
                    'default_image' => get_template_directory_uri() . '/imgs/application.jpg',
                    'alt' => 'High quality finished steel coils'
                ],
                [
                    'title' => 'Steel Market Outlook and Emerging Industry Trends',
                    'link' => './insight-detail.html?id=4',
                    'image' => '',
                    'default_image' => get_template_directory_uri() . '/imgs/video-thumb.jpg',
                    'alt' => 'Industrial structural steel beams and trusses'
                ],
                [
                    'title' => 'Key Developments Across the Global Steel Industry',
                    'link' => './insight-detail.html?id=5',
                    'image' => '',
                    'default_image' => get_template_directory_uri() . '/imgs/cta.jpg',
                    'alt' => 'Infrastructure development and steel application'
                ]
            ]
        ],
        [
            'tag' => 'COMPANY OPERATIONS',
            'slug' => 'company-operations',
            'view_all_text' => 'VIEW ALL',
            'view_all_link' => './insight-category.html?category=company-operations',
            'featured_title' => 'Lorem ipsum dolor sit amet consectetur. Nisl lobortis porta pharetra aliquam at.',
            'featured_excerpt' => 'Lorem ipsum dolor sit amet consectetur. Sit nam amet tellus gravida risus tellus. Interdum duis sollicitudin arcu dignissim. Dolor dis mattis sed quam sagittis massa pulvinar volutpat enim.',
            'featured_image' => '',
            'default_featured_image' => get_template_directory_uri() . '/imgs/product.jpg',
            'featured_link' => './insight-detail.html?id=6',
            'sub_articles' => [
                [
                    'title' => 'Global Steel Market Updates and Industry Insights',
                    'link' => './insight-detail.html?id=7',
                    'image' => '',
                    'default_image' => get_template_directory_uri() . '/imgs/service-item1.jpg',
                    'alt' => 'Modern automated steel manufacturing facility'
                ],
                [
                    'title' => 'Latest Trends Shaping the Global Steel Market',
                    'link' => './insight-detail.html?id=8',
                    'image' => '',
                    'default_image' => get_template_directory_uri() . '/imgs/application.jpg',
                    'alt' => 'High quality finished steel coils'
                ],
                [
                    'title' => 'Steel Market Outlook and Emerging Industry Trends',
                    'link' => './insight-detail.html?id=9',
                    'image' => '',
                    'default_image' => get_template_directory_uri() . '/imgs/video-thumb.jpg',
                    'alt' => 'Industrial structural steel beams and trusses'
                ],
                [
                    'title' => 'Key Developments Across the Global Steel Industry',
                    'link' => './insight-detail.html?id=10',
                    'image' => '',
                    'default_image' => get_template_directory_uri() . '/imgs/cta.jpg',
                    'alt' => 'Infrastructure development and steel application'
                ]
            ]
        ]
    ];
}
?>

    <main class="main" id="mainContent">
        <!-- 1. Hero Section -->
        <section class="insight-hero" aria-labelledby="insightHeroTitle">
            <div class="insight-hero-bg">
                <img src="<?php echo esc_url($insight_hero_bg_url); ?>" class="img-fill"
                    alt="Double T steel processing manufacturing facility">
            </div>
            <div class="container insight-hero-container">
                <div class="insight-hero-panel">
                    <div class="insight-hero-panel-bg cut-tr"></div>
                    <nav class="insight-breadcrumb txt txt-14 txt-14_tb txt-14_mb" aria-label="Breadcrumb">
                        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                        <span class="separator" aria-hidden="true">/</span>
                        <span class="current"><?php echo esc_html($insight_hero_breadcrumb); ?></span>
                    </nav>
                    <h1 class="heading h1 h3_mb insight-hero-title" id="insightHeroTitle">
                        <?php echo wp_kses_post($insight_hero_title); ?>
                    </h1>
                </div>
            </div>
        </section>

        <!-- 2. Categories Container -->
        <div class="insight-categories" id="insightCategoriesContainer">
            <?php 
            $cat_idx = 0;
            foreach ($insight_categories as $cat): 
                $cat_idx++;
                $c_tag = !empty($cat['tag']) ? $cat['tag'] : 'CATEGORY ' . $cat_idx;
                $c_slug = !empty($cat['slug']) ? $cat['slug'] : 'category-' . $cat_idx;
                $c_va_text = !empty($cat['view_all_text']) ? $cat['view_all_text'] : 'VIEW ALL';
                $c_va_link = !empty($cat['view_all_link']) ? $cat['view_all_link'] : '#';

                // Featured Post
                $f_title = !empty($cat['featured_title']) ? $cat['featured_title'] : '';
                $f_excerpt = !empty($cat['featured_excerpt']) ? $cat['featured_excerpt'] : '';
                $f_link = !empty($cat['featured_link']) ? $cat['featured_link'] : '#';
                $f_img_url = '';
                if (!empty($cat['featured_image'])) {
                    $f_img_url = wp_get_attachment_image_url($cat['featured_image'], 'full');
                }
                if (!$f_img_url && !empty($cat['default_featured_image'])) {
                    $f_img_url = $cat['default_featured_image'];
                }
                if (!$f_img_url) {
                    $f_img_url = get_template_directory_uri() . '/imgs/product.jpg';
                }

                $sub_articles = !empty($cat['sub_articles']) && is_array($cat['sub_articles']) ? $cat['sub_articles'] : [];
            ?>
                <section class="insight-category" id="<?php echo esc_attr($c_slug); ?>" data-category="<?php echo esc_attr($c_slug); ?>"
                    aria-labelledby="catLabel-<?php echo esc_attr($c_slug); ?>">
                    <div class="container">
                        <!-- Category Header Bar -->
                        <div class="insight-category-bar">
                            <div class="insight-category-tag cut-tl" id="catLabel-<?php echo esc_attr($c_slug); ?>">
                                <span class="txt txt-16 txt-14_tb txt-semi insight-category-tag-text"><?php echo esc_html($c_tag); ?></span>
                            </div>
                            <a href="<?php echo esc_url($c_va_link); ?>" class="insight-view-all"
                                aria-label="View all <?php echo esc_attr($c_tag); ?> articles">
                                <span class="txt txt-14 txt-semi insight-view-all-text"><?php echo esc_html($c_va_text); ?></span>
                                <svg class="insight-view-all-icon" viewBox="0 0 8 12" aria-hidden="true">
                                    <path d="M1.5 1.5L6 6L1.5 10.5" />
                                </svg>
                            </a>
                        </div>

                        <!-- Category Articles Grid (1 Featured Post + Sub-posts in 2x2 grid) -->
                        <div class="insight-category-grid">
                            <!-- Featured Article (Left Column) -->
                            <article class="insight-featured-item" data-post-id="<?php echo esc_attr($cat_idx . '-feat'); ?>">
                                <a href="<?php echo esc_url($f_link); ?>" class="insight-featured-card hover-img">
                                    <div class="insight-card-img cut-tl">
                                        <img src="<?php echo esc_url($f_img_url); ?>" class="img-fill" alt="<?php echo esc_attr($f_title); ?>" loading="lazy">
                                    </div>
                                    <div class="insight-card-body">
                                        <h2 class="heading h4 h5_tb h6_mb insight-card-title">
                                            <?php echo esc_html($f_title); ?>
                                        </h2>
                                        <?php if ($f_excerpt): ?>
                                            <p class="txt txt-14 insight-card-excerpt middle">
                                                <?php echo esc_html($f_excerpt); ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </article>

                            <!-- Sub-articles 2x2 Grid (Right Column) -->
                            <div class="insight-subgrid">
                                <?php 
                                $sub_idx = 0;
                                foreach ($sub_articles as $sub): 
                                    $sub_idx++;
                                    $s_title = !empty($sub['title']) ? $sub['title'] : '';
                                    $s_link = !empty($sub['link']) ? $sub['link'] : '#';
                                    $s_alt = !empty($sub['alt']) ? $sub['alt'] : $s_title;
                                    
                                    $s_img_url = '';
                                    if (!empty($sub['image'])) {
                                        $s_img_url = wp_get_attachment_image_url($sub['image'], 'full');
                                    }
                                    if (!$s_img_url && !empty($sub['default_image'])) {
                                        $s_img_url = $sub['default_image'];
                                    }
                                    if (!$s_img_url) {
                                        $s_img_url = get_template_directory_uri() . '/imgs/service-item1.jpg';
                                    }
                                ?>
                                    <article class="insight-grid-item" data-post-id="<?php echo esc_attr($cat_idx . '-' . $sub_idx); ?>">
                                        <a href="<?php echo esc_url($s_link); ?>" class="insight-grid-card hover-img">
                                            <div class="insight-card-img cut-tl">
                                                <img src="<?php echo esc_url($s_img_url); ?>" class="img-fill" alt="<?php echo esc_attr($s_alt); ?>" loading="lazy">
                                            </div>
                                            <div class="insight-card-body">
                                                <h3 class="txt h6 heading txt-16_tb txt-semi insight-card-title">
                                                    <?php echo esc_html($s_title); ?>
                                                </h3>
                                            </div>
                                        </a>
                                    </article>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>

    </main>
    
<?php get_footer(); ?>