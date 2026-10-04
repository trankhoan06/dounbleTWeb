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
            <div class="commit-hero-bg hero-enter-item">
                <img src="<?php echo esc_url($commit_hero_bg_url); ?>" class="img-fill" alt="" loading="eager" fetchpriority="high" decoding="async">
            </div>
            <div class="container">
                <div class="commit-hero-content">
                    <div class="commit-hero-content-bg cut-tr hero-panel-bg-fade hero-enter-bg"></div>
                    <div class="commit-hero-copy hero-enter-item hero-enter-panel">
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
            </div>
        </section>

        <!-- 2. Intro Section -->
        <section class="commit-intro page-first-section-reveal reveal-ready" aria-labelledby="commitIntroTitle">
            <div class="container grid commit-intro-inner">
                <div class="commit-intro-content">
                    <div class="label red-light cut-diagonal cut-sm">
                        <div class="txt txt-13 txt-semi"><?php echo esc_html($commit_intro_label); ?></div>
                    </div>

                    <h2 class="heading h1 h3_tb h3_mb commit-intro-title" id="commitIntroTitle">
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

                <figure class="commit-intro-media cut-diagonal cut-lg hover-img reveal-ready">
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
                        <h2 class="heading h1 h3_tb h3_mb commit-capabilities-title" id="commitCapabilitiesTitle">
                            <?php echo wp_kses_post($commit_cap_title); ?>
                        </h2>
                    </div>

                    <p class="txt txt-16 txt-14_tb txt-14_mb commit-capabilities-summary">
                        <?php echo wp_kses_post(nl2br($commit_cap_summary)); ?>
                    </p>
                </div>

                <div class="swiper commit-capabilities-slider">
                    <div class="home-service-deco desktop">
                            <img src="<?php echo get_template_directory_uri(); ?>/imgs/blur_card.png" class="img-basic" alt="logo watermark">
                        </div>
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
                                        <div class="home-service-watermark">
                                            <img src="<?php echo get_template_directory_uri(); ?>/imgs/logo_marker.png" class="img-basic" alt="logo watermark">
                                        </div>
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
						<div class="commit-capabilities-controls_wrap">
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

						</div>
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
                    <h2 class="heading h1 h3_tb h3_mb commit-mission-vision-title" id="commitMissionVisionTitle">
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
                                '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.8101 1.69246C11.9322 1.68718 12.0544 1.68715 12.1765 1.69237C13.1256 1.73941 14.0164 2.16448 14.65 2.8727C15.2794 3.5714 15.6057 4.49141 15.5571 5.43057C15.5128 6.23867 15.192 7.00695 14.6484 7.60652C14.5019 7.76948 14.356 7.89899 14.1919 8.04394C14.7459 8.19698 15.5857 8.78726 15.9835 9.20344C16.159 9.38723 16.2975 9.56925 16.4625 9.7534C17.18 9.30236 17.97 9.11215 18.8147 9.21455C19.7561 9.33348 20.6116 9.82209 21.1922 10.5726C21.7736 11.3219 22.0305 12.2728 21.9055 13.2128C21.7882 14.12 21.2822 14.9816 20.5611 15.5417C20.7366 15.5969 20.9614 15.7082 21.1237 15.7946C22.4896 16.5225 23.4871 17.8706 23.7401 19.4022C23.8516 20.0765 23.8046 20.748 23.8134 21.4291C23.8177 21.7561 23.8409 22.0647 23.5075 22.2498C23.2152 22.4119 22.8125 22.2471 22.7168 21.9274C22.6817 21.802 22.6867 21.6665 22.6868 21.5376C22.6886 20.43 22.7822 19.5065 22.2657 18.483C21.7934 17.5454 20.9668 16.8349 19.9689 16.509C19.3986 16.323 19.0311 16.3227 18.4497 16.3157C17.618 16.3058 16.9673 16.3579 16.2085 16.7456C15.1122 17.3059 14.3409 18.3465 14.1238 19.5583C14.0023 20.2543 14.0944 21.0337 14.0602 21.7409C14.0407 22.1444 13.688 22.415 13.3071 22.2777C12.8138 22.0999 12.9598 21.57 12.9389 21.1702C12.927 20.3514 12.9094 19.5525 13.1597 18.7653C13.6407 17.2535 14.721 16.1197 16.1816 15.5436C15.934 15.3282 15.7458 15.1498 15.5424 14.8887C14.7201 13.8337 14.5839 12.378 15.1873 11.1855C15.3079 10.9472 15.4475 10.7603 15.5944 10.539C15.4404 10.3256 15.3092 10.1615 15.1231 9.974C14.5364 9.37735 13.7725 8.98656 12.9454 8.86005C12.6911 8.82316 12.4469 8.81729 12.1906 8.81621C11.7591 8.81536 11.3762 8.80367 10.9495 8.88031C9.87755 9.07286 9.01985 9.66236 8.40226 10.5443C8.99674 11.3481 9.28342 12.1807 9.15839 13.1899C9.03451 14.12 8.55077 14.9644 7.8111 15.5417C8.88808 15.9136 9.89501 16.842 10.4429 17.8313C10.806 18.4939 11.0152 19.2297 11.0551 19.9843C11.0709 20.2645 11.094 21.7161 11.0328 21.9166C10.9889 22.0607 10.8887 22.181 10.7549 22.2501C10.6215 22.3191 10.4657 22.3309 10.3235 22.2825C9.84747 22.1238 9.93292 21.5957 9.93826 21.1926C9.95113 20.2216 9.97645 19.4291 9.54082 18.5336C9.08312 17.592 8.26986 16.871 7.28019 16.5294C6.68585 16.3257 6.30277 16.3222 5.69223 16.3157C4.87962 16.3073 4.25415 16.3532 3.50672 16.7216C2.39453 17.27 1.60627 18.311 1.37995 19.5302C1.31541 19.8832 1.31293 20.2273 1.31329 20.5843C1.31354 20.849 1.34886 21.7377 1.27368 21.9457C1.22264 22.0869 1.10839 22.2065 0.971132 22.2666C0.834665 22.3256 0.680268 22.3275 0.542391 22.2719C0.0731234 22.0787 0.197779 21.556 0.188796 21.1469C0.166429 20.1281 0.17082 19.2189 0.59386 18.2669C1.16409 16.9836 2.1271 16.0578 3.43151 15.5436C2.84319 15.0293 2.43409 14.5173 2.20705 13.7485C1.93941 12.8376 2.04764 11.8576 2.50758 11.0271C2.96166 10.2013 3.72556 9.58996 4.63083 9.32792C5.38943 9.10766 6.19997 9.1482 6.9328 9.44302C7.16165 9.53559 7.33459 9.63591 7.54839 9.75407C8.0851 8.9845 8.92406 8.37483 9.79705 8.0427C9.68611 7.91868 9.50325 7.77715 9.36499 7.62441C8.8328 7.04752 8.51005 6.30844 8.44861 5.52598C8.37539 4.58151 8.68101 3.64672 9.298 2.9279C9.96056 2.16638 10.8043 1.76368 11.8101 1.69246ZM18.5686 15.1757C19.9097 15.068 20.909 13.8925 20.7993 12.5516C20.6896 11.2105 19.5126 10.213 18.1718 10.3247C16.8338 10.4361 15.8389 11.6101 15.9483 12.9484C16.0578 14.2865 17.2302 15.2832 18.5686 15.1757ZM5.81857 15.1757C7.15972 15.068 8.15901 13.8925 8.04932 12.5516C7.93964 11.2105 6.76262 10.213 5.4218 10.3247C4.08379 10.4361 3.08882 11.6101 3.19827 12.9484C3.30772 14.2865 4.48024 15.2832 5.81857 15.1757ZM12.1936 7.67573C13.5347 7.56805 14.534 6.39252 14.4243 5.05152C14.3146 3.71054 13.1376 2.713 11.7968 2.82469C10.4588 2.93614 9.46383 4.11013 9.57327 5.4483C9.68272 6.78647 10.8552 7.78319 12.1936 7.67573Z" fill="#0B6F7E"/>
</svg>
',
                                // Icon 2 (Partners)
                                '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0 7.93945C0.0489376 7.80661 0.0637778 7.48096 0.0860156 7.3269C0.132368 7.02503 0.197285 6.7263 0.2804 6.43242C0.823752 4.52244 2.129 2.92015 3.88964 2.00178C5.58828 1.12523 7.56568 0.959745 9.38639 1.54178C10.1106 1.77466 10.7931 2.12102 11.4087 2.56792C11.598 2.70569 11.8372 2.9261 12.0002 3.03765C12.3166 2.77817 12.5239 2.59706 12.8726 2.36878C14.2543 1.46622 15.9048 1.06717 17.5464 1.23874C19.4303 1.43421 21.1603 2.36742 22.3583 3.83447C23.1062 4.74691 23.6188 5.82881 23.8514 6.98539C23.8894 7.17015 23.9187 7.35661 23.9391 7.54413C23.9497 7.63689 23.9745 7.93965 24 8.01115V8.84529C23.974 8.93328 23.9638 9.06031 23.9554 9.15346C23.9258 9.47975 23.8736 9.78411 23.7981 10.1032C23.5377 11.1998 23.0242 12.2203 22.2986 13.0829C22.0091 13.4252 21.7008 13.7244 21.3848 14.0415L20.8317 14.5964C20.3278 15.1042 20.0249 15.4393 19.247 15.4231C19.2609 15.9499 19.1101 16.2951 18.7581 16.6808C18.3602 17.1165 17.8988 17.4536 17.2748 17.4145C17.2518 18.1413 17.0296 18.4531 16.5062 18.9389C16.2038 19.2194 15.7248 19.4538 15.3048 19.3957C15.2818 19.4179 15.2808 19.4597 15.2821 19.4913C15.3154 20.3004 14.6636 20.7885 14.1398 21.3127L13.1943 22.2654C12.525 22.9271 11.6194 23.011 10.898 22.3549C10.4207 21.9207 10.1188 21.5504 10.1267 20.871C10.1269 20.8516 10.1274 20.8324 10.1279 20.8131C9.59905 20.8202 9.24826 20.6884 8.86439 20.3202C8.39222 19.8674 8.1576 19.5693 8.14916 18.8943C8.14889 18.8733 8.14886 18.852 8.14905 18.831C7.75486 18.866 7.30175 18.6996 7.00331 18.4435C6.51972 18.0287 6.10972 17.5206 6.17136 16.8429C5.3233 16.8826 4.95541 16.3963 4.41677 15.8547L3.43685 14.8707L2.49785 13.9277C2.1878 13.6165 1.88333 13.3152 1.60566 12.9727C1.11745 12.3678 0.730155 11.6881 0.458736 10.9597C0.302674 10.5388 0.185211 10.1047 0.107799 9.66253C0.0838229 9.52758 0.029682 8.96797 0 8.89973V7.93945ZM9.34886 13.6508C9.90995 13.6446 10.2527 13.7832 10.6606 14.1704C11.0483 14.5385 11.3229 14.91 11.3307 15.4745C11.3313 15.5237 11.3301 15.5729 11.3271 15.622C11.7929 15.5993 12.1821 15.7392 12.5292 16.0518C13.0335 16.506 13.3409 16.9188 13.309 17.6283C13.7947 17.6164 14.1899 17.7401 14.5496 18.0799C14.8239 18.339 14.989 18.5995 15.4119 18.5932C15.7766 18.5878 15.9851 18.3277 16.2224 18.0886C16.3869 17.9226 16.48 17.7078 16.4707 17.4704C16.4647 17.3147 16.4122 17.1642 16.32 17.0385C16.2343 16.9226 16.0086 16.7074 15.8979 16.5964L15.1198 15.816L12.4528 13.1355C12.2885 12.9702 11.7108 12.4347 11.6347 12.2757C11.5685 12.1377 11.5999 11.959 11.7025 11.8472C11.7791 11.7638 11.8833 11.7157 11.997 11.7159C12.1058 11.7161 12.1911 11.7629 12.2747 11.8281C12.4172 11.9392 12.5445 12.09 12.672 12.2188L13.4059 12.957L15.9927 15.5567C16.1988 15.7639 16.8055 16.4232 17.0184 16.5217C17.3211 16.6617 17.6497 16.6008 17.9032 16.3956C18.1537 16.1624 18.4407 15.9188 18.4471 15.5586C18.4518 15.2952 18.3757 15.1147 18.1944 14.9306C17.816 14.5461 17.433 14.1649 17.0524 13.7835L14.8962 11.6191L14.1053 10.8249C13.9557 10.6755 13.7937 10.5231 13.6576 10.3622C13.5299 10.2111 13.5681 9.95215 13.7152 9.82278C13.7932 9.75494 13.8954 9.72166 13.9985 9.73055C14.2389 9.75012 14.5032 10.0864 14.6693 10.2552L15.3885 10.976L17.9381 13.5363L18.3986 13.9987C18.5234 14.1249 18.6482 14.2511 18.7754 14.3763C19.0741 14.6704 19.5509 14.6892 19.8705 14.4167C20.0257 14.2844 20.1994 14.1157 20.312 13.9429C20.4879 13.6638 20.4586 13.2614 20.2371 13.0151C20.1243 12.8894 20.0011 12.7711 19.8825 12.652L19.2203 11.9868L17.0944 9.84968L14.9882 7.73639L14.3198 7.06557C14.1995 6.94482 14.08 6.82208 13.9552 6.7059C13.8923 6.64741 13.8068 6.6253 13.7236 6.61558C13.5165 6.59138 13.3672 6.76022 13.2371 6.89454C13.0397 7.09835 12.8385 7.29848 12.638 7.49927L10.995 9.14887C10.6604 9.48489 10.2129 9.97923 9.82605 10.2105C9.42682 10.4527 8.96384 10.569 8.49752 10.5441C7.64892 10.5066 6.51716 9.91158 6.56557 8.93236C6.57509 8.70856 6.64736 8.49196 6.77413 8.30728C6.88356 8.14807 7.08279 7.96103 7.2235 7.82017L7.84089 7.20218L10.2834 4.75173L11.0455 3.98758C11.1279 3.90494 11.3489 3.69486 11.4165 3.612C10.1632 2.50945 8.68714 1.97842 7.0218 2.00993C5.33631 2.04675 3.73566 2.75663 2.57692 3.98123C1.39731 5.22056 0.759649 6.87854 0.804799 8.58892C0.840084 9.9847 1.32821 11.3312 2.1956 12.4254C2.73645 13.1075 3.46103 13.7202 4.06011 14.3568C4.10186 14.4013 4.18636 14.4961 4.24003 14.5138C4.25205 14.5039 4.33179 14.2889 4.35069 14.2482C4.47496 13.9809 4.6401 13.8226 4.8454 13.6168L5.31403 13.1468L6.01216 12.4462C6.14691 12.3112 6.29941 12.1508 6.43937 12.0261C6.50636 11.9663 6.57929 11.9136 6.65704 11.8687C6.95037 11.6966 7.29036 11.6209 7.62905 11.6523C8.04845 11.6944 8.33927 11.864 8.64218 12.1481C9.10998 12.5867 9.3842 12.9756 9.34886 13.6508ZM13.2562 18.4263C12.9311 18.5049 12.8244 18.6636 12.5966 18.8921L12.0654 19.4257L11.4481 20.0464C11.328 20.1674 11.1035 20.3674 11.0319 20.5008C10.7779 20.9738 10.973 21.3375 11.333 21.6622C11.6194 21.9206 11.7619 22.0477 12.1628 21.9814C12.4786 21.8899 12.5824 21.7408 12.8071 21.5138L13.2956 21.0201L13.9166 20.3977C14.0419 20.2724 14.3143 20.0196 14.3914 19.8778C14.4926 19.6885 14.5146 19.4668 14.4526 19.2614C14.3895 19.0561 14.2833 18.9662 14.145 18.8149C13.8523 18.4947 13.6903 18.3961 13.2562 18.4263ZM11.2988 16.447C10.986 16.4854 10.8228 16.699 10.6123 16.9099L10.0654 17.4585L9.45671 18.0697C9.16604 18.362 8.8937 18.5717 8.94696 19.0285C8.97739 19.2896 9.12289 19.449 9.30289 19.6257C9.55325 19.8889 9.77521 20.0509 10.1613 19.9901C10.4751 19.9264 10.5976 19.7627 10.8152 19.5444L11.2998 19.0577L11.9418 18.4121C12.2565 18.0955 12.5981 17.8394 12.4958 17.3437C12.427 17.0108 12.1218 16.7632 11.8705 16.5573C11.7165 16.4353 11.4862 16.4369 11.2988 16.447ZM7.40875 12.4635C7.29615 12.4671 7.11375 12.5069 7.02885 12.5853C6.40271 13.1631 5.81619 13.7922 5.20993 14.392C5.05301 14.5473 4.97705 14.7753 4.98486 14.9921C4.99799 15.3657 5.27313 15.5839 5.52308 15.8242C5.68887 15.9835 5.89673 16.044 6.12505 16.0352C6.48518 15.9951 6.62666 15.8033 6.86959 15.5592L7.4277 14.9977L8.04014 14.3811C8.32311 14.0972 8.60284 13.8853 8.55098 13.4395C8.51694 13.1469 8.37113 13.0126 8.17417 12.8135C7.91712 12.5537 7.7854 12.4424 7.40875 12.4635ZM9.37361 14.4427C8.97855 14.5063 8.8663 14.691 8.59706 14.9611L7.94843 15.6123L7.41676 16.1468C7.13186 16.4335 6.89418 16.6494 6.97757 17.0983C7.03894 17.4287 7.36868 17.6939 7.61455 17.8986C7.74229 18.0013 7.96539 18.0275 8.12585 18.021C8.48406 17.9605 8.58562 17.8064 8.83311 17.5575L9.35463 17.0348L10.0289 16.359C10.1229 16.2647 10.3159 16.0822 10.3877 15.9815C10.5119 15.806 10.5603 15.588 10.5221 15.3765C10.4743 15.1042 10.3261 14.982 10.1464 14.7942C9.91061 14.5476 9.73049 14.4192 9.37361 14.4427ZM16.6409 2.00958C15.5598 2.03566 14.503 2.33592 13.5698 2.88219C12.7107 3.38877 12.253 3.9099 11.5585 4.60765L10.1027 6.07057L8.4169 7.76265C8.1198 8.06033 7.82208 8.3573 7.52646 8.65657C7.42407 8.76225 7.35002 8.87017 7.36402 9.02456C7.37644 9.16171 7.43985 9.2433 7.53871 9.33089C8.05305 9.78665 8.85084 9.86015 9.43718 9.50005C9.67479 9.35412 9.86681 9.14426 10.0627 8.94748L10.5638 8.44333L12.3055 6.68941C12.5427 6.45067 12.8446 6.10326 13.132 5.94876C13.5625 5.71745 14.1537 5.79231 14.5098 6.12739C14.6617 6.26681 14.8068 6.41762 14.9531 6.56464L15.7269 7.34311L19.0962 10.7246L20.1912 11.8244C20.4803 12.1145 20.8179 12.412 21.0318 12.7624C21.0757 12.8344 21.1324 13.0407 21.1754 13.0895C21.2414 13.0642 21.3752 12.9061 21.4286 12.8504C21.9364 12.3186 22.3389 11.7156 22.6391 11.0431C23.3332 9.47994 23.3788 7.70531 22.7659 6.10861C22.1586 4.52625 20.949 3.24902 19.402 2.55663C18.4786 2.14721 17.6416 2.00021 16.6409 2.00958Z" fill="#0B6F7E"/>
</svg>
',
                                // Icon 3 (Society)
                                '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12.0323 11.2195C12.1144 11.2172 12.1965 11.2223 12.2776 11.2345C12.6729 11.2954 13.0217 11.5263 13.2323 11.8663C13.3039 11.9795 13.3766 12.1429 13.4373 12.2648C13.5378 12.4668 13.6348 12.6709 13.7365 12.8725C13.9141 13.2272 14.1204 13.5667 14.3536 13.8877C14.7267 14.4019 15.0876 14.8317 15.756 14.9297C16.0639 14.9749 16.4706 14.9505 16.7919 14.9557C17.0691 14.9602 17.5362 14.9701 17.7852 14.9003C18.8109 14.6123 19.3991 13.3521 19.8483 12.4774C20.0408 12.1025 20.1685 11.7244 20.5242 11.4734C20.8152 11.268 21.201 11.1814 21.5481 11.2416C21.9102 11.3018 22.2326 11.506 22.4416 11.8078C22.6522 12.1145 22.7296 12.4935 22.6562 12.8582C22.5974 13.1604 22.3867 13.4722 22.2317 13.7392L21.7382 14.5938L21.3621 15.245C21.2894 15.3709 21.1796 15.5752 21.0917 15.681C20.7602 16.0802 20.4125 16.4682 20.0771 16.8645C19.8607 17.1199 19.6002 17.373 19.4606 17.6771C19.2335 18.172 19.2286 18.7607 19.2293 19.2966C19.2255 19.4796 19.2559 19.6707 19.226 19.852C19.1707 20.1871 18.7255 20.2752 18.5473 19.9871C18.4738 19.8684 18.4814 19.6941 18.4857 19.5573C18.5004 19.09 18.4558 18.6141 18.5321 18.1513C18.5926 17.786 18.7239 17.436 18.9187 17.1211C19.0731 16.8682 19.2613 16.6583 19.4539 16.4352L20.155 15.6205C20.2566 15.5018 20.4148 15.3286 20.5055 15.2074C20.5993 15.082 20.7343 14.8315 20.8176 14.6876L21.3811 13.7127C21.4482 13.5966 21.5191 13.4827 21.5845 13.3604C21.7745 13.0049 22.1099 12.6424 21.8231 12.2344C21.7187 12.0857 21.5912 12.0179 21.4165 11.9859C21.2123 11.9803 20.9501 12.0134 20.8467 12.1975C20.1101 13.5087 19.4717 15.3388 17.7944 15.6739C17.4541 15.7419 16.9256 15.7018 16.5624 15.7109C16.2053 15.7198 15.7704 15.7218 15.4214 15.6345C14.1607 15.2938 13.4866 14.0265 12.9377 12.9496C12.8148 12.7084 12.6335 12.2302 12.4215 12.0867C11.9811 11.7887 11.3559 12.175 11.4705 12.713C11.508 12.8891 11.7428 13.2492 11.841 13.4187L12.3441 14.2901L12.6783 14.8685C12.7311 14.9599 12.8282 15.1388 12.89 15.2155C13.0076 15.3613 13.1412 15.5129 13.2636 15.6553L13.9569 16.4609C14.1333 16.6661 14.2932 16.8459 14.4432 17.0736C14.6306 17.3638 14.7634 17.6856 14.8351 18.0234C14.9511 18.5599 14.8911 19.15 14.906 19.6972C14.9119 19.9154 14.8175 20.1148 14.5844 20.1541C14.4034 20.1848 14.1846 20.0521 14.1647 19.8605C14.1467 19.7173 14.1571 19.5705 14.1553 19.4259C14.145 18.8919 14.2099 18.3405 13.9944 17.8354C13.8124 17.3885 13.5251 17.1185 13.2216 16.7579C12.9112 16.3893 12.5879 16.0321 12.2815 15.6611C12.2156 15.5814 12.0902 15.3527 12.0334 15.2544L11.6363 14.5678L11.1278 13.6879C10.9363 13.3566 10.7257 13.0624 10.7132 12.6675C10.6881 11.8693 11.2421 11.2713 12.0323 11.2195Z" fill="#0B6F7E"/>
<path d="M5.74188 4.12927C5.84573 4.12388 5.92962 4.12466 6.03324 4.13968C6.40712 4.19407 6.74132 4.40211 6.95514 4.71361C7.05371 4.85929 7.13419 5.03829 7.21185 5.19782C7.31409 5.40827 7.41773 5.61805 7.52278 5.82713C7.70712 6.18757 7.92101 6.53213 8.16226 6.85725C8.53087 7.35335 8.88164 7.74618 9.53268 7.83716C9.83444 7.87934 10.2557 7.85647 10.5689 7.86123C10.8344 7.86527 11.2826 7.87052 11.5247 7.80563C12.6048 7.5161 13.1571 6.26545 13.6178 5.35532C13.8021 4.99096 13.9322 4.644 14.2661 4.39778C14.5614 4.18411 14.9294 4.09604 15.2894 4.15282C15.9262 4.25066 16.4165 4.79636 16.4385 5.44519C16.4547 5.91788 16.2678 6.16941 16.0416 6.56154L15.5821 7.3572L15.1501 8.10375C15.0667 8.24794 14.9875 8.39971 14.8917 8.53596C14.7787 8.69675 13.6087 10.0628 13.4951 10.1415C13.4246 10.1905 13.3205 10.2195 13.2353 10.2C13.1372 10.1776 13.0317 10.1075 12.9782 10.0217C12.908 9.90924 12.9119 9.76047 12.9754 9.64617C13.0701 9.47605 13.2349 9.31802 13.3628 9.16988C13.6537 8.833 13.9565 8.50005 14.2358 8.15405C14.3333 8.03316 14.4068 7.88972 14.4845 7.75557L14.8303 7.15767L15.3182 6.314C15.434 6.11401 15.6271 5.82786 15.6778 5.61485C15.758 5.27916 15.5187 4.97871 15.2036 4.9025C14.7471 4.8622 14.6244 5.02731 14.4337 5.40852C13.8013 6.67215 13.0337 8.37109 11.453 8.59495C11.1135 8.64304 10.7102 8.612 10.3632 8.61797C9.98732 8.62441 9.57793 8.63568 9.21275 8.55144C7.83163 8.17745 7.11762 6.71214 6.53865 5.52983C6.35911 5.1632 6.21605 4.81753 5.71794 4.90182C5.56001 4.92812 5.41964 5.01771 5.32926 5.14988C5.19336 5.34702 5.19131 5.60912 5.30875 5.8152C5.4266 6.022 5.54751 6.22724 5.66642 6.43352C5.87708 6.80283 6.09028 7.17068 6.30601 7.53704C6.40814 7.70745 6.52968 7.95813 6.64181 8.10901C6.72809 8.2251 6.88434 8.39595 6.98355 8.51132L7.57304 9.19664C7.68492 9.32627 7.95701 9.60333 7.98192 9.76097C7.99837 9.86257 7.97313 9.9665 7.9119 10.0492C7.8506 10.1319 7.75874 10.1866 7.65683 10.2012C7.56534 10.2135 7.44273 10.1759 7.38175 10.1154C7.2034 9.93829 7.01355 9.7003 6.84991 9.50964L6.33428 8.90972C6.23535 8.79495 6.08391 8.62888 6.00152 8.50786C5.91834 8.38564 5.82135 8.20706 5.7459 8.07625L5.2909 7.28663L4.85531 6.53548C4.77362 6.39456 4.66133 6.21148 4.5955 6.06683C4.53566 5.93612 4.49702 5.79672 4.48107 5.65385C4.43909 5.28689 4.54672 4.9185 4.77968 4.63187C5.0341 4.3149 5.34421 4.17114 5.74188 4.12927Z" fill="#0B6F7E"/>
<path d="M2.57491 11.524C2.99293 11.4894 3.42323 11.6589 3.70339 11.974C3.89657 12.1911 4.02351 12.5213 4.15972 12.7879C4.53146 13.5152 4.95154 14.3766 5.60726 14.8887C5.77763 15.0218 6.01604 15.1429 6.22328 15.1921C6.56828 15.2739 6.97442 15.2422 7.33053 15.2461C7.60011 15.2492 7.96881 15.2576 8.22388 15.2214C8.82856 15.1356 9.23108 14.7552 9.56309 14.2726C9.65977 14.1425 9.78043 13.9989 9.94791 13.9751C10.1305 13.9492 10.3518 14.1171 10.3555 14.3005C10.3614 14.5936 10.0085 14.9436 9.82709 15.1508C9.39469 15.6438 8.78478 15.9458 8.1305 15.9908C7.63486 16.0229 6.51368 16.0334 6.06042 15.9312C4.72029 15.6291 3.94897 14.061 3.39789 12.9403C3.18881 12.515 3.11115 12.2312 2.53189 12.2882C2.22269 12.3849 2.01902 12.6676 2.0729 12.9812C2.10181 13.1495 2.34705 13.5321 2.43939 13.6921L2.95094 14.5777L3.2834 15.1522C3.34319 15.2554 3.43288 15.4226 3.50297 15.51C3.62035 15.6564 3.75313 15.8065 3.87638 15.9496L4.54493 16.7251C4.71597 16.924 4.89603 17.1253 5.03934 17.3452C5.24115 17.6517 5.3814 17.9946 5.45229 18.3549C5.54839 18.8359 5.49864 19.3558 5.51355 19.8457C5.51795 19.9904 5.51971 20.1745 5.43394 20.2958C5.37893 20.3739 5.29485 20.4263 5.20067 20.4415C5.09921 20.4586 4.99519 20.4333 4.91286 20.3715C4.70945 20.2188 4.76262 19.9299 4.7585 19.7063C4.74875 19.1766 4.81414 18.6795 4.62091 18.1703C4.45338 17.7288 4.16488 17.4375 3.86437 17.0874C3.54741 16.7113 3.21843 16.3471 2.90461 15.9693C2.82149 15.8692 2.69981 15.6451 2.63057 15.5254L2.23722 14.845L1.73614 13.9775C1.58466 13.7152 1.36831 13.3929 1.33234 13.0915C1.23543 12.2799 1.7573 11.6101 2.57491 11.524Z" fill="#0B6F7E"/>
<path d="M10.3539 3.54679C11.4011 3.48985 12.2956 4.29368 12.3506 5.34093C12.4056 6.3882 11.6 7.28122 10.5526 7.33418C9.50809 7.38699 8.618 6.58411 8.5632 5.53965C8.50839 4.49519 9.30959 3.60357 10.3539 3.54679ZM10.4126 6.57525C11.0372 6.59939 11.5638 6.11415 11.5908 5.48966C11.6178 4.86515 11.135 4.33629 10.5106 4.30643C9.88223 4.27638 9.34916 4.76302 9.322 5.39157C9.29482 6.02013 9.78389 6.55095 10.4126 6.57525Z" fill="#0B6F7E"/>
<path d="M7.10506 10.9394C8.14611 10.8304 9.07856 11.5856 9.1882 12.6267C9.29784 13.6676 8.54319 14.6005 7.50227 14.7107C6.46046 14.8211 5.52657 14.0657 5.41683 13.0238C5.3071 11.9819 6.06311 11.0485 7.10506 10.9394ZM7.44789 13.9516C8.07039 13.8711 8.50948 13.3007 8.42814 12.6783C8.34679 12.056 7.77589 11.6176 7.1536 11.6998C6.53252 11.7819 6.09522 12.3514 6.17641 12.9726C6.2576 13.5938 6.82658 14.0319 7.44789 13.9516Z" fill="#0B6F7E"/>
<path d="M16.6468 10.4934C17.3436 10.491 17.9718 10.8199 18.3307 11.4284C18.4068 11.5573 18.4136 11.7177 18.3277 11.8442C18.2692 11.9295 18.1791 11.9878 18.0773 12.0062C17.8069 12.0537 17.7034 11.8234 17.5657 11.6493C17.3091 11.3248 16.8891 11.197 16.4878 11.264C16.1896 11.3145 15.9243 11.4833 15.7523 11.7322C15.5788 11.986 15.5125 12.2981 15.5678 12.6005C15.7526 13.5977 17.0763 13.8746 17.6452 13.0159C17.7277 12.9027 17.797 12.7919 17.95 12.7675C18.1593 12.7341 18.3639 12.8751 18.3875 13.0897C18.4084 13.2793 18.2613 13.4681 18.1447 13.6061C17.8201 13.9904 17.3377 14.2463 16.8342 14.2829C16.3294 14.317 15.8315 14.1504 15.449 13.8192C15.0697 13.4915 14.8381 13.0254 14.8059 12.5252C14.7366 11.4001 15.5373 10.5637 16.6468 10.4934Z" fill="#0B6F7E"/>
<path d="M11.4094 15.332C11.8436 15.349 11.9273 15.7735 11.6412 16.0452C11.5676 16.1152 11.471 16.2404 11.4034 16.319L10.6781 17.1612C10.5138 17.3522 10.3076 17.5779 10.1762 17.7868C10.0232 18.0297 9.9213 18.3013 9.87686 18.585C9.82026 18.9418 9.85599 19.3871 9.84665 19.7554C9.84391 19.8638 9.85188 20.0099 9.84104 20.1153C9.83582 20.1714 9.81827 20.2259 9.78962 20.2745C9.71982 20.3909 9.61952 20.4297 9.49794 20.4612C8.97651 20.4603 9.10866 19.8687 9.09576 19.5269C9.06496 18.7102 9.12974 17.9267 9.63588 17.2438C9.76771 17.0661 9.90214 16.9109 10.0469 16.7432L10.58 16.1227C10.784 15.8854 10.9972 15.622 11.2165 15.3992C11.2574 15.3576 11.3516 15.3421 11.4094 15.332Z" fill="#0B6F7E"/>
</svg>
'
                            ];

                            $mi_idx = 0;
                            foreach ($commit_mission_items as $m_item):
                                $m_title = !empty($m_item['title']) ? $m_item['title'] : '';
                                $m_desc = !empty($m_item['desc']) ? $m_item['desc'] : '';
                                $svg_icon = !empty($m_item['icon']) ? $m_item['icon'] : $m_icons[$mi_idx % count($m_icons)];
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
