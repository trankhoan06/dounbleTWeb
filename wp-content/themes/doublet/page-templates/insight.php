<?php
/**
 * Template Name: Insight
 */
get_header();

// Language detection
$current_lang = function_exists('pll_current_language') ? pll_current_language('slug') : 'en';
$current_lang = strtolower($current_lang ?: 'en');

// 1. Hero Section Fields
$insight_hero_bg_id = tr_posts_field('insight_hero_bg');
$insight_hero_bg_url = $insight_hero_bg_id ? wp_get_attachment_image_url($insight_hero_bg_id, 'full') : get_template_directory_uri() . '/imgs/commit-vison.jpg';

if ($current_lang === 'vi') {
    $insight_hero_breadcrumb = tr_posts_field('insight_hero_breadcrumb_vi') ?: (tr_posts_field('insight_hero_breadcrumb') ?: 'Góc nhìn & Tin tức');
    $insight_hero_title = tr_posts_field('insight_hero_title_vi') ?: (tr_posts_field('insight_hero_title') ?: 'TIN TỨC &amp; HOẠT ĐỘNG');
    $default_view_all = 'XEM TẤT CẢ';
} else {
    $insight_hero_breadcrumb = tr_posts_field('insight_hero_breadcrumb') ?: 'Insight';
    $insight_hero_title = tr_posts_field('insight_hero_title') ?: 'NEWS &amp; OPERATIONS';
    $default_view_all = 'VIEW ALL';
}

// 2. Fetch Categories & Articles from WordPress by current language
$cat_query_args = array(
    'taxonomy'   => 'category',
    'orderby'    => 'name',
    'order'      => 'ASC',
    'hide_empty' => false,
);
if (function_exists('pll_current_language')) {
    $cat_query_args['lang'] = $current_lang;
}
$wp_categories = get_categories($cat_query_args);

$insight_sections = array();

if (!empty($wp_categories)) {
    foreach ($wp_categories as $cat) {
        // Query 5 posts per category (1 featured + 4 sub-posts)
        $posts_args = array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $cat->term_id,
                ),
            ),
            'posts_per_page' => 5,
            'orderby'        => 'date',
            'order'          => 'DESC',
        );
        if (function_exists('pll_current_language')) {
            $posts_args['lang'] = $current_lang;
        }

        $posts_query = new WP_Query($posts_args);

        if ($posts_query->have_posts()) {
            $cat_posts = $posts_query->posts;
            $feat_post = $cat_posts[0];
            $feat_thumb = get_the_post_thumbnail_url($feat_post->ID, 'full');
            $feat_excerpt = has_excerpt($feat_post->ID) 
                ? get_the_excerpt($feat_post->ID) 
                : wp_trim_words(strip_tags(strip_shortcodes($feat_post->post_content)), 30, '...');

            $sub_articles = array();
            $sub_posts = array_slice($cat_posts, 1);
            foreach ($sub_posts as $sub) {
                $sub_thumb = get_the_post_thumbnail_url($sub->ID, 'full');
                $sub_articles[] = array(
                    'id'        => $sub->ID,
                    'title'     => get_the_title($sub->ID),
                    'link'      => get_permalink($sub->ID),
                    'image_url' => $sub_thumb ?: (get_template_directory_uri() . '/imgs/service-item1.jpg'),
                    'alt'       => get_the_title($sub->ID),
                );
            }

            $insight_sections[] = array(
                'tag'              => mb_strtoupper($cat->name, 'UTF-8'),
                'slug'             => $cat->slug,
                'view_all_text'    => $default_view_all,
                'view_all_link'    => get_category_link($cat->term_id),
                'featured_id'      => $feat_post->ID,
                'featured_title'   => get_the_title($feat_post->ID),
                'featured_excerpt' => $feat_excerpt,
                'featured_link'    => get_permalink($feat_post->ID),
                'featured_image'   => $feat_thumb ?: (get_template_directory_uri() . '/imgs/product.jpg'),
                'sub_articles'     => $sub_articles,
            );
        } else {
            // Category has no posts yet: provide localized placeholder cards
            if ($current_lang === 'vi') {
                $f_placeholder_title = 'Cập nhật tin tức mới nhất về chuyên mục ' . $cat->name;
                $f_placeholder_excerpt = 'Những thông tin thị trường, định hướng phát triển và phân tích chuyên sâu mới nhất từ Double T.';
                $s_placeholder = [
                    ['title' => 'Xu hướng thị trường và định hướng phát triển ngành thép', 'image' => get_template_directory_uri() . '/imgs/service-item1.jpg'],
                    ['title' => 'Phân tích chuyên sâu về thị trường thép chất lượng cao tại Việt Nam', 'image' => get_template_directory_uri() . '/imgs/application.jpg'],
                    ['title' => 'Giải pháp thép cuộn và thép tấm phục vụ các dự án trọng điểm', 'image' => get_template_directory_uri() . '/imgs/video-thumb.jpg'],
                    ['title' => 'Tin tức hoạt động sản xuất và đổi mới công nghệ tại nhà máy Double T', 'image' => get_template_directory_uri() . '/imgs/cta.jpg'],
                ];
            } else {
                $f_placeholder_title = 'Latest updates and insights on ' . $cat->name;
                $f_placeholder_excerpt = 'Comprehensive market trends, operational milestones, and strategic perspectives from Double T.';
                $s_placeholder = [
                    ['title' => 'Global Steel Market Updates and Industry Insights', 'image' => get_template_directory_uri() . '/imgs/service-item1.jpg'],
                    ['title' => 'Latest Trends Shaping the Global Steel Market', 'image' => get_template_directory_uri() . '/imgs/application.jpg'],
                    ['title' => 'Steel Market Outlook and Emerging Industry Trends', 'image' => get_template_directory_uri() . '/imgs/video-thumb.jpg'],
                    ['title' => 'Key Developments Across the Global Steel Industry', 'image' => get_template_directory_uri() . '/imgs/cta.jpg'],
                ];
            }

            $sub_articles = [];
            foreach ($s_placeholder as $s_idx => $s_item) {
                $sub_articles[] = [
                    'id'        => $cat->term_id . '-' . ($s_idx + 1),
                    'title'     => $s_item['title'],
                    'link'      => get_category_link($cat->term_id),
                    'image_url' => $s_item['image'],
                    'alt'       => $s_item['title'],
                ];
            }

            $insight_sections[] = array(
                'tag'              => mb_strtoupper($cat->name, 'UTF-8'),
                'slug'             => $cat->slug,
                'view_all_text'    => $default_view_all,
                'view_all_link'    => get_category_link($cat->term_id),
                'featured_id'      => $cat->term_id . '-feat',
                'featured_title'   => $f_placeholder_title,
                'featured_excerpt' => $f_placeholder_excerpt,
                'featured_link'    => get_category_link($cat->term_id),
                'featured_image'   => get_template_directory_uri() . '/imgs/product.jpg',
                'sub_articles'     => $sub_articles,
            );
        }
        wp_reset_postdata();
    }
}

// Fallback to TypeRocket / Mock data if no categories exist
if (empty($insight_sections)) {
    $fallback_categories = tr_posts_field($current_lang === 'vi' ? 'insight_categories_vi' : 'insight_categories');
    if (!is_array($fallback_categories) || empty($fallback_categories)) {
        if ($current_lang === 'vi') {
            $fallback_categories = [
                [
                    'tag' => 'TIN TỨC THỊ TRƯỜNG',
                    'slug' => 'thi-truong',
                    'view_all_text' => 'XEM TẤT CẢ',
                    'view_all_link' => '#',
                    'featured_title' => 'Cập nhật diễn biến giá thép và xu hướng thị trường kim loại quý',
                    'featured_excerpt' => 'Tổng hợp các biến động cung cầu, chính sách xuất nhập khẩu và phân tích triển vọng ngành thép công nghiệp tại Việt Nam và khu vực.',
                    'featured_image' => '',
                    'default_featured_image' => get_template_directory_uri() . '/imgs/product.jpg',
                    'featured_link' => '#',
                    'sub_articles' => [
                        ['title' => 'Cập nhật tình hình thị trường thép toàn cầu và nhận định chuyên gia', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/service-item1.jpg', 'alt' => 'Thị trường thép'],
                        ['title' => 'Các xu hướng mới định hình ngành công nghiệp chế tạo kim loại', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/application.jpg', 'alt' => 'Xu hướng ngành'],
                        ['title' => 'Dự báo triển vọng giá thép tấm và thép cuộn trong quý tới', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/video-thumb.jpg', 'alt' => 'Triển vọng giá'],
                        ['title' => 'Phát triển thép xanh và các tiêu chuẩn bền vững mới trong xây dựng', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/cta.jpg', 'alt' => 'Thép xanh']
                    ]
                ],
                [
                    'tag' => 'HOẠT ĐỘNG DOANH NGHIỆP',
                    'slug' => 'hoat-dong-doanh-nghiep',
                    'view_all_text' => 'XEM TẤT CẢ',
                    'view_all_link' => '#',
                    'featured_title' => 'Double T nâng cấp công nghệ dây chuyền gia công thép hiện đại',
                    'featured_excerpt' => 'Tiếp tục đầu tư máy móc tự động hóa và nâng cao năng lực gia công nhằm đáp ứng các tiêu chuẩn khắt khe nhất của khách hàng công nghiệp.',
                    'featured_image' => '',
                    'default_featured_image' => get_template_directory_uri() . '/imgs/hero-img.jpg',
                    'featured_link' => '#',
                    'sub_articles' => [
                        ['title' => 'Nâng cao hiệu suất vận hành toàn diện tại nhà máy Double T', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/service-item1.jpg', 'alt' => 'Vận hành nhà máy'],
                        ['title' => 'Ứng dụng công nghệ mới trong kiểm soát chất lượng thép thành phẩm', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/application.jpg', 'alt' => 'Kiểm soát chất lượng'],
                        ['title' => 'Mở rộng quy mô nhà xưởng và trung tâm dịch vụ khách hàng', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/video-thumb.jpg', 'alt' => 'Mở rộng quy mô'],
                        ['title' => 'Chương trình đào tạo kỹ thuật viên và nâng cao an toàn lao động', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/home-service.webp', 'alt' => 'Đào tạo kỹ thuật']
                    ]
                ]
            ];
        } else {
            $fallback_categories = [
                [
                    'tag' => 'MARKET NEWS',
                    'slug' => 'market-news',
                    'view_all_text' => 'VIEW ALL',
                    'view_all_link' => '#',
                    'featured_title' => 'Lorem ipsum dolor sit amet consectetur. Nisl lobortis porta pharetra aliquam at.',
                    'featured_excerpt' => 'Lorem ipsum dolor sit amet consectetur. Sit nam amet tellus gravida risus tellus. Interdum duis sollicitudin arcu dignissim. Dolor dis mattis sed quam sagittis massa pulvinar volutpat enim.',
                    'featured_image' => '',
                    'default_featured_image' => get_template_directory_uri() . '/imgs/product.jpg',
                    'featured_link' => '#',
                    'sub_articles' => [
                        ['title' => 'Global Steel Market Updates and Industry Insights', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/service-item1.jpg', 'alt' => 'Modern automated steel manufacturing facility'],
                        ['title' => 'Latest Trends Shaping the Global Steel Market', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/application.jpg', 'alt' => 'High quality finished steel coils'],
                        ['title' => 'Steel Market Outlook and Emerging Industry Trends', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/video-thumb.jpg', 'alt' => 'Industrial structural steel beams and trusses'],
                        ['title' => 'Key Developments Across the Global Steel Industry', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/cta.jpg', 'alt' => 'Infrastructure development and steel application']
                    ]
                ],
                [
                    'tag' => 'COMPANY OPERATIONS',
                    'slug' => 'company-operations',
                    'view_all_text' => 'VIEW ALL',
                    'view_all_link' => '#',
                    'featured_title' => 'Lorem ipsum dolor sit amet consectetur. Nisl lobortis porta pharetra aliquam at.',
                    'featured_excerpt' => 'Lorem ipsum dolor sit amet consectetur. Sit nam amet tellus gravida risus tellus. Interdum duis sollicitudin arcu dignissim. Dolor dis mattis sed quam sagittis massa pulvinar volutpat enim.',
                    'featured_image' => '',
                    'default_featured_image' => get_template_directory_uri() . '/imgs/product.jpg',
                    'featured_link' => '#',
                    'sub_articles' => [
                        ['title' => 'Global Steel Market Updates and Industry Insights', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/service-item1.jpg', 'alt' => 'Factory operations'],
                        ['title' => 'Advancing Production with Modern Technology', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/application.jpg', 'alt' => 'Modern Technology'],
                        ['title' => 'Quality Control Innovations at Double T Facilities', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/video-thumb.jpg', 'alt' => 'Quality Control'],
                        ['title' => 'Expanding Logistics and Distribution Capabilities', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/cta.jpg', 'alt' => 'Logistics']
                    ]
                ]
            ];
        }
    }

    foreach ($fallback_categories as $f_idx => $f_cat) {
        $f_img_url = '';
        if (!empty($f_cat['featured_image'])) {
            $f_img_url = wp_get_attachment_image_url($f_cat['featured_image'], 'full');
        }
        if (!$f_img_url && !empty($f_cat['default_featured_image'])) {
            $f_img_url = $f_cat['default_featured_image'];
        }
        if (!$f_img_url) {
            $f_img_url = get_template_directory_uri() . '/imgs/product.jpg';
        }

        $f_sub_items = array();
        if (!empty($f_cat['sub_articles']) && is_array($f_cat['sub_articles'])) {
            foreach ($f_cat['sub_articles'] as $s_idx => $s_item) {
                $s_img = '';
                if (!empty($s_item['image'])) {
                    $s_img = wp_get_attachment_image_url($s_item['image'], 'full');
                }
                if (!$s_img && !empty($s_item['default_image'])) {
                    $s_img = $s_item['default_image'];
                }
                if (!$s_img) {
                    $s_img = get_template_directory_uri() . '/imgs/service-item1.jpg';
                }
                $f_sub_items[] = array(
                    'id'        => ($f_idx + 1) . '-' . ($s_idx + 1),
                    'title'     => !empty($s_item['title']) ? $s_item['title'] : '',
                    'link'      => !empty($s_item['link']) ? $s_item['link'] : '#',
                    'image_url' => $s_img,
                    'alt'       => !empty($s_item['alt']) ? $s_item['alt'] : (!empty($s_item['title']) ? $s_item['title'] : ''),
                );
            }
        }

        $insight_sections[] = array(
            'tag'              => !empty($f_cat['tag']) ? $f_cat['tag'] : 'CATEGORY ' . ($f_idx + 1),
            'slug'             => !empty($f_cat['slug']) ? $f_cat['slug'] : 'category-' . ($f_idx + 1),
            'view_all_text'    => !empty($f_cat['view_all_text']) ? $f_cat['view_all_text'] : 'VIEW ALL',
            'view_all_link'    => !empty($f_cat['view_all_link']) ? $f_cat['view_all_link'] : '#',
            'featured_id'      => ($f_idx + 1) . '-feat',
            'featured_title'   => !empty($f_cat['featured_title']) ? $f_cat['featured_title'] : '',
            'featured_excerpt' => !empty($f_cat['featured_excerpt']) ? $f_cat['featured_excerpt'] : '',
            'featured_link'    => !empty($f_cat['featured_link']) ? $f_cat['featured_link'] : '#',
            'featured_image'   => $f_img_url,
            'sub_articles'     => $f_sub_items,
        );
    }
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
            foreach ($insight_sections as $sec): 
                $cat_idx++;
                $c_tag = !empty($sec['tag']) ? $sec['tag'] : 'CATEGORY ' . $cat_idx;
                $c_slug = !empty($sec['slug']) ? $sec['slug'] : 'category-' . $cat_idx;
                $c_va_text = !empty($sec['view_all_text']) ? $sec['view_all_text'] : 'VIEW ALL';
                $c_va_link = !empty($sec['view_all_link']) ? $sec['view_all_link'] : '#';

                // Featured Post
                $f_id = !empty($sec['featured_id']) ? $sec['featured_id'] : ($cat_idx . '-feat');
                $f_title = !empty($sec['featured_title']) ? $sec['featured_title'] : '';
                $f_excerpt = !empty($sec['featured_excerpt']) ? $sec['featured_excerpt'] : '';
                $f_link = !empty($sec['featured_link']) ? $sec['featured_link'] : '#';
                $f_img_url = !empty($sec['featured_image']) ? $sec['featured_image'] : (get_template_directory_uri() . '/imgs/product.jpg');

                $sub_articles = !empty($sec['sub_articles']) && is_array($sec['sub_articles']) ? $sec['sub_articles'] : [];
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
                            <article class="insight-featured-item" data-post-id="<?php echo esc_attr($f_id); ?>">
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
                            <?php if (!empty($sub_articles)): ?>
                                <div class="insight-subgrid">
                                    <?php 
                                    $sub_idx = 0;
                                    foreach ($sub_articles as $sub): 
                                        $sub_idx++;
                                        $s_id = !empty($sub['id']) ? $sub['id'] : ($cat_idx . '-' . $sub_idx);
                                        $s_title = !empty($sub['title']) ? $sub['title'] : '';
                                        $s_link = !empty($sub['link']) ? $sub['link'] : '#';
                                        $s_alt = !empty($sub['alt']) ? $sub['alt'] : $s_title;
                                        $s_img_url = !empty($sub['image_url']) ? $sub['image_url'] : (get_template_directory_uri() . '/imgs/service-item1.jpg');
                                    ?>
                                        <article class="insight-grid-item" data-post-id="<?php echo esc_attr($s_id); ?>">
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
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>

    </main>
    
<?php get_footer(); ?>