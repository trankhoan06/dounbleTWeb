<?php
/**
 * Template Name: Commitment
 */
get_header();

// 1. Hero Section Fields
$commit_hero_bg_id = tr_posts_field('commit_hero_bg');
$commit_hero_bg_url = $commit_hero_bg_id ? wp_get_attachment_image_url($commit_hero_bg_id, 'full') : get_template_directory_uri() . '/imgs/commit-banner.jpg';
$commit_hero_breadcrumb = tr_posts_field('commit_hero_breadcrumb') ?: 'Our Commitment';
$commit_hero_title = tr_posts_field('commit_hero_title') ?: 'ABOUT DOUBLE T';

// 2. Intro Section Fields
$commit_intro_label = tr_posts_field('commit_intro_label') ?: 'DOUBLE T METAL CO., LTD';
$commit_intro_title = tr_posts_field('commit_intro_title') ?: 'Introducing <span>Double T Co., LTD</span>';
$commit_intro_desc = tr_posts_field('commit_intro_desc') ?: 'Established in 2015, Double T Metal Co., Ltd. proudly stands as a leading steel processing company in Vietnam. Located in Hai Son Industrial Cluster, Duc Hoa District, Long An Province, Double T specializes in the supply and processing of a wide range of high-quality steel plates and coils, including:';
$commit_intro_list = tr_posts_field('commit_intro_list');
if (!is_array($commit_intro_list) || empty($commit_intro_list)) {
    $commit_intro_list = [
        ['item' => 'Hot-rolled (HR) steel, Pickled and Oiled (PO) steel, Cold-rolled (CR) steel.'],
        ['item' => 'Galvanized (GI) steel, Aluminum-zinc alloy coated (GL) steel, Color-coated (PPGL) steel, Electro-galvanized (EG) steel.'],
        ['item' => 'Stainless steel (SUS) and other shaped steel products.']
    ];
}
$commit_intro_img_id = tr_posts_field('commit_intro_img');
$commit_intro_img_url = $commit_intro_img_id ? wp_get_attachment_image_url($commit_intro_img_id, 'full') : get_template_directory_uri() . '/imgs/commit-intro.jpg';

// 3. Capabilities Section Fields
$commit_cap_label = tr_posts_field('commit_cap_label') ?: 'SERVICES';
$commit_cap_title = tr_posts_field('commit_cap_title') ?: 'Advanced manufacturing<br> and processing capabilities';
$commit_cap_summary = tr_posts_field('commit_cap_summary') ?: "The Double T factory is fully equipped with state-of-the-art machinery and production lines imported from Japan and Taiwan, meeting the market's most rigorous standards.";
$commit_cap_slides = tr_posts_field('commit_cap_slides');
if (!is_array($commit_cap_slides) || empty($commit_cap_slides)) {
    $commit_cap_slides = [
        [
            'number' => '01',
            'title' => 'Slitting Line',
            'types_label' => 'Chủng loại thép gia công:',
            'types_text' => 'Đa dạng các loại thép cán nóng (HR), thép tẩy gỉ (PO), thép cán nguội (CR), thép mạ kẽm (GI), mạ hợp kim nhôm kẽm (GL), mạ màu (PPGL), mạ điện (EG), Silic (ES), và thép không gỉ (SUS).',
            'specs_label' => 'Thông số kỹ thuật:',
            'specs_text' => "Độ dày: Từ 0.25 đến 4.00 mm.\nKhổ rộng băng con tối thiểu: 20 mm.\nKhổ rộng cuộn mẹ tối đa: 1,650 mm.\nTrọng lượng cuộn mẹ tối đa: Lên đến 25,000 kg.",
            'tech_label' => 'Điểm nhấn công nghệ:',
            'tech_text' => 'Dây chuyền được tích hợp bộ phận đặc biệt (RB21), có khả năng chống trầy xước tuyệt đối khi cắt xẻ các bề mặt nhạy cảm như thép mạ kẽm, mạ điện và thép mạ màu.',
            'btn_text' => 'SERVICE CONSULTATION',
            'btn_link' => '#consultationModal',
            'image' => '',
            'default_img' => get_template_directory_uri() . '/imgs/service-item1.jpg',
        ],
        [
            'number' => '02',
            'title' => 'Cut-to-Length Line',
            'types_label' => 'Chủng loại thép gia công:',
            'types_text' => 'Thép cán nóng (HR), thép tẩy gỉ (PO), thép cán nguội (CR), thép mạ kẽm (GI), mạ hợp kim nhôm kẽm (GL) và thép mạ màu (PPGL).',
            'specs_label' => 'Thông số kỹ thuật:',
            'specs_text' => "Độ dày: Từ 0.30 đến 6.00 mm.\nChiều dài cắt tối đa: Lên đến 6,000 mm.\nKhổ rộng tối đa: 1,650 mm.\nĐộ chính xác dung sai: ± 0.5 mm.",
            'tech_label' => 'Điểm nhấn công nghệ:',
            'tech_text' => 'Hệ thống nắn phẳng tự động đa trục độ chính xác cao, đảm bảo bề mặt tấm thép sau cắt đạt độ phẳng tuyệt đối, không cong vênh.',
            'btn_text' => 'SERVICE CONSULTATION',
            'btn_link' => '#consultationModal',
            'image' => '',
            'default_img' => get_template_directory_uri() . '/imgs/home-service.webp',
        ]
    ];
}

// 4. Mission & Vision Section Fields
$commit_mv_label = tr_posts_field('commit_mv_label') ?: 'MISSION &amp; VISION';
$commit_mv_title = tr_posts_field('commit_mv_title') ?: 'Our Mission <span class="commit-mission-vision-title-tail">&amp; Vision</span>';
$commit_mission_img_id = tr_posts_field('commit_mission_img');
$commit_mission_img_url = $commit_mission_img_id ? wp_get_attachment_image_url($commit_mission_img_id, 'full') : get_template_directory_uri() . '/imgs/commit-vison.jpg';
$commit_mission_title = tr_posts_field('commit_mission_title') ?: 'MISSION';
$commit_mission_items = tr_posts_field('commit_mission_items');
if (!is_array($commit_mission_items) || empty($commit_mission_items)) {
    $commit_mission_items = [
        [
            'title' => 'FOR CUSTOMERS',
            'desc' => 'Providing high-quality steel products and solutions for absolute precision machining, helping customers optimize production costs and enhance their competitive advantage.'
        ],
        [
            'title' => 'FOR PARTNERS AND SHAREHOLDERS',
            'desc' => 'Build sustainable, transparent partnerships based on the principles of mutual benefit and shared prosperity.'
        ],
        [
            'title' => 'FOR SOCIETY AND PERSONNEL',
            'desc' => 'To create a professional, safe work environment rich in development opportunities for employees, while actively contributing to the growth of the mechanical manufacturing industry and the local economy.'
        ]
    ];
}

$commit_vision_logo_id = tr_posts_field('commit_vision_logo');
$commit_vision_logo_url = $commit_vision_logo_id ? wp_get_attachment_image_url($commit_vision_logo_id, 'full') : get_template_directory_uri() . '/imgs/logo.png';
$commit_vision_bg_id = tr_posts_field('commit_vision_bg');
$commit_vision_bg_url = $commit_vision_bg_id ? wp_get_attachment_image_url($commit_vision_bg_id, 'full') : get_template_directory_uri() . '/imgs/commit-vison-bg.jpg';
$commit_vision_title = tr_posts_field('commit_vision_title') ?: 'VISION';
$commit_vision_desc = tr_posts_field('commit_vision_desc') ?: 'To become the leading brand and number-one strategic partner in Vietnam for the supply and processing of steel coils and sheets. Double T is committed to continuously expanding its scale and enhancing its technological capabilities, aiming to become a symbol of reliability, quality, and technical excellence within the mechanical support industry.';

// 5. Partners Fields
$commit_partners_label = tr_posts_field('commit_partners_label') ?: 'PARTNERS';
$commit_partners_title = tr_posts_field('commit_partners_title') ?: 'Partnering to create<br>sustainable value.';
$commit_partners_desc = tr_posts_field('commit_partners_desc') ?: 'Partnering with <strong class="txt-primary txt-semi">Double T</strong> is the key to unlocking success, enabling you to confidently embrace new opportunities and challenges in the future of the metal industry.';
$commit_partners_logos = tr_posts_field('commit_partners_logos');
?>

    <main class="main">
        <!-- 1. Hero Section -->
        <section class="commit-hero">
            <div class="commit-hero-bg">
                <img src="<?php echo esc_url($commit_hero_bg_url); ?>" class="img-fill" alt="">
            </div>
            <div class="container">
                <div class="commit-hero-content">
                    <div class="commit-hero-content-bg cut-tr"></div>
                    <div class="commit-hero-pagi txt txt-14 txt-med txt-13_mb">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="commit-hero-pagi-prev">Home</a>
                        <div class="commit-hero-pagi-devi">/</div>
                        <div><?php echo esc_html($commit_hero_breadcrumb); ?></div>
                    </div>
                    <h1 class="commit-hero-title heading h1 h3_mb">
                        <?php echo esc_html($commit_hero_title); ?>
                    </h1>
                </div>
            </div>
        </section>

        <!-- 2. Intro Section -->
        <section class="commit-intro" aria-labelledby="commitIntroTitle">
            <div class="container grid commit-intro-inner">
                <div class="commit-intro-content">
                    <div class="label red-light cut-diagonal cut-sm">
                        <div class="txt txt-13 txt-semi"><?php echo esc_html($commit_intro_label); ?></div>
                    </div>

                    <h2 class="heading h2 h3_tb h3_mb commit-intro-title" id="commitIntroTitle">
                        <?php echo wp_kses_post($commit_intro_title); ?>
                    </h2>

                    <div class="commit-intro-copy">
                        <p class="txt txt-16 txt-14_tb txt-14_mb">
                            <?php echo wp_kses_post(nl2br($commit_intro_desc)); ?>
                        </p>

                        <?php if (!empty($commit_intro_list)): ?>
                            <ul class="commit-intro-list txt-med">
                                <?php foreach ($commit_intro_list as $intro_li): 
                                    $item_text = is_array($intro_li) ? ($intro_li['item'] ?? '') : $intro_li;
                                    if (trim($item_text) !== ''):
                                ?>
                                    <li class="txt txt-16 txt-14_tb txt-14_mb">
                                        <?php echo wp_kses_post($item_text); ?>
                                    </li>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>

                <figure class="commit-intro-media cut-diagonal cut-lg hover-img">
                    <img src="<?php echo esc_url($commit_intro_img_url); ?>" class="img-basic"
                        alt="Double T steel processing facilities and production team">
                </figure>
            </div>
        </section>

        <!-- 3. Capabilities Section -->
        <section class="commit-capabilities" id="commitCapabilities" aria-labelledby="commitCapabilitiesTitle">
            <div class="container">
                <div class="grid commit-capabilities-head">
                    <div class="commit-capabilities-heading">
                        <div class="label red-light cut-diagonal cut-sm commit-capabilities-label">
                            <div class="txt txt-13 txt-semi"><?php echo esc_html($commit_cap_label); ?></div>
                        </div>
                        <h2 class="heading h2 h3_tb h3_mb commit-capabilities-title" id="commitCapabilitiesTitle">
                            <?php echo wp_kses_post($commit_cap_title); ?>
                        </h2>
                    </div>

                    <p class="txt txt-16 txt-14_tb txt-14_mb commit-capabilities-summary">
                        <?php echo wp_kses_post(nl2br($commit_cap_summary)); ?>
                    </p>
                </div>

                <div class="swiper commit-capabilities-slider">
                    <div class="swiper-wrapper">
                        <?php 
                        $cap_idx = 0;
                        foreach ($commit_cap_slides as $cap_slide): 
                            $cap_idx++;
                            $c_num = !empty($cap_slide['number']) ? $cap_slide['number'] : sprintf('%02d', $cap_idx);
                            $c_title = !empty($cap_slide['title']) ? $cap_slide['title'] : '';
                            $c_types_label = !empty($cap_slide['types_label']) ? $cap_slide['types_label'] : 'Chủng loại thép gia công:';
                            $c_types_text = !empty($cap_slide['types_text']) ? $cap_slide['types_text'] : '';
                            $c_specs_label = !empty($cap_slide['specs_label']) ? $cap_slide['specs_label'] : 'Thông số kỹ thuật:';
                            $c_specs_text = !empty($cap_slide['specs_text']) ? $cap_slide['specs_text'] : '';
                            $c_tech_label = !empty($cap_slide['tech_label']) ? $cap_slide['tech_label'] : 'Điểm nhấn công nghệ:';
                            $c_tech_text = !empty($cap_slide['tech_text']) ? $cap_slide['tech_text'] : '';
                            $c_btn_text = !empty($cap_slide['btn_text']) ? $cap_slide['btn_text'] : 'SERVICE CONSULTATION';
                            $c_btn_link = !empty($cap_slide['btn_link']) ? $cap_slide['btn_link'] : '#consultationModal';
                            
                            $c_img_url = '';
                            if (!empty($cap_slide['image'])) {
                                $c_img_url = wp_get_attachment_image_url($cap_slide['image'], 'full');
                            }
                            if (!$c_img_url && !empty($cap_slide['default_img'])) {
                                $c_img_url = $cap_slide['default_img'];
                            }
                            if (!$c_img_url) {
                                $c_img_url = get_template_directory_uri() . '/imgs/service-item1.jpg';
                            }
                        ?>
                            <article class="swiper-slide commit-capabilities-slide">
                                <div class="commit-capabilities-slide-left">
                                    <div class="commit-capabilities-watermark" aria-hidden="true">
                                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/logo_marker.png" class="img-basic" alt="">
                                    </div>
                                    <div class="heading h1 commit-capabilities-number"><?php echo esc_html($c_num); ?></div>

                                    <div class="commit-capabilities-card cut-tl">
                                        <div class="commit-capabilities-card-body">
                                            <h3 class="heading h3 h4_tb h4_mb commit-capabilities-card-title">
                                                <?php echo esc_html($c_title); ?>
                                            </h3>

                                            <div class="txt txt-14 txt-14_tb txt-14_mb commit-capabilities-card-desc">
                                                <?php if ($c_types_text): ?>
                                                    <div>
                                                        <span class="txt-semi"><?php echo esc_html($c_types_label); ?></span>
                                                        <?php echo wp_kses_post($c_types_text); ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ($c_specs_text): ?>
                                                    <div>
                                                        <span class="txt-semi"><?php echo esc_html($c_specs_label); ?></span>
                                                        <ul class="commit-capabilities-specs">
                                                            <?php 
                                                            $specs_lines = explode("\n", str_replace("\r", "", $c_specs_text));
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

                                                <?php if ($c_tech_text): ?>
                                                    <div>
                                                        <span class="txt-semi"><?php echo esc_html($c_tech_label); ?></span>
                                                        <?php echo wp_kses_post($c_tech_text); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="commit-capabilities-card-action">
                                                <a href="<?php echo esc_url($c_btn_link); ?>"
                                                    class="btn btn-outline commit-capabilities-card-btn"
                                                    <?php echo ($c_btn_link === '#consultationModal' || $c_btn_link === '#' || empty($c_btn_link)) ? 'data-modal-target="consultationModal"' : ''; ?>>
                                                    <span class="txt txt-13 txt-semi"><?php echo esc_html($c_btn_text); ?></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="commit-capabilities-slide-right">
                                    <img src="<?php echo esc_url($c_img_url); ?>" class="img-fill" alt="<?php echo esc_attr($c_title); ?>">
                                    <div class="commit-capabilities-image-overlay"></div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>

                    <div class="commit-capabilities-controls">
                        <button type="button" class="commit-capabilities-prev btn_panigation cut-diagonal"
                            aria-label="Show previous service">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.5 5L7.5 10L12.5 15" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="square" stroke-linejoin="round" />
                            </svg>
                        </button>

                        <button type="button" class="commit-capabilities-next btn_panigation cut-diagonal"
                            aria-label="Show next service">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.5 5L12.5 10L7.5 15" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="square" stroke-linejoin="round" />
                            </svg>
                        </button>

                        <div class="commit-capabilities-progress desktop" aria-hidden="true">
                            <div class="commit-capabilities-progress-bar"></div>
                        </div>

                        <button type="button" class="commit-capabilities-next-tab desktop cut-sm"
                            aria-label="Show next service">
                            <?php 
                            $total_cap = count($commit_cap_slides);
                            if ($total_cap >= 2):
                                $cs1 = $commit_cap_slides[0];
                                $cs2 = $commit_cap_slides[1];
                            ?>
                                <span class="commit-capabilities-next-item active" data-slide-index="1">
                                    <span class="txt txt-13 txt-med commit-capabilities-next-number"><?php echo esc_html(!empty($cs2['number']) ? $cs2['number'] : '02'); ?></span>
                                    <span class="txt txt-13 txt-semi commit-capabilities-next-title cut-tl">
                                        <?php echo esc_html(!empty($cs2['title']) ? $cs2['title'] : 'Cut-to-Length Line'); ?>
                                    </span>
                                </span>
                                <span class="commit-capabilities-next-item" data-slide-index="0">
                                    <span class="txt txt-13 txt-med commit-capabilities-next-number"><?php echo esc_html(!empty($cs1['number']) ? $cs1['number'] : '01'); ?></span>
                                    <span class="txt txt-13 txt-semi commit-capabilities-next-title cut-tl">
                                        <?php echo esc_html(!empty($cs1['title']) ? $cs1['title'] : 'Slitting Line'); ?>
                                    </span>
                                </span>
                            <?php endif; ?>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Mission & Vision Section -->
        <section class="commit-mission-vision" id="commitMissionVision" aria-labelledby="commitMissionVisionTitle">
            <div class="container">
                <div class="commit-mission-vision-head">
                    <div class="label red-light cut-diagonal cut-sm commit-mission-vision-label">
                        <div class="txt txt-13 txt-semi"><?php echo esc_html($commit_mv_label); ?></div>
                    </div>
                    <h2 class="heading h2 h3_tb h3_mb commit-mission-vision-title" id="commitMissionVisionTitle">
                        <?php echo wp_kses_post($commit_mv_title); ?>
                    </h2>
                </div>

                <div class="commit-mission-row">
                    <figure class="commit-mission-media">
                        <img src="<?php echo esc_url($commit_mission_img_url); ?>" alt="Double T technician operating a steel processing line">
                    </figure>

                    <div class="commit-mission-panel cut-tr cut-lg">
                        <h3 class="heading h3 h4_tb h4_mb commit-mission-title"><?php echo esc_html($commit_mission_title); ?></h3>

                        <div class="commit-mission-list">
                            <?php 
                            $m_icons = [
                                // Icon 1 (Customers)
                                '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="7" r="2.5" stroke="currentColor" /><circle cx="5.5" cy="9" r="2" stroke="currentColor" /><circle cx="18.5" cy="9" r="2" stroke="currentColor" /><path d="M7.5 19V17.2C7.5 14.7 9.5 12.7 12 12.7C14.5 12.7 16.5 14.7 16.5 17.2V19" stroke="currentColor" stroke-linecap="square" /><path d="M2.5 18V16.6C2.5 14.7 4 13.2 5.9 13.2H7.1M21.5 18V16.6C21.5 14.7 20 13.2 18.1 13.2H16.9" stroke="currentColor" stroke-linecap="square" /></svg>',
                                // Icon 2 (Partners)
                                '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.8 8.2L11 6C12 5 13.6 5 14.6 6L16 7.4M7.4 16L5 13.6C4 12.6 4 11 5 10L7 8" stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" /><path d="M15.2 15.8L13 18C12 19 10.4 19 9.4 18L8 16.6M16.6 8L19 10.4C20 11.4 20 13 19 14L17 16" stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" /><path d="M8.5 11.5L12.3 15.3C13 16 14.1 16 14.8 15.3C15.5 14.6 15.5 13.5 14.8 12.8L12.2 10.2L10.8 11.6C10.1 12.3 9 12.3 8.3 11.6L8 11.3" stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" /></svg>',
                                // Icon 3 (Society)
                                '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 10.5L8.8 7.6C7.5 6.4 5.5 6.5 4.4 7.9C3.4 9.2 3.6 11.1 4.8 12.2L12 18.5L19.2 12.2C20.4 11.1 20.6 9.2 19.6 7.9C18.5 6.5 16.5 6.4 15.2 7.6L12 10.5Z" stroke="currentColor" stroke-linejoin="round" /><path d="M3 16.5L7 20.5H10M21 16.5L17 20.5H14" stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" /></svg>'
                            ];

                            $mi_idx = 0;
                            foreach ($commit_mission_items as $m_item):
                                $m_title = !empty($m_item['title']) ? $m_item['title'] : '';
                                $m_desc = !empty($m_item['desc']) ? $m_item['desc'] : '';
                                $svg_icon = $m_icons[$mi_idx % count($m_icons)];
                                $mi_idx++;
                            ?>
                                <article class="commit-mission-item">
                                    <div class="commit-mission-icon-frame cut-diagonal cut-sm" aria-hidden="true">
                                        <div class="commit-mission-icon cut-diagonal cut-sm">
                                            <?php echo $svg_icon; ?>
                                        </div>
                                    </div>
                                    <div class="commit-mission-item-content">
                                        <h4 class="txt txt-16 txt-16_tb txt-16_mb txt-bold commit-mission-item-title">
                                            <?php echo esc_html($m_title); ?>
                                        </h4>
                                        <p class="txt txt-14 txt-14_tb txt-14_mb commit-mission-item-desc">
                                            <?php echo wp_kses_post(nl2br($m_desc)); ?>
                                        </p>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="commit-vision-banner">
                    <div class="commit-vision-brand">
                        <div class="commit-vision-brand-logo">
                            <img src="<?php echo esc_url($commit_vision_logo_url); ?>" alt="Double T">
                        </div>
                        <div class="commit-vision-brand-bg">
                            <img src="<?php echo esc_url($commit_vision_bg_url); ?>" class="img-fill" alt="">
                        </div>
                    </div>
                    <div class="commit-vision-content">
                        <h3 class="heading h3 h4_tb h4_mb commit-vision-title"><?php echo esc_html($commit_vision_title); ?></h3>
                        <p class="txt txt-14 txt-14_tb txt-13_mb commit-vision-desc">
                            <?php echo wp_kses_post(nl2br($commit_vision_desc)); ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. Shared Partners Section -->
        <section class="home-partners" id="partners">
            <div class="container">
                <div class="home-partners-head grid">
                    <div class="home-partners-head-left">
                        <div class="label red-light cut-diagonal cut-sm home-partners-label">
                            <div class="txt txt-13 txt-semi"><?php echo esc_html($commit_partners_label); ?></div>
                        </div>
                        <h2 class="heading h1 h2_tb h3_mb home-partners-title">
                            <?php echo wp_kses_post($commit_partners_title); ?>
                        </h2>
                    </div>
                    <div class="home-partners-head-right">
                        <p class="txt txt-16 home-partners-desc">
                            <?php echo wp_kses_post($commit_partners_desc); ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="home-partners-marquee">
                <div class="home-partners-marquee-track">
                    <div class="home-partners-marquee-group">
                        <?php 
                        if (is_array($commit_partners_logos) && !empty($commit_partners_logos)):
                            foreach ($commit_partners_logos as $logo_id):
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
                        if (is_array($commit_partners_logos) && !empty($commit_partners_logos)):
                            foreach ($commit_partners_logos as $logo_id):
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

        <!-- 6. Global Consultation CTA Banner from Theme Options -->
        <?php render_consultation_cta(); ?>

    </main>
    
<?php get_footer(); ?>