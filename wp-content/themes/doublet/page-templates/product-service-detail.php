<?php
/**
 * Template Name: Product Service Detail
 */
get_header();

// 1. Hero Section Fields
$psd_hero_img_id = tr_posts_field('psd_hero_img');
$psd_hero_img_url = $psd_hero_img_id ? wp_get_attachment_image_url($psd_hero_img_id, 'full') : get_template_directory_uri() . '/imgs/hero-img.jpg';
$psd_hero_breadcrumb = tr_posts_field('psd_hero_breadcrumb') ?: 'Hot Rrolled - HR/ Hot Rolled Pickled and oiled - hrpo';
$psd_hero_title = tr_posts_field('psd_hero_title') ?: 'HOT ROLLED - HR/ HOT ROLLED<br>PICKLED AND OILED - HRPO';

// 2. Specification Fields
$psd_spec_label = tr_posts_field('psd_spec_label') ?: 'SPECIFICATION';
$psd_spec_items = tr_posts_field('psd_spec_items');
if (!is_array($psd_spec_items) || empty($psd_spec_items)) {
    $psd_spec_items = [
        [
            'title' => 'JIS G3131 SPHC/D/E/F',
            'desc' => '<strong class="txt-bold">Đặc điểm chi tiết:</strong> Thuộc tiêu chuẩn JIS dành cho các sản phẩm thép cán nóng dạng cuộn tẩy gỉ (P/O). Phân loại sản phẩm trải dài từ chất lượng thương mại thông thường đến chất lượng dập sâu (deep drawing quality). Thép có độ dẻo và khả năng biến dạng tuyệt vời, chủ yếu tập trung phục vụ cho các ứng dụng đòi hỏi khả năng định hình và tạo hình phức tạp.'
        ],
        [
            'title' => 'JIS G3101 SS330~540, ASTM A1011/1018 SS GRADE 30~80',
            'desc' => '<strong class="txt-bold">Đặc điểm chi tiết:</strong> Dòng thép cuộn P/O chuyên dụng cho các kết cấu kỹ thuật chung. Có giới hạn bền kéo tối thiểu dao động từ 330 đến 620 N/mm2, đáp ứng tiêu chuẩn chịu lực vững chắc cho các công trình xây dựng, khung nhà xưởng, kết cấu cầu đường và các linh kiện chịu tải trọng khác.'
        ],
        [
            'title' => 'JIS G3113 SAPH310/370/400/440',
            'desc' => '<strong class="txt-bold">Đặc điểm chi tiết:</strong> Các mác thép SAPH 310~440 được nghiên cứu và thiết kế chuyên biệt cho ngành công nghiệp chế tạo ô tô. Với giới hạn bền kéo từ 310 đến 440 N/mm2, sản phẩm đảm bảo tính an toàn kỹ thuật, độ bền cơ học cao cho các kết cấu khung gầm, thân xe và các chi tiết chịu lực của phương tiện.'
        ],
        [
            'title' => 'ASTM A1011/1018 HSLA GRADE 60~80',
            'desc' => '<strong class="txt-bold">Đặc điểm chi tiết:</strong> Thép cuộn P/O hợp kim thấp cường độ cao (High-Strength Low-Alloy), được tối ưu hóa đặc biệt cho các ứng dụng kết cấu chịu tải trọng nặng như các thanh dầm định hình (sections) và các tấm gia cường, chống uốn (stiffening plates).'
        ],
        [
            'title' => 'JIS G3134 SPFH490/540 (Y), JSH540Y~590Y',
            'desc' => '<strong class="txt-bold">Đặc điểm chi tiết:</strong> Dòng thép cuộn P/O có cường độ siêu cao kết hợp khả năng giãn dài vượt trội. Loại vật liệu này đóng vai trò trọng yếu trong việc chế tạo các thanh gia cường cấu trúc ô tô, giúp tăng cường độ cứng vững đồng thời giảm thiểu trọng lượng tổng thể cho xe nhằm tiết kiệm nhiên liệu.'
        ],
        [
            'title' => 'EN10149-2 S315MC~S500MC',
            'desc' => '<strong class="txt-bold">Đặc điểm chi tiết:</strong> Thép cuộn P/O có giới hạn chảy cao nằm trong khoảng từ 315 đến 500 N/mm2. Sản phẩm rất phù hợp cho công nghệ gia công nguội (cold forming) và các chi tiết kỹ thuật đòi hỏi giới hạn chảy cao trong ngành chế tạo máy móc, thiết bị công nghiệp.'
        ]
    ];
}

$psd_spec_visual_img_id = tr_posts_field('psd_spec_visual_img');
$psd_spec_visual_img_url = $psd_spec_visual_img_id ? wp_get_attachment_image_url($psd_spec_visual_img_id, 'full') : get_template_directory_uri() . '/imgs/product-detail.webp';

$psd_spec_card_rows = tr_posts_field('psd_spec_card_rows');
if (!is_array($psd_spec_card_rows) || empty($psd_spec_card_rows)) {
    $psd_spec_card_rows = [
        ['label' => 'Thickness:', 'value' => '1.40 - 6.50mm'],
        ['label' => 'Edge width:', 'value' => '700 - 1600mm'],
        ['label' => 'Inner diameter:', 'value' => '610mm']
    ];
}

// 3. Application Examples Fields
$psd_app_label = tr_posts_field('psd_app_label') ?: 'APPLICATION EXAMPLES';
$psd_app_desc = tr_posts_field('psd_app_desc') ?: 'Thanks to its superior mechanical properties, the product is trusted across various manufacturing industries:';
$psd_app_items = tr_posts_field('psd_app_items');
if (!is_array($psd_app_items) || empty($psd_app_items)) {
    $psd_app_items = [
        ['title' => 'Manufacturing vehicle wheel rims', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/application.jpg'],
        ['title' => 'Manufacturing of drive sprockets and chainwheels', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/cta.jpg'],
        ['title' => 'Manufacturing bicycle components and parts', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/product.jpg'],
        ['title' => 'Pressure vessel fabrication', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/home-service.webp'],
        ['title' => 'Manufacturing of hand tools, wrenches, and adjustable wrenches.', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/service-item1.jpg'],
        ['title' => 'Manufacturing lifting equipment and hydraulic jacks', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/commit-intro.jpg']
    ];
}

// 4. Other Products Fields
$psd_other_label = tr_posts_field('psd_other_label') ?: 'OTHER PRODUCTS';

// Lấy tối đa 6 sản phẩm khác mới nhất từ Post Type 'product-and-service'
$current_id = get_the_ID();
$other_posts = get_posts([
    'post_type'      => ['product-and-service', 'productandservice'],
    'post_status'    => 'publish',
    'posts_per_page' => 6,
    'post__not_in'   => [$current_id],
    'orderby'        => 'date',
    'order'          => 'DESC'
]);

$psd_other_items = [];

if (!empty($other_posts)) {
    foreach ($other_posts as $o_post) {
        $o_id = $o_post->ID;

        // Ảnh theo psd_hero_img (TypeRocket) -> Featured Image -> ACF -> Fallback
        $o_img_id = tr_posts_field('psd_hero_img', $o_id);
        $o_img_url = '';
        if (!empty($o_img_id)) {
            $o_img_url = wp_get_attachment_image_url($o_img_id, 'full');
        }
        if (empty($o_img_url)) {
            $o_img_url = get_the_post_thumbnail_url($o_id, 'full');
        }
        if (empty($o_img_url) && function_exists('get_field')) {
            $acf_img = get_field('psd_hero_img', $o_id) ?: get_field('image', $o_id);
            if (!empty($acf_img)) {
                $o_img_url = is_array($acf_img) ? $acf_img['url'] : (is_numeric($acf_img) ? wp_get_attachment_image_url($acf_img, 'full') : $acf_img);
            }
        }
        if (empty($o_img_url)) {
            $o_img_url = get_template_directory_uri() . '/imgs/hero-img.jpg';
        }

        $psd_other_items[] = [
            'title'         => get_the_title($o_id),
            'link'          => get_permalink($o_id),
            'image'         => $o_img_id,
            'image_url'     => $o_img_url,
            'default_image' => get_template_directory_uri() . '/imgs/hero-img.jpg'
        ];
    }
}

// Fallback nếu chưa có bài đăng nào khác trong Post Type
if (empty($psd_other_items)) {
    $tr_other = tr_posts_field('psd_other_items');
    if (is_array($tr_other) && !empty($tr_other)) {
        $psd_other_items = $tr_other;
    } else {
        $psd_other_items = [
            ['title' => 'Cold-Rolled', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/cta.jpg'],
            ['title' => 'Hot-Dip Galvanized', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/service-item1.jpg'],
            ['title' => 'Electrical Steel-Es', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/home-service.webp'],
            ['title' => 'Electrical Galvanized Steel-Eg', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/product.jpg'],
            ['title' => 'Stainless Steel-Inox', 'link' => '#', 'image' => '', 'default_image' => get_template_directory_uri() . '/imgs/hero-img.jpg']
        ];
    }
}

?>

    <main class="main">
        <!-- 1. Hero Section -->
        <section class="psd-hero" aria-labelledby="psdHeroTitle">
            <div class="psd-hero-inner">
                <div class="psd-hero-panel hero-enter-item hero-enter-panel">
                    <div class="container psd-hero-container">
                        <nav class="psd-breadcrumb txt txt-14 txt-14_tb txt-14_mb" aria-label="Breadcrumb">
                            <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                            <span class="psd-breadcrumb-devi" aria-hidden="true">/</span>
                            <a class="middle" href="<?php echo esc_url(home_url('/product-service')); ?>">Product &amp; Service</a>
                            <a class="mobile" href="<?php echo esc_url(home_url('/product-service')); ?>">...</a>
                            <span class="psd-breadcrumb-devi" aria-hidden="true">/</span>
                            <span class="current"><?php echo esc_html($psd_hero_breadcrumb); ?></span>
                        </nav>
                        <h1 class="heading h2 h2_tb h3_mb psd-hero-title" id="psdHeroTitle">
                            <?php echo wp_kses_post($psd_hero_title); ?>
                        </h1>
                    </div>
                </div>
                <div class="psd-hero-media hero-enter-item">
                    <img src="<?php echo esc_url($psd_hero_img_url); ?>" class="img-fill" alt="<?php echo esc_attr(strip_tags($psd_hero_title)); ?>" loading="eager" fetchpriority="high" decoding="async">
                </div>
            </div>
        </section>

        <!-- 2. Specification Section -->
        <section class="psd-spec page-first-section-reveal reveal-ready" id="specification" aria-labelledby="psdSpecLabel">
            <div class="container">
                <div class="psd-section-head">
                    <div class="psd-section-tag cut-tl" id="psdSpecLabel">
                        <span class="txt txt-16 txt-14_tb txt-semi"><?php echo esc_html($psd_spec_label); ?></span>
                    </div>
                </div>

                <div class="psd-spec-layout">
                    <!-- Left Column: Detailed Specifications List -->
                    <div class="psd-spec-content">
                        <div class="psd-spec-watermark" aria-hidden="true">
                            <img src="<?php echo get_template_directory_uri(); ?>/imgs/logo_marker.png" alt="">
                        </div>

                        <div class="psd-spec-list">
                            <?php foreach ($psd_spec_items as $spec): 
                                $s_title = !empty($spec['title']) ? $spec['title'] : '';
                                $s_desc = !empty($spec['desc']) ? $spec['desc'] : '';
                            ?>
                                <article class="psd-spec-item">
                                    <h3 class="heading h6 psd-spec-name txt-16_mb"><?php echo esc_html($s_title); ?></h3>
                                    <p class="txt txt-14 txt-14_tb txt-14_mb psd-spec-desc">
                                        <?php echo wp_kses_post($s_desc); ?>
                                    </p>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Right Column: Visual Frame & Overlaid Specs Card -->
                    <div class="psd-spec-visual">
                        <div class="psd-spec-frame-wrap">
                            <div class="psd-spec-frame">
                                <img src="<?php echo esc_url($psd_spec_visual_img_url); ?>" class="img-fill" alt="Technician operating control panel">
                            </div>

                            <!-- Overlaid Specs Floating Card -->
                            <div class="psd-spec-card-wrap">
                                <div class="psd-spec-card cut-diagonal">
                                    <?php foreach ($psd_spec_card_rows as $row): 
                                        $r_label = !empty($row['label']) ? $row['label'] : '';
                                        $r_value = !empty($row['value']) ? $row['value'] : '';
                                    ?>
                                        <div class="psd-spec-card-row">
                                            <span class="txt txt-16 txt-10_mb txt-14_tb txt-med psd-spec-card-label"><?php echo esc_html($r_label); ?></span>
                                            <span class="txt txt-16 txt-10_mb txt-14_tb txt-bold psd-spec-card-value"><?php echo esc_html($r_value); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Application Examples Section -->
        <section class="psd-app" id="applications" aria-labelledby="psdAppLabel">
            <div class="container">
                <div class="psd-section-head">
                    <div class="psd-section-tag cut-tl" id="psdAppLabel">
                        <span class="txt txt-16 txt-14_tb txt-semi"><?php echo esc_html($psd_app_label); ?></span>
                    </div>
                </div>

                <p class="txt txt-16 txt-14_tb txt-14_mb psd-app-desc">
                    <?php echo wp_kses_post(nl2br($psd_app_desc)); ?>
                </p>

                <div class="psd-app-grid">
                    <?php foreach ($psd_app_items as $app): 
                        $a_title = !empty($app['title']) ? $app['title'] : '';
                        $a_img_url = '';
                        if (!empty($app['image'])) {
                            $a_img_url = wp_get_attachment_image_url($app['image'], 'full');
                        }
                        if (!$a_img_url && !empty($app['default_image'])) {
                            $a_img_url = $app['default_image'];
                        }
                        if (!$a_img_url) {
                            $a_img_url = get_template_directory_uri() . '/imgs/application.jpg';
                        }
                    ?>
                        <article class="psd-app-card hover-img cut-tl">
                            <div class="psd-app-card-media">
                                <img src="<?php echo esc_url($a_img_url); ?>" class="img-fill" alt="<?php echo esc_attr($a_title); ?>">
                                <div class="psd-app-card-overlay"></div>
                            </div>
                            <div class="psd-app-card-content">
                                <h3 class="txt txt-16 txt-14_tb txt-14_mb txt-semi psd-app-card-title">
                                    <?php echo esc_html($a_title); ?>
                                </h3>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- 4. Other Products Section (Swiper Carousel) -->
        <section class="psd-other" id="otherProducts" aria-labelledby="psdOtherLabel">
            <div class="container">
                <div class="psd-section-head">
                    <div class="psd-section-tag cut-tl" id="psdOtherLabel">
                        <span class="txt txt-16 txt-14_tb txt-semi"><?php echo esc_html($psd_other_label); ?></span>
                    </div>
                </div>

                <div class="psd-other-slider-wrap">
                    <div class="swiper psd-other-slider" id="psdOtherSlider">
                        <div class="swiper-wrapper">
                            <?php foreach ($psd_other_items as $other): 
                                $o_title = !empty($other['title']) ? $other['title'] : '';
                                $o_link = !empty($other['link']) ? $other['link'] : '#';
                                $o_img_url = !empty($other['image_url']) ? $other['image_url'] : '';
                                if (!$o_img_url && !empty($other['image'])) {
                                    $o_img_url = wp_get_attachment_image_url($other['image'], 'full');
                                }
                                if (!$o_img_url && !empty($other['default_image'])) {
                                    $o_img_url = $other['default_image'];
                                }
                                if (!$o_img_url) {
                                    $o_img_url = get_template_directory_uri() . '/imgs/product.jpg';
                                }
                            ?>
                                <div class="swiper-slide">
                                    <a href="<?php echo esc_url($o_link); ?>" class="ps-product-card hover-img">
                                        <div class="ps-product-card-img cut-tl">
                                            <div class="ps-product-card-img-block"></div>
                                            <img src="<?php echo esc_url($o_img_url); ?>" class="img-abs img-fill" alt="<?php echo esc_attr($o_title); ?>">
                                        </div>
                                        <div class="ps-product-card-content">
                                            <div class="ps-product-card-title">
                                                <div class="heading h5 h6_tb"><?php echo esc_html($o_title); ?></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Slider Arrow Controls -->
                    <button class="psd-other-nav psd-other-prev cut-diagonal cut-sm" id="psdOtherPrev"
                        aria-label="Previous products">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M7.5 2.5L4 6L7.5 9.5" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <button class="psd-other-nav psd-other-next cut-diagonal cut-sm" id="psdOtherNext"
                        aria-label="Next products">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M4.5 2.5L8 6L4.5 9.5" stroke="currentColor" stroke-width="1.8"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                    <!-- Pagination Dots -->
                    <div class="swiper-pagination psd-other-pagination" id="psdOtherPagination"></div>
                </div>
            </div>
        </section>

        <!-- 5. Consultation CTA Banner -->
        <?php render_consultation_cta(); ?>
    </main>

<?php get_footer(); ?>
