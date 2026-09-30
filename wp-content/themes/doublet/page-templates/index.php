<?php
/**
 * Template Name: Home page
 */
get_header();

// 1. Hero Section Fields
$home_hero_bg_id = tr_posts_field('home_hero_bg');
$home_hero_bg_url = $home_hero_bg_id ? wp_get_attachment_image_url($home_hero_bg_id, 'full') : get_template_directory_uri() . '/imgs/hero-img.jpg';
$home_hero_scroll_text = tr_posts_field('home_hero_scroll_text') ?: 'Scroll Down';

// 2. Future Section Fields
$home_future_label = tr_posts_field('home_future_label') ?: 'BUILDING TOMORROW';
$home_future_title = tr_posts_field('home_future_title') ?: 'Embrace the future with <span class="txt-primary">Double</span> <span class="txt-secodary">T</span>';
$home_future_desc = tr_posts_field('home_future_desc') ?: 'In the era of industrialization, modernization, and global integration, the supporting industries and mechanical manufacturing sector are undergoing profound transformations.';
$home_future_btn_text = tr_posts_field('home_future_btn_text') ?: 'READMORE';
$home_future_btn_link = tr_posts_field('home_future_btn_link') ?: '';
$home_future_logo_id = tr_posts_field('home_future_logo');
$home_future_logo_url = $home_future_logo_id ? wp_get_attachment_image_url($home_future_logo_id, 'full') : get_template_directory_uri() . '/imgs/logo_future.png';

// 3. Video Section Fields
$home_video_thumb_id = tr_posts_field('home_video_thumb');
$home_video_thumb_url = $home_video_thumb_id ? wp_get_attachment_image_url($home_video_thumb_id, 'full') : get_template_directory_uri() . '/imgs/video-thumb.jpg';
$home_video_file = tr_posts_field('home_video_file');
$home_video_file_url = $home_video_file ? wp_get_attachment_url($home_video_file) : '';
$home_video_url = tr_posts_field('home_video_url');
$final_video_src = $home_video_file_url ?: ($home_video_url ?: '');
$home_video_youtube_url = trim((string) tr_posts_field('home_video_youtube_url'));
$home_video_fallback_url = 'https://www.youtube.com/watch?v=M7lc1UVf-VE';
$home_video_play_url = $home_video_youtube_url ?: ($final_video_src ?: $home_video_fallback_url);

// 4. Product Section Fields
$home_product_label = tr_posts_field('home_product_label') ?: 'PRODUCT DOUBLE T';
$home_product_title = tr_posts_field('home_product_title') ?: 'Professional steel supplier and processor.';
$home_product_btn_text = tr_posts_field('home_product_btn_text') ?: 'VIEW ALL PRODUCTS';
$home_product_btn_link = tr_posts_field('home_product_btn_link') ?: '';
$home_product_items = tr_posts_field('home_product_items');
if (!is_array($home_product_items) || empty($home_product_items)) {
    $home_product_items = [];
    for ($p = 0; $p < 8; $p++) {
        $home_product_items[] = [
            'title' => 'Hot Rolled-HR / Hot Rolled Pickled and Oiled-HRPO',
            'image' => '',
            'link'  => '#'
        ];
    }
}

// 5. Service Section Fields
$home_service_top_img_id = tr_posts_field('home_service_top_img');
$home_service_top_img_url = $home_service_top_img_id ? wp_get_attachment_image_url($home_service_top_img_id, 'full') : get_template_directory_uri() . '/imgs/home-service.webp';
$home_service_label = tr_posts_field('home_service_label') ?: 'BUILDING TOMORROW';
$home_service_title = tr_posts_field('home_service_title') ?: 'Manufacturing Capabilities of <br><span class="txt-primary">2T Metal Co., Ltd.</span>';
$home_service_desc = tr_posts_field('home_service_desc') ?: 'The facility features a comprehensive, well-planned investment in machinery and state-of-the-art production lines imported directly from Japan and Taiwan, located at the Hai Son Industrial Cluster in Duc Hoa District, Long An Province.';
$home_service_btn_text = tr_posts_field('home_service_btn_text') ?: 'VIEW ALL SERVICES';
$home_service_btn_link = tr_posts_field('home_service_btn_link') ?: '';
$home_service_slides = tr_posts_field('home_service_slides');
if (!is_array($home_service_slides) || empty($home_service_slides)) {
    $home_service_slides = [
        [
            'num' => '01',
            'tag' => 'SERVICES',
            'title' => 'Slitting Line',
            'types_label' => 'Chủng loại thép gia công:',
            'types_text' => 'Đa dạng các loại thép cán nóng (HR), thép tẩy gỉ (PO), thép cán nguội (CR), thép mạ kẽm (GI), mạ hợp kim nhôm kẽm (GL), mạ màu (PPGL), mạ điện (EG), Silic (ES), và thép không gỉ (SUS).',
            'specs_label' => 'Thông số kỹ thuật:',
            'specs_text' => "Độ dày: Từ 0.25 đến 4.00 mm.\nKhổ rộng băng con tối thiểu: 20 mm.\nKhổ rộng cuộn mẹ tối đa: 1,650 mm.\nTrọng lượng cuộn mẹ tối đa: Lên đến 25,000 kg.",
            'tech_label' => 'Điểm nhấn công nghệ:',
            'tech_text' => 'Dây chuyền được tích hợp bộ phận đặc biệt (RB21), có khả năng chống trầy xước tuyệt đối khi cắt xẻ các bề mặt nhạy cảm như thép mạ kẽm, mạ điện và thép mạ màu.',
            'btn_text' => 'SERVICE CONSULTATION',
            'btn_link' => '#',
            'image' => '',
            'default_img' => get_template_directory_uri() . '/imgs/service-item1.jpg',
        ],
        [
            'num' => '02',
            'tag' => 'SERVICES',
            'title' => 'Cut-to-Length Line',
            'types_label' => 'Chủng loại thép gia công:',
            'types_text' => 'Thép cán nóng (HR), thép tẩy gỉ (PO), thép cán nguội (CR), thép mạ kẽm (GI), mạ hợp kim nhôm kẽm (GL), mạ màu (PPGL).',
            'specs_label' => 'Thông số kỹ thuật:',
            'specs_text' => "Độ dày: Từ 0.30 đến 6.00 mm.\nChiều dài cắt tối đa: Lên đến 6,000 mm.\nKhổ rộng tối đa: 1,650 mm.\nĐộ chính xác dung sai: ± 0.5 mm.",
            'tech_label' => 'Điểm nhấn công nghệ:',
            'tech_text' => 'Hệ thống nắn phẳng tự động đa trục độ chính xác cao, đảm bảo bề mặt tấm thép sau cắt đạt độ phẳng tuyệt đối không cong vênh.',
            'btn_text' => 'SERVICE CONSULTATION',
            'btn_link' => '#',
            'image' => '',
            'default_img' => get_template_directory_uri() . '/imgs/home-service.webp',
        ]
    ];
}

// 6. Applications Section Fields
$home_app_label = tr_posts_field('home_app_label') ?: '2T STEEL APPLICATIONS';
$home_app_title = tr_posts_field('home_app_title') ?: 'Practical Production';
$home_app_items = tr_posts_field('home_app_items');
if (!is_array($home_app_items) || empty($home_app_items)) {
    $home_app_items = [
        [
            'tab_title' => 'FACTORY & INDUSTRIAL',
            'panel_title' => 'FACTORY INDUSTRIAL',
            'panel_desc' => '2T steel is a suitable solution for projects requiring robust structural integrity, high load-bearing capacity, and rapid construction progress.',
            'image' => '',
            'btn_text' => 'EXPLORE SERVICES',
            'btn_link' => '#',
            'feat1_title' => 'FLEXIBLE APERTURE',
            'feat1_desc' => 'Suitable for various factory scales.',
            'feat2_title' => 'HIGH LOAD CAPACITY',
            'feat2_desc' => 'Suitable for industrial environments.',
            'feat3_title' => 'QUICK INSTALLATION',
            'feat3_desc' => 'Optimize construction time.'
        ],
        [
            'tab_title' => 'CIVIL WORKS',
            'panel_title' => 'CIVIL WORKS',
            'panel_desc' => '2T steel is a suitable solution for projects requiring robust structural integrity, high load-bearing capacity, and rapid construction progress.',
            'image' => '',
            'btn_text' => 'EXPLORE SERVICES',
            'btn_link' => '#',
            'feat1_title' => 'FLEXIBLE APERTURE',
            'feat1_desc' => 'Suitable for various factory scales.',
            'feat2_title' => 'HIGH LOAD CAPACITY',
            'feat2_desc' => 'Suitable for industrial environments.',
            'feat3_title' => 'QUICK INSTALLATION',
            'feat3_desc' => 'Optimize construction time.'
        ],
        [
            'tab_title' => 'STRUCTURAL WORKS',
            'panel_title' => 'STRUCTURAL WORKS',
            'panel_desc' => '2T steel is a suitable solution for projects requiring robust structural integrity, high load-bearing capacity, and rapid construction progress.',
            'image' => '',
            'btn_text' => 'EXPLORE SERVICES',
            'btn_link' => '#',
            'feat1_title' => 'FLEXIBLE APERTURE',
            'feat1_desc' => 'Suitable for various factory scales.',
            'feat2_title' => 'HIGH LOAD CAPACITY',
            'feat2_desc' => 'Suitable for industrial environments.',
            'feat3_title' => 'QUICK INSTALLATION',
            'feat3_desc' => 'Optimize construction time.'
        ],
        [
            'tab_title' => 'INFRASTRUCTURE',
            'panel_title' => 'INFRASTRUCTURE',
            'panel_desc' => '2T steel is a suitable solution for projects requiring robust structural integrity, high load-bearing capacity, and rapid construction progress.',
            'image' => '',
            'btn_text' => 'EXPLORE SERVICES',
            'btn_link' => '#',
            'feat1_title' => 'FLEXIBLE APERTURE',
            'feat1_desc' => 'Suitable for various factory scales.',
            'feat2_title' => 'HIGH LOAD CAPACITY',
            'feat2_desc' => 'Suitable for industrial environments.',
            'feat3_title' => 'QUICK INSTALLATION',
            'feat3_desc' => 'Optimize construction time.'
        ],
        [
            'tab_title' => 'SPECIFIC SOLUTIONS',
            'panel_title' => 'SPECIFIC SOLUTIONS',
            'panel_desc' => '2T steel is a suitable solution for projects requiring robust structural integrity, high load-bearing capacity, and rapid construction progress.',
            'image' => '',
            'btn_text' => 'EXPLORE SERVICES',
            'btn_link' => '#',
            'feat1_title' => 'FLEXIBLE APERTURE',
            'feat1_desc' => 'Suitable for various factory scales.',
            'feat2_title' => 'HIGH LOAD CAPACITY',
            'feat2_desc' => 'Suitable for industrial environments.',
            'feat3_title' => 'QUICK INSTALLATION',
            'feat3_desc' => 'Optimize construction time.'
        ]
    ];
}

// 7. Featured Media Fields by Language & Categories
$current_lang = function_exists('pll_current_language') ? pll_current_language('slug') : 'en';
$current_lang = strtolower($current_lang ?: 'en');

if ($current_lang === 'vi') {
    $home_media_label = tr_posts_field('home_media_label_vi') ?: (tr_posts_field('home_media_label') ?: 'TIN TỨC SỰ KIỆN');
    $home_media_title = tr_posts_field('home_media_title_vi') ?: (tr_posts_field('home_media_title') ?: 'Truyền thông nổi bật');
    $home_view_all_text = 'XEM TẤT CẢ';
} else {
    $home_media_label = tr_posts_field('home_media_label') ?: 'NEWS EVENTS';
    $home_media_title = tr_posts_field('home_media_title') ?: 'Featured Media';
    $home_view_all_text = 'VIEW ALL';
}

// Fetch categories for home media by current language
$home_cat_args = array(
    'taxonomy'   => 'category',
    'orderby'    => 'name',
    'order'      => 'ASC',
    'hide_empty' => false,
);
if (function_exists('pll_current_language')) {
    $home_cat_args['lang'] = $current_lang;
}
$home_categories = get_categories($home_cat_args);

$home_media_blocks = array();

if (!empty($home_categories)) {
    foreach ($home_categories as $h_cat) {
        $cat_posts_args = array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $h_cat->term_id,
                ),
            ),
            'posts_per_page' => 8,
            'orderby'        => 'date',
            'order'          => 'DESC',
        );
        if (function_exists('pll_current_language')) {
            $cat_posts_args['lang'] = $current_lang;
        }

        $c_query = new WP_Query($cat_posts_args);
        $block_items = array();

        if ($c_query->have_posts()) {
            foreach ($c_query->posts as $cp) {
                $cp_thumb = get_the_post_thumbnail_url($cp->ID, 'full');
                $block_items[] = array(
                    'title'       => get_the_title($cp->ID),
                    'link'        => get_permalink($cp->ID),
                    'image'       => '',
                    'default_img' => $cp_thumb ?: (get_template_directory_uri() . '/imgs/product.jpg'),
                );
            }
        } else {
            // Category has no posts yet: localized sample cards
            if ($current_lang === 'vi') {
                $block_items = array(
                    array('title' => 'Cập nhật tình hình thị trường thép toàn cầu và nhận định chuyên gia', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/product.jpg', 'link' => get_category_link($h_cat->term_id)),
                    array('title' => 'Các xu hướng mới định hình ngành công nghiệp chế tạo kim loại', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/service-item1.jpg', 'link' => get_category_link($h_cat->term_id)),
                    array('title' => 'Dự báo triển vọng giá thép tấm và thép cuộn trong quý tới', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/application.jpg', 'link' => get_category_link($h_cat->term_id)),
                    array('title' => 'Phát triển thép xanh và các tiêu chuẩn bền vững mới trong xây dựng', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/video-thumb.jpg', 'link' => get_category_link($h_cat->term_id)),
                    array('title' => 'Đổi mới công nghệ dây chuyền cắt xẻ thép chính xác cao Double T', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/hero-img.jpg', 'link' => get_category_link($h_cat->term_id)),
                    array('title' => 'Tiêu chuẩn kiểm soát chất lượng thép xuất khẩu và phục vụ nội địa', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/home-service.webp', 'link' => get_category_link($h_cat->term_id)),
                );
            } else {
                $block_items = array(
                    array('title' => 'Latest Trends Shaping the Global Steel Market', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/product.jpg', 'link' => get_category_link($h_cat->term_id)),
                    array('title' => 'Global Steel Market Updates and Industry Insights', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/service-item1.jpg', 'link' => get_category_link($h_cat->term_id)),
                    array('title' => 'Steel Market Outlook and Emerging Industry Trends', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/application.jpg', 'link' => get_category_link($h_cat->term_id)),
                    array('title' => 'Key Developments Across the Global Steel Industry', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/video-thumb.jpg', 'link' => get_category_link($h_cat->term_id)),
                    array('title' => 'Sustainable Green Steel Initiatives in Global Construction', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/hero-img.jpg', 'link' => get_category_link($h_cat->term_id)),
                    array('title' => 'Innovations in High-Tensile Steel Material Sourcing', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/home-service.webp', 'link' => get_category_link($h_cat->term_id)),
                );
            }
        }
        wp_reset_postdata();

        $home_media_blocks[] = array(
            'tag'       => mb_strtoupper($h_cat->name, 'UTF-8'),
            'link'      => get_category_link($h_cat->term_id),
            'items'     => $block_items,
            'slider_id' => 'home-cat-' . $h_cat->slug,
        );
    }
}

// Fallback if no categories exist
if (empty($home_media_blocks)) {
    if ($current_lang === 'vi') {
        $home_media_blocks = array(
            array(
                'tag'       => 'TIN TỨC THỊ TRƯỜNG',
                'link'      => '#',
                'slider_id' => 'home-cat-market',
                'items'     => array(
                    array('title' => 'Cập nhật tình hình thị trường thép toàn cầu và nhận định chuyên gia', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/product.jpg', 'link' => '#'),
                    array('title' => 'Các xu hướng mới định hình ngành công nghiệp chế tạo kim loại', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/service-item1.jpg', 'link' => '#'),
                    array('title' => 'Dự báo triển vọng giá thép tấm và thép cuộn trong quý tới', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/application.jpg', 'link' => '#'),
                    array('title' => 'Phát triển thép xanh và các tiêu chuẩn bền vững mới trong xây dựng', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/video-thumb.jpg', 'link' => '#'),
                    array('title' => 'Đổi mới công nghệ dây chuyền cắt xẻ thép chính xác cao Double T', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/hero-img.jpg', 'link' => '#'),
                    array('title' => 'Tiêu chuẩn kiểm soát chất lượng thép xuất khẩu và phục vụ nội địa', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/home-service.webp', 'link' => '#'),
                )
            ),
            array(
                'tag'       => 'HOẠT ĐỘNG DOANH NGHIỆP',
                'link'      => '#',
                'slider_id' => 'home-cat-ops',
                'items'     => array(
                    array('title' => 'Nâng cấp hệ thống máy móc sản xuất và gia công thép tiên tiến', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/hero-img.jpg', 'link' => '#'),
                    array('title' => 'Tăng cường hiệu suất vận hành trên toàn bộ dây chuyền nhà máy', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/application.jpg', 'link' => '#'),
                    array('title' => 'Mở rộng hệ thống kho vận đáp ứng nhu cầu cung ứng kịp thời', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/service-item1.jpg', 'link' => '#'),
                    array('title' => 'Đạt mốc sản lượng gia công thép mới với độ chính xác cao', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/product.jpg', 'link' => '#'),
                    array('title' => 'Tập huấn kỹ năng vận hành công nghệ cán vuốt và xẻ cuộn hiện đại', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/video-thumb.jpg', 'link' => '#'),
                    array('title' => 'Quy trình kiểm tra thử nghiệm cơ lý tính thép nghiêm ngặt', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/home-service.webp', 'link' => '#'),
                )
            )
        );
    } else {
        $home_media_blocks = array(
            array(
                'tag'       => 'MARKET NEWS',
                'link'      => '#',
                'slider_id' => 'home-cat-market',
                'items'     => array(
                    array('title' => 'Latest Trends Shaping the Global Steel Market', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/product.jpg', 'link' => '#'),
                    array('title' => 'Global Steel Market Updates and Industry Insights', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/service-item1.jpg', 'link' => '#'),
                    array('title' => 'Steel Market Outlook and Emerging Industry Trends', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/application.jpg', 'link' => '#'),
                    array('title' => 'Key Developments Across the Global Steel Industry', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/video-thumb.jpg', 'link' => '#'),
                    array('title' => 'Sustainable Green Steel Initiatives in Global Construction', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/hero-img.jpg', 'link' => '#'),
                    array('title' => 'Innovations in High-Tensile Steel Material Sourcing', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/home-service.webp', 'link' => '#'),
                )
            ),
            array(
                'tag'       => 'COMPANY OPERATIONS',
                'link'      => '#',
                'slider_id' => 'home-cat-ops',
                'items'     => array(
                    array('title' => 'Latest Developments in Our Steel Manufacturing Operations', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/hero-img.jpg', 'link' => '#'),
                    array('title' => 'Advancing Our Production with New Steel Technologies', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/application.jpg', 'link' => '#'),
                    array('title' => 'Strengthening Efficiency Across Our Steel Production Lines', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/service-item1.jpg', 'link' => '#'),
                    array('title' => 'New Milestones in Steel Manufacturing and Production', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/product.jpg', 'link' => '#'),
                    array('title' => 'Expansion of Our High-Capacity Cold-Rolling Facilities', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/video-thumb.jpg', 'link' => '#'),
                    array('title' => 'Comprehensive Quality Assurance Testing Protocols', 'image' => '', 'default_img' => get_template_directory_uri() . '/imgs/home-service.webp', 'link' => '#'),
                )
            )
        );
    }
}

// 8. Partners Fields
$home_partners_label = tr_posts_field('home_partners_label') ?: 'PARTNERS';
$home_partners_title = tr_posts_field('home_partners_title') ?: 'Partnering to create<br>sustainable value.';
$home_partners_desc = tr_posts_field('home_partners_desc') ?: 'Partnering with <strong class="txt-primary txt-semi">Double T</strong> is the key to unlocking success, enabling you to confidently embrace new opportunities and challenges in the future of the metal industry.';
$home_partners_logos = tr_posts_field('home_partners_logos');
?>

    <main class="main">
        <!-- 1. Hero Section -->
        <section class="home-hero">
            <div class="container">
                <div class="home-hero-ic-wrap first-load-item">
                    <div class="home-hero-ic">
                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/mouse.svg" class="img-basic" alt="icon mouse">
                    </div>
                    <div class="home-hero-label">
                        <div class="txt txt-13 txt-med"><?php echo esc_html($home_hero_scroll_text); ?></div>
                    </div>
                </div>
            </div>
            <div class="home-hero-bg first-load-item">
                <img src="<?php echo esc_url($home_hero_bg_url); ?>" class="img-fill" alt="home hero image">
            </div>
            <div class="home-hero-overlay first-load-item"></div>
        </section>

        <!-- 2. Future Section -->
        <section class="home-future">
            <div class="container grid">
                <div class="home-future-content">
                    <div class="home-future-title-wrap">
                        <div class="home-future-title label red-light cut-diagonal cut-sm">
                            <div class="txt txt-13 txt-13_mb txt-16_tb txt-semi"><?php echo esc_html($home_future_label); ?></div>
                        </div>
                        <div class="home-future-title">
                            <h1 class="heading h1 h3_mb h2_tb"><?php echo wp_kses_post($home_future_title); ?></h1>
                        </div>
                        <div class="home-future-sub">
                            <div class="txt txt-16 txt-14_mb"><?php echo wp_kses_post(nl2br($home_future_desc)); ?></div>
                        </div>
                        <a href="<?php echo esc_url($home_future_btn_link ?: '#'); ?>" class="btn home-future-btn btn-primary">
                            <div class="txt txt-14 txt-semi"><?php echo esc_html($home_future_btn_text); ?></div>
                        </a>
                    </div>
                </div>
                <div class="home-future-img-wrap">
                    <div class="home-future-orbit" role="img" aria-label="Double T Steel product ecosystem">
                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/future-orbit1.svg" class="orbit-svg orbit-inner" alt="" aria-hidden="true" decoding="async">
                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/future-orbit2.svg" class="orbit-svg orbit-middle" alt="" aria-hidden="true" decoding="async">
                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/future-orbit3.svg" class="orbit-svg orbit-outer" alt="" aria-hidden="true" decoding="async">
                    </div>

                    <div class="home-future-img">
                        <img src="<?php echo esc_url($home_future_logo_url); ?>" class="img-basic" alt="logo future">
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Video Section -->
        <section class="home-video">
            <div class="home-video-bg">
                <img src="<?php echo get_template_directory_uri(); ?>/imgs/bg-filter.png" class="img-basic" alt="">
            </div>
            <div class="home-video-deco-right cut-tl"></div>

            <div class="container">
                <div class="home-video-deco-left cut-tl"></div>
                <div class="home-video-inner cut-xl cut-tl">
                    <div class="home-video-main cut-br" data-video-url="<?php echo esc_url($home_video_play_url); ?>">
                        <div class="home-video-overlay"></div>
                        <button type="button" class="home-video-control" aria-label="Play video">
                            <img src="<?php echo get_template_directory_uri(); ?>/imgs/play.svg" class="img-basic" alt="" aria-hidden="true">
                        </button>
                        <div class="home-video-thumb">
                            <img src="<?php echo esc_url($home_video_thumb_url); ?>" class="img-fill" alt="video thumbnail">
                        </div>
                        <video class="home-video-player img-fill" playsinline preload="metadata">
                            <?php if ($final_video_src): ?>
                                <source src="<?php echo esc_url($final_video_src); ?>">
                            <?php endif; ?>
                        </video>
                    </div>
                    <div class="home-video-video-deco"></div>
                </div>
            </div>
        </section>

        <!-- 4. Product Section -->
        <section class="home-product">
            <div class="home-product-linear"></div>
            <div class="home-product-bg"></div>
            <div class="home-product-main" id="homeProduct">
                <div class="container">
                    <div class="home-product-inner">
                        <div class="home-product-head">
                            <div class="label cut-diagonal cut-sm label-red home-product-label">
                                <div class="txt txt-13 txt-semi"><?php echo esc_html($home_product_label); ?></div>
                            </div>
                            <div class="home-product-title">
                                <h2 class="heading h1 h3_mb"><?php echo esc_html($home_product_title); ?></h2>
                            </div>
                        </div>
                        <div class="home-product-cms swiper home-product-slider">
                            <div class="home-product-list swiper-wrapper">
                                <?php foreach ($home_product_items as $prod): 
                                    $p_img_url = '';
                                    if (!empty($prod['image'])) {
                                        $p_img_url = wp_get_attachment_image_url($prod['image'], 'full');
                                    }
                                    if (!$p_img_url) {
                                        $p_img_url = get_template_directory_uri() . '/imgs/product.jpg';
                                    }
                                    $p_link = !empty($prod['link']) ? $prod['link'] : '#';
                                    $p_title = !empty($prod['title']) ? $prod['title'] : 'Hot Rolled-HR / Hot Rolled Pickled and Oiled-HRPO';
                                ?>
                                    <a href="<?php echo esc_url($p_link); ?>" class="home-product-item hover-img swiper-slide">
                                        <div class="home-product-item-img cut-tl">
                                            <div class="home-product-item-img-block"></div>
                                            <img src="<?php echo esc_url($p_img_url); ?>" class="img-abs" alt="<?php echo esc_attr($p_title); ?>">
                                        </div>
                                        <div class="home-product-item-content">
                                            <div class="home-product-item-title">
                                                <div class="heading h5"><?php echo esc_html($p_title); ?></div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="home-product-more grid">
                            <div class="home-product-control">
                                <div class="home-product-control-main">
                                    <button type="button" class="home-product-control-item home-product-prev cut-diagonal" aria-label="Previous product">
                                        <svg width="100%" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <path d="M12.5 5L7.5 10L12.5 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round" />
                                            </g>
                                        </svg>
                                    </button>
                                    <button type="button" class="home-product-control-item home-product-next cut-diagonal" aria-label="Next product">
                                        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.5 5L12.5 10L7.5 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="home-product-control-progress desktop">
                                    <div class="home-product-control-progress-inner"></div>
                                </div>
                            </div>
                            <div class="home-product-cta">
                                <a href="<?php echo esc_url($home_product_btn_link ?: '#'); ?>" class="home-product-cta-link btn btn-outline">
                                    <div class="txt txt-14 txt-semi"><?php echo esc_html($home_product_btn_text); ?></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="home-product-bg-blur">
                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/product-bg-bluur.png" class="img-basic" alt="">
                </div>
            </div>
            <div class="home-product-bg-bot"></div>
        </section>

        <!-- 5. Manufacturing Capabilities Section -->
        <section class="home-service">
            <div class="container grid">
                <div class="home-service-img">
                    <div class="home-service-img-block"></div>
                    <img src="<?php echo esc_url($home_service_top_img_url); ?>" class="img-abs" alt="">
                </div>
                <div class="home-service-content">
                    <div class="home-service-title-wrap">
                        <div class="home-service-title label red-light cut-diagonal cut-sm">
                            <div class="txt txt-13 txt-semi"><?php echo esc_html($home_service_label); ?></div>
                        </div>
                        <div class="home-service-title">
                            <h1 class="heading h1"><?php echo wp_kses_post($home_service_title); ?></h1>
                        </div>
                        <div class="home-service-sub">
                            <div class="txt txt-16"><?php echo wp_kses_post(nl2br($home_service_desc)); ?></div>
                        </div>
                    </div>
                    <a href="<?php echo esc_url($home_service_btn_link ?: '#'); ?>" class="btn home-service-btn btn-primary">
                        <div class="txt txt-14 txt-semi"><?php echo esc_html($home_service_btn_text); ?></div>
                    </a>
                </div>
                <div class="home-service-cms">
                    <div class="swiper home-service-slider">
                        <div class="home-service-deco desktop">
                            <img src="<?php echo get_template_directory_uri(); ?>/imgs/blur_card.png" class="img-basic" alt="logo watermark">
                        </div>

                        <div class="swiper-wrapper">
                            <?php 
                            $slide_idx = 0;
                            foreach ($home_service_slides as $srv): 
                                $slide_idx++;
                                $s_num = !empty($srv['num']) ? $srv['num'] : sprintf('%02d', $slide_idx);
                                $s_tag = !empty($srv['tag']) ? $srv['tag'] : 'SERVICES';
                                $s_title = !empty($srv['title']) ? $srv['title'] : '';
                                $s_types_label = !empty($srv['types_label']) ? $srv['types_label'] : 'Chủng loại thép gia công:';
                                $s_types_text = !empty($srv['types_text']) ? $srv['types_text'] : '';
                                $s_specs_label = !empty($srv['specs_label']) ? $srv['specs_label'] : 'Thông số kỹ thuật:';
                                $s_specs_text = !empty($srv['specs_text']) ? $srv['specs_text'] : '';
                                $s_tech_label = !empty($srv['tech_label']) ? $srv['tech_label'] : 'Điểm nhấn công nghệ:';
                                $s_tech_text = !empty($srv['tech_text']) ? $srv['tech_text'] : '';
                                $s_btn_text = !empty($srv['btn_text']) ? $srv['btn_text'] : 'SERVICE CONSULTATION';
                                $s_btn_link = !empty($srv['btn_link']) ? $srv['btn_link'] : '#';
                                
                                $s_img_url = '';
                                if (!empty($srv['image'])) {
                                    $s_img_url = wp_get_attachment_image_url($srv['image'], 'full');
                                }
                                if (!$s_img_url && !empty($srv['default_img'])) {
                                    $s_img_url = $srv['default_img'];
                                }
                                if (!$s_img_url) {
                                    $s_img_url = get_template_directory_uri() . '/imgs/service-item1.jpg';
                                }
                            ?>
                                <div class="swiper-slide home-service-slide" data-slide="<?php echo esc_attr($slide_idx); ?>">
                                    <div class="home-service-slide-left">
                                        <div class="home-service-watermark">
                                            <img src="<?php echo get_template_directory_uri(); ?>/imgs/logo_marker.png" class="img-basic" alt="logo watermark">
                                        </div>
                                        <div class="home-service-num heading h1"><?php echo esc_html($s_num); ?></div>
                                        <div class="home-service-card cut-tl">
                                            <div class="label cut-diagonal cut-sm label-red home-service-tag desktop">
                                                <div class="txt txt-13 txt-semi"><?php echo esc_html($s_tag); ?></div>
                                            </div>
                                            <div class="home-service-card-body">
                                                <h3 class="heading home-service-card-title heading h3 h4_mb"><?php echo esc_html($s_title); ?></h3>
                                                <div class="home-service-card-desc txt txt-14">
                                                    <?php if ($s_types_text): ?>
                                                        <div class="home-service-desc-item">
                                                            <span class="desc-label"><?php echo esc_html($s_types_label); ?></span>
                                                            <span class="desc-text"><?php echo wp_kses_post($s_types_text); ?></span>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($s_specs_text): ?>
                                                        <div class="home-service-desc-item">
                                                            <strong><?php echo esc_html($s_specs_label); ?></strong>
                                                            <ul class="home-service-specs">
                                                                <?php 
                                                                $specs_lines = explode("\n", str_replace("\r", "", $s_specs_text));
                                                                foreach ($specs_lines as $spec_line):
                                                                    $trimmed = trim($spec_line);
                                                                    if ($trimmed !== ''):
                                                                ?>
                                                                    <li><?php echo esc_html($trimmed); ?></li>
                                                                <?php 
                                                                    endif;
                                                                endforeach; 
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($s_tech_text): ?>
                                                        <div class="home-service-desc-item">
                                                            <strong><?php echo esc_html($s_tech_label); ?></strong>
                                                            <span class="desc-text"><?php echo wp_kses_post($s_tech_text); ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="home-service-card-action">
                                                    <a href="<?php echo esc_url($s_btn_link); ?>" class="btn btn-outline home-service-card-btn" <?php echo ($s_btn_link === '#' || empty($s_btn_link)) ? 'data-modal-target="consultationModal"' : ''; ?>>
                                                        <div class="txt txt-14 txt-semi"><?php echo esc_html($s_btn_text); ?></div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="home-service-slide-right">
                                        <div class="home-service-img-wrap">
                                            <img src="<?php echo esc_url($s_img_url); ?>" class="img-fill" alt="<?php echo esc_attr($s_title); ?>">
                                            <div class="home-service-img-overlay"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="home-service-controls">
                            <div class="home-service-controls-left">
                                <div class="home-service-ctrl-btn home-service-prev cut-diagonal btn_panigation" aria-label="Previous Slide">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.5 5L7.5 10L12.5 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="home-service-ctrl-btn home-service-next cut-diagonal btn_panigation" aria-label="Next Slide">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.5 5L12.5 10L7.5 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div class="home-service-progress desktop">
                                    <div class="home-service-progress-bar"></div>
                                </div>
                            </div>
                            <div class="home-service-controls-right desktop">
                                <div class="home-service-next-tab cut-sm">
                                    <?php 
                                    $total_slides = count($home_service_slides);
                                    if ($total_slides >= 2): 
                                        $s1 = $home_service_slides[0];
                                        $s2 = $home_service_slides[1];
                                    ?>
                                        <div class="home-service-next-tab-item active" data-slide-index="1">
                                            <span class="txt txt-13 txt-next-num txt-med"><?php echo esc_html(!empty($s2['num']) ? $s2['num'] : '02'); ?></span>
                                            <span class="txt txt-13 txt-semi txt-next-title cut-tl"><?php echo esc_html(!empty($s2['title']) ? $s2['title'] : 'Cut-to-Length Line'); ?></span>
                                        </div>
                                        <div class="home-service-next-tab-item" data-slide-index="0">
                                            <span class="txt txt-13 txt-next-num txt-med"><?php echo esc_html(!empty($s1['num']) ? $s1['num'] : '01'); ?></span>
                                            <span class="txt txt-13 txt-semi txt-next-title cut-tl"><?php echo esc_html(!empty($s1['title']) ? $s1['title'] : 'Slitting Line'); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. Steel Applications Section -->
        <section class="home-app">
            <div class="container">
                <div class="home-app-head">
                    <div class="label red-light cut-diagonal cut-sm home-app-label">
                        <div class="txt txt-13 txt-semi"><?php echo esc_html($home_app_label); ?></div>
                    </div>
                    <h2 class="heading h1 home-app-title h3_mb"><?php echo esc_html($home_app_title); ?></h2>
                </div>

                <div class="home-app-tabs-wrap">
                    <div class="home-app-tabs" role="tablist">
                        <?php 
                        $tab_i = 0;
                        foreach ($home_app_items as $app_item): 
                            $is_active = ($tab_i === 0);
                            $t_name = !empty($app_item['tab_title']) ? $app_item['tab_title'] : 'APPLICATION ' . ($tab_i + 1);
                        ?>
                            <button class="home-app-tab <?php echo $is_active ? 'active' : ''; ?>" data-tab="<?php echo esc_attr($tab_i); ?>" role="tab" aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>">
                                <span class="txt txt-15 txt-semi"><?php echo esc_html($t_name); ?></span>
                            </button>
                        <?php 
                            $tab_i++;
                        endforeach; 
                        ?>
                    </div>
                </div>

                <div class="home-app-panels">
                    <?php 
                    $panel_i = 0;
                    foreach ($home_app_items as $app_item): 
                        $is_active = ($panel_i === 0);
                        $p_title = !empty($app_item['panel_title']) ? $app_item['panel_title'] : (!empty($app_item['tab_title']) ? $app_item['tab_title'] : 'FACTORY INDUSTRIAL');
                        $p_desc = !empty($app_item['panel_desc']) ? $app_item['panel_desc'] : '2T steel is a suitable solution for projects requiring robust structural integrity, high load-bearing capacity, and rapid construction progress.';
                        $p_btn_text = !empty($app_item['btn_text']) ? $app_item['btn_text'] : 'EXPLORE SERVICES';
                        $p_btn_link = !empty($app_item['btn_link']) ? $app_item['btn_link'] : '#';
                        
                        $p_img_url = '';
                        if (!empty($app_item['image'])) {
                            $p_img_url = wp_get_attachment_image_url($app_item['image'], 'full');
                        }
                        if (!$p_img_url) {
                            $p_img_url = get_template_directory_uri() . '/imgs/application.jpg';
                        }

                        // Feature 1
                        $f1_icon = !empty($app_item['feat1_icon']) ? wp_get_attachment_image_url($app_item['feat1_icon'], 'full') : get_template_directory_uri() . '/imgs/icon1.svg';
                        $f1_title = !empty($app_item['feat1_title']) ? $app_item['feat1_title'] : 'FLEXIBLE APERTURE';
                        $f1_desc = !empty($app_item['feat1_desc']) ? $app_item['feat1_desc'] : 'Suitable for various factory scales.';

                        // Feature 2
                        $f2_icon = !empty($app_item['feat2_icon']) ? wp_get_attachment_image_url($app_item['feat2_icon'], 'full') : get_template_directory_uri() . '/imgs/icon2.svg';
                        $f2_title = !empty($app_item['feat2_title']) ? $app_item['feat2_title'] : 'HIGH LOAD CAPACITY';
                        $f2_desc = !empty($app_item['feat2_desc']) ? $app_item['feat2_desc'] : 'Suitable for industrial environments.';

                        // Feature 3
                        $f3_icon = !empty($app_item['feat3_icon']) ? wp_get_attachment_image_url($app_item['feat3_icon'], 'full') : get_template_directory_uri() . '/imgs/icon3.svg';
                        $f3_title = !empty($app_item['feat3_title']) ? $app_item['feat3_title'] : 'QUICK INSTALLATION';
                        $f3_desc = !empty($app_item['feat3_desc']) ? $app_item['feat3_desc'] : 'Optimize construction time.';
                    ?>
                        <div class="home-app-panel <?php echo $is_active ? 'active' : ''; ?>" data-panel="<?php echo esc_attr($panel_i); ?>">
                            <div class="home-app-panel-inner grid">
                                <div class="home-app-media">
                                    <div class="home-app-img cut-diagonal hover-img">
                                        <img src="<?php echo esc_url($p_img_url); ?>" class="img-abs" alt="<?php echo esc_attr($p_title); ?>">
                                    </div>
                                </div>
                                <div class="home-app-content">
                                    <h3 class="heading home-app-content-title heading h4 h5_mb"><?php echo esc_html($p_title); ?></h3>
                                    <p class="txt txt-16 home-app-content-desc txt-14_mb"><?php echo wp_kses_post(nl2br($p_desc)); ?></p>

                                    <div class="home-app-features">
                                        <div class="home-app-feature">
                                            <div class="home-app-feature-icon cut-diagonal">
                                                <div class="home-app-feature-icon-inner">
                                                    <img src="<?php echo esc_url($f1_icon); ?>" class="img-basic" alt="">
                                                </div>
                                            </div>
                                            <div class="home-app-feature-info">
                                                <div class="txt txt-14 txt-semi home-app-feature-title"><?php echo esc_html($f1_title); ?></div>
                                                <div class="txt txt-14 home-app-feature-desc"><?php echo esc_html($f1_desc); ?></div>
                                            </div>
                                        </div>

                                        <div class="home-app-feature">
                                            <div class="home-app-feature-icon cut-diagonal">
                                                <div class="home-app-feature-icon-inner">
                                                    <img src="<?php echo esc_url($f2_icon); ?>" class="img-basic" alt="">
                                                </div>
                                            </div>
                                            <div class="home-app-feature-info">
                                                <div class="txt txt-14 txt-semi home-app-feature-title"><?php echo esc_html($f2_title); ?></div>
                                                <div class="txt txt-14 home-app-feature-desc"><?php echo esc_html($f2_desc); ?></div>
                                            </div>
                                        </div>

                                        <div class="home-app-feature">
                                            <div class="home-app-feature-icon cut-diagonal">
                                                <div class="home-app-feature-icon-inner">
                                                    <img src="<?php echo esc_url($f3_icon); ?>" class="img-basic" alt="">
                                                </div>
                                            </div>
                                            <div class="home-app-feature-info">
                                                <div class="txt txt-14 txt-semi home-app-feature-title"><?php echo esc_html($f3_title); ?></div>
                                                <div class="txt txt-14 home-app-feature-desc"><?php echo esc_html($f3_desc); ?></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="home-app-action">
                                        <a href="<?php echo esc_url($p_btn_link); ?>" class="btn btn-primary home-app-btn">
                                            <div class="txt txt-14 txt-semi"><?php echo esc_html($p_btn_text); ?></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php 
                        $panel_i++;
                    endforeach; 
                    ?>
                </div>
            </div>
        </section>

        <!-- 7. Featured Media Section -->
        <section class="home-media">
            <div class="container">
                <div class="home-media-head">
                    <div class="label red-light cut-diagonal cut-sm home-media-label">
                        <div class="txt txt-13 txt-semi"><?php echo esc_html($home_media_label); ?></div>
                    </div>
                    <h2 class="heading h1 home-media-title h3_mb"><?php echo esc_html($home_media_title); ?></h2>
                </div>

                <?php foreach ($home_media_blocks as $b_idx => $block): 
                    $b_tag = $block['tag'];
                    $b_link = $block['link'];
                    $b_items = $block['items'];
                    $b_slider_id = !empty($block['slider_id']) ? $block['slider_id'] : ('home-media-slider-' . ($b_idx + 1));
                ?>
                    <div class="home-media-block">
                        <div class="home-media-bar">
                            <div class="home-media-tag cut-tl">
                                <span class="txt txt-16 txt-semi txt-14_mb"><?php echo esc_html($b_tag); ?></span>
                            </div>
                            <a href="<?php echo esc_url($b_link); ?>" class="home-media-view-all">
                                <span class="txt txt-14 txt-semi"><?php echo esc_html($home_view_all_text); ?></span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </a>
                        </div>

                        <div class="home-media-slider-wrap">
                            <div class="swiper home-media-slider <?php echo esc_attr($b_slider_id); ?>">
                                <div class="swiper-wrapper">
                                    <?php foreach ($b_items as $m_item): 
                                        $m_img_url = '';
                                        if (!empty($m_item['image'])) {
                                            $m_img_url = wp_get_attachment_image_url($m_item['image'], 'full');
                                        }
                                        if (!$m_img_url && !empty($m_item['default_img'])) {
                                            $m_img_url = $m_item['default_img'];
                                        }
                                        if (!$m_img_url) {
                                            $m_img_url = get_template_directory_uri() . '/imgs/product.jpg';
                                        }
                                        $m_title = !empty($m_item['title']) ? $m_item['title'] : '';
                                        $m_link = !empty($m_item['link']) ? $m_item['link'] : '#';
                                    ?>
                                        <div class="swiper-slide home-media-card hover-img">
                                            <div class="home-media-card-img cut-tl">
                                                <img src="<?php echo esc_url($m_img_url); ?>" class="img-abs" alt="<?php echo esc_attr($m_title); ?>">
                                            </div>
                                            <h3 class="home-media-card-title">
                                                <a href="<?php echo esc_url($m_link); ?>" class="txt txt-18 txt-bold"><?php echo esc_html($m_title); ?></a>
                                            </h3>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <button class="home-media-ctrl home-media-prev cut-diagonal" aria-label="Previous Slide">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="15 18 9 12 15 6"></polyline>
                                </svg>
                            </button>
                            <button class="home-media-ctrl home-media-next cut-diagonal" aria-label="Next Slide">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </button>

                            <div class="home-media-pagination swiper-pagination desktop"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- 8. Partners Section -->
        <section class="home-partners" id="partners">
            <div class="container">
                <div class="home-partners-head grid">
                    <div class="home-partners-head-left">
                        <div class="label red-light cut-diagonal cut-sm home-partners-label">
                            <div class="txt txt-13 txt-semi"><?php echo esc_html($home_partners_label); ?></div>
                        </div>
                        <h2 class="heading h1 h2_tb h3_mb home-partners-title">
                            <?php echo wp_kses_post($home_partners_title); ?>
                        </h2>
                    </div>
                    <div class="home-partners-head-right">
                        <p class="txt txt-16 home-partners-desc txt-14_mb">
                            <?php echo wp_kses_post($home_partners_desc); ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="home-partners-marquee">
                <div class="home-partners-marquee-track">
                    <div class="home-partners-marquee-group">
                        <?php 
                        if (is_array($home_partners_logos) && !empty($home_partners_logos)):
                            foreach ($home_partners_logos as $logo_id):
                                $logo_url = wp_get_attachment_image_url($logo_id, 'full');
                                if ($logo_url):
                        ?>
                                    <div class="home-partners-card">
                                        <img src="<?php echo esc_url($logo_url); ?>" alt="Partner Logo" class="home-partners-logo">
                                    </div>
                        <?php 
                                endif;
                            endforeach;
                        else:
                            for ($logo_i = 0; $logo_i < 10; $logo_i++):
                        ?>
                                <div class="home-partners-card">
                                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/logo_partner.jpg" alt="Partner Logo" class="home-partners-logo">
                                </div>
                        <?php 
                            endfor;
                        endif;
                        ?>
                    </div>
                    <div class="home-partners-marquee-group" aria-hidden="true">
                        <?php 
                        if (is_array($home_partners_logos) && !empty($home_partners_logos)):
                            foreach ($home_partners_logos as $logo_id):
                                $logo_url = wp_get_attachment_image_url($logo_id, 'full');
                                if ($logo_url):
                        ?>
                                    <div class="home-partners-card">
                                        <img src="<?php echo esc_url($logo_url); ?>" alt="" class="home-partners-logo">
                                    </div>
                        <?php 
                                endif;
                            endforeach;
                        else:
                            for ($logo_i = 0; $logo_i < 10; $logo_i++):
                        ?>
                                <div class="home-partners-card">
                                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/logo_partner.jpg" alt="" class="home-partners-logo">
                                </div>
                        <?php 
                            endfor;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- 9. Global Consultation CTA Section from Theme Options -->
        <?php render_consultation_cta(); ?>

    </main>

<?php get_footer(); ?>
