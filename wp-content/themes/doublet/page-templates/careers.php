<?php
/**
 * Template Name: Careers
 */
get_header();

// 1. Hero Section Fields
$careers_hero_bg_id = tr_posts_field('careers_hero_bg');
$careers_hero_bg_url = $careers_hero_bg_id ? wp_get_attachment_image_url($careers_hero_bg_id, 'full') : get_template_directory_uri() . '/imgs/product-banner.jpg';
$careers_hero_breadcrumb = tr_posts_field('careers_hero_breadcrumb') ?: 'Careers';
$careers_hero_title = tr_posts_field('careers_hero_title') ?: 'JOB OPPORTUNITIES';

// 2. Introduction & Working Environment Gallery Fields
$careers_intro_desc = tr_posts_field('careers_intro_desc') ?: "At Double T, your skills and ideas directly shape your career and our industry. Whether you’re an engineer, technician, strategist, or a graduate starting your first role, you’ll take on challenging projects, learn from industry leaders, and grow in a company that invests in your development. From cutting-edge steel plants to innovative green steel and digital operations, your work here has real impact – on your career and on India’s steel industry.";

$careers_gallery_img_1_id = tr_posts_field('careers_gallery_img_1');
$careers_gallery_img_1_url = $careers_gallery_img_1_id ? wp_get_attachment_image_url($careers_gallery_img_1_id, 'full') : get_template_directory_uri() . '/imgs/career-gallery-1.jpg';

$careers_gallery_img_2_id = tr_posts_field('careers_gallery_img_2');
$careers_gallery_img_2_url = $careers_gallery_img_2_id ? wp_get_attachment_image_url($careers_gallery_img_2_id, 'full') : get_template_directory_uri() . '/imgs/video-thumb.jpg';

$careers_gallery_img_3_id = tr_posts_field('careers_gallery_img_3');
$careers_gallery_img_3_url = $careers_gallery_img_3_id ? wp_get_attachment_image_url($careers_gallery_img_3_id, 'full') : get_template_directory_uri() . '/imgs/product-banner.jpg';

$careers_gallery_img_4_id = tr_posts_field('careers_gallery_img_4');
$careers_gallery_img_4_url = $careers_gallery_img_4_id ? wp_get_attachment_image_url($careers_gallery_img_4_id, 'full') : get_template_directory_uri() . '/imgs/commit-vison.jpg';

$careers_gallery_stat_number = tr_posts_field('careers_gallery_stat_number') ?: '20+';

// 3. Job Openings Fields
$careers_openings_label = tr_posts_field('careers_openings_label') ?: 'JOB OPENINGS';
$careers_openings_title = tr_posts_field('careers_openings_title') ?: 'Career Development';
$careers_th_position = tr_posts_field('careers_th_position') ?: 'POSITION';
$careers_th_location = tr_posts_field('careers_th_location') ?: 'LOCATION';
$careers_th_deadline = tr_posts_field('careers_th_deadline') ?: 'DEADLINE';

// Lấy danh sách việc làm từ ACF Post Type 'career'
$career_posts = get_posts([
    'post_type'      => 'career',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC'
]);

$careers_jobs_list = [];

if (!empty($career_posts)) {
    foreach ($career_posts as $c_post) {
        $c_id = $c_post->ID;

        // Location: Ưu tiên ACF get_field -> post_meta -> typerocket -> fallback
        $c_location = '';
        if (function_exists('get_field')) {
            $c_location = get_field('location', $c_id) ?: (get_field('career_location', $c_id) ?: get_field('workplace', $c_id));
        }
        if (empty($c_location)) {
            $c_location = get_post_meta($c_id, 'location', true) ?: (get_post_meta($c_id, 'career_location', true) ?: tr_posts_field('career_location', $c_id));
        }
        if (empty($c_location)) {
            $c_location = 'Office';
        }

        // Deadline: Ưu tiên ACF get_field -> post_meta -> typerocket -> fallback
        $c_deadline = '';
        if (function_exists('get_field')) {
            $c_deadline = get_field('deadline', $c_id) ?: get_field('career_deadline', $c_id);
        }
        if (empty($c_deadline)) {
            $c_deadline = get_post_meta($c_id, 'deadline', true) ?: (get_post_meta($c_id, 'career_deadline', true) ?: tr_posts_field('career_deadline', $c_id));
        }
        if (empty($c_deadline)) {
            $c_deadline = '20/10/2026';
        }

        // Button text
        $c_btn = '';
        if (function_exists('get_field')) {
            $c_btn = get_field('btn_text', $c_id) ?: get_field('career_btn_text', $c_id);
        }
        if (empty($c_btn)) {
            $c_btn = tr_posts_field('career_btn_text', $c_id);
        }
        if (empty($c_btn)) {
            $c_btn = 'VIEW DETAIL';
        }

        $careers_jobs_list[] = [
            'title'    => get_the_title($c_id),
            'location' => $c_location,
            'deadline' => $c_deadline,
            'link'     => get_permalink($c_id),
            'btn_text' => $c_btn
        ];
    }
}

// Nếu chưa có bài viết trong Post Type 'career', lấy từ TypeRocket repeater hoặc dữ liệu mặc định
if (empty($careers_jobs_list)) {
    $tr_jobs = tr_posts_field('careers_jobs_list');
    if (is_array($tr_jobs) && !empty($tr_jobs)) {
        $careers_jobs_list = $tr_jobs;
    } else {
        $careers_jobs_list = [
            [
                'title' => 'Steel Production Engineer',
                'location' => 'Office',
                'deadline' => '20/10/2026',
                'link' => '#',
                'btn_text' => 'VIEW DETAIL'
            ],
            [
                'title' => 'Steel Quality Control Engineer',
                'location' => 'Headquarters',
                'deadline' => '20/10/2026',
                'link' => '#',
                'btn_text' => 'VIEW DETAIL'
            ],
            [
                'title' => 'Steel Sales Manager',
                'location' => 'Office',
                'deadline' => '20/10/2026',
                'link' => '#',
                'btn_text' => 'VIEW DETAIL'
            ],
            [
                'title' => 'Steel Fabrication Supervisor',
                'location' => 'Office',
                'deadline' => '20/10/2026',
                'link' => '#',
                'btn_text' => 'VIEW DETAIL'
            ],
            [
                'title' => 'Project Engineer – Steel Structures',
                'location' => 'Headquarters',
                'deadline' => '20/10/2026',
                'link' => '#',
                'btn_text' => 'VIEW DETAIL'
            ]
        ];
    }
}

// 4. Cultural Stats Banner Fields
$careers_success_title = tr_posts_field('careers_success_title') ?: 'Together We Build<br><span class="careers-success-accent">Success</span>';
$careers_success_bg_id = tr_posts_field('careers_success_bg');
$careers_success_bg_url = $careers_success_bg_id ? wp_get_attachment_image_url($careers_success_bg_id, 'full') : get_template_directory_uri() . '/imgs/hero-img.jpg';

$careers_success_stats = tr_posts_field('careers_success_stats');
if (!is_array($careers_success_stats) || empty($careers_success_stats)) {
    $careers_success_stats = [
        ['number' => '10+', 'label' => 'Year of Development'],
        ['number' => '100+', 'label' => 'Human Resources'],
        ['number' => '2', 'label' => 'Branch']
    ];
}
?>

    <main class="main">
        <!-- 1. Hero Section -->
        <section class="careers-hero" aria-labelledby="careersHeroTitle">
            <div class="careers-hero-bg">
                <img src="<?php echo esc_url($careers_hero_bg_url); ?>" class="img-fill" alt="Double T steel processing factory">
            </div>
            <div class="container careers-hero-inner">
                <div class="careers-hero-panel">
                    <div class="careers-hero-panel-bg cut-tr"></div>
                    <nav class="careers-breadcrumb txt txt-14 txt-14_tb txt-14_mb" aria-label="Breadcrumb">
                        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                        <span class="commit-hero-pagi-devi" aria-hidden="true">/</span>
                        <span class="current"><?php echo esc_html($careers_hero_breadcrumb); ?></span>
                    </nav>
                    <h1 class="heading h1 h3_mb careers-hero-title" id="careersHeroTitle">
                        <?php echo esc_html($careers_hero_title); ?>
                    </h1>
                </div>
            </div>
        </section>

        <!-- 2. Introduction & 4-Photo Working Environment Grid -->
        <section class="careers-intro">
            <div class="container">
                <p class="careers-intro-copy txt txt-16 txt-14_tb txt-14_mb txt-med">
                    <?php echo wp_kses_post(nl2br($careers_intro_desc)); ?>
                </p>

                <!-- 4-Image Grid -->
                <div class="careers-gallery">
                    <!-- Column 1: Tall Portrait Operator Photo -->
                    <figure class="careers-gallery-item careers-gallery-tall hover-img">
                        <img src="<?php echo esc_url($careers_gallery_img_1_url); ?>" class="img-fill"
                            alt="Double T engineers and machine operators on the production line" loading="lazy">
                    </figure>

                    <!-- Column 2-3 Row 1: Wide Aerial View of Complex -->
                    <figure class="careers-gallery-item careers-gallery-wide hover-img">
                        <img src="<?php echo esc_url($careers_gallery_img_2_url); ?>" class="img-fill"
                            alt="Aerial view of Double T steel processing manufacturing complex" loading="lazy">
                    </figure>

                    <!-- Column 2 Row 2: Slitting Line Machinery Operation -->
                    <figure class="careers-gallery-item careers-gallery-sub hover-img">
                        <img src="<?php echo esc_url($careers_gallery_img_3_url); ?>" class="img-fill"
                            alt="Automated coil slitting line operation" loading="lazy">
                    </figure>

                    <!-- Column 3 Row 2: Operator with Stats Overlay -->
                    <figure class="careers-gallery-item careers-gallery-sub careers-gallery-stat hover-img">
                        <img src="<?php echo esc_url($careers_gallery_img_4_url); ?>" class="img-fill"
                            alt="Double T technician at the precision control console" loading="lazy">
                        <?php if ($careers_gallery_stat_number): ?>
                            <div class="careers-gallery-overlay">
                                <span class="heading h1 h2_tb h3_mb txt-bold careers-gallery-stat-number"><?php echo esc_html($careers_gallery_stat_number); ?></span>
                            </div>
                        <?php endif; ?>
                    </figure>
                </div>
            </div>
        </section>

        <!-- 3. Job Openings / Career Development Listing -->
        <section class="careers-openings" id="job-openings">
            <div class="container">
                <div class="careers-section-heading">
                    <div class="label red-light cut-diagonal cut-sm">
                        <span class="txt txt-13 txt-semi"><?php echo esc_html($careers_openings_label); ?></span>
                    </div>
                    <h2 class="heading h2 h3_tb h4_mb careers-section-title"><?php echo esc_html($careers_openings_title); ?></h2>
                </div>

                <div class="careers-jobs" role="list">
                    <!-- Table Header -->
                    <div class="careers-job careers-job-head txt txt-13 txt-med" aria-hidden="true">
                        <div><?php echo esc_html($careers_th_position); ?></div>
                        <div><?php echo esc_html($careers_th_location); ?></div>
                        <div><?php echo esc_html($careers_th_deadline); ?></div>
                        <div></div>
                    </div>

                    <!-- Job Rows -->
                    <?php foreach ($careers_jobs_list as $job): 
                        $j_title = !empty($job['title']) ? $job['title'] : '';
                        $j_location = !empty($job['location']) ? $job['location'] : '';
                        $j_deadline = !empty($job['deadline']) ? $job['deadline'] : '';
                        $j_link = !empty($job['link']) ? $job['link'] : '#';
                        $j_btn = !empty($job['btn_text']) ? $job['btn_text'] : 'VIEW DETAIL';
                    ?>
                        <a href="<?php echo esc_url($j_link); ?>" class="careers-job" role="listitem">
                            <h3 class="heading h6 careers-job-title"><?php echo esc_html($j_title); ?></h3>
                            <div class="txt txt-16 txt-14_mb careers-job-location"><?php echo esc_html($j_location); ?></div>
                            <div class="txt txt-16 txt-14_mb careers-job-deadline"><?php echo esc_html($j_deadline); ?></div>
                            <div class="careers-job-btn btn" aria-label="<?php echo esc_attr($j_btn . ' for ' . $j_title); ?>">
                                <span class="txt txt-14 txt-13_mb txt-semi"><?php echo esc_html($j_btn); ?></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- 4. Cultural Stats Banner: Together We Build Success -->
        <section class="careers-success">
            <div class="container careers-success-container">
                <!-- Top Header Row -->
                <div class="careers-success-header">
                    <div class="careers-success-heading">
                        <h2 class="heading h1 h3_tb h3_mb careers-success-title">
                            <?php echo wp_kses_post($careers_success_title); ?>
                        </h2>
                    </div>
                </div>

                <!-- Floating Stats Card -->
                <div class="careers-success-card-wrap">
                    <div class="careers-success-deco" aria-hidden="true">
                        <img class="mobile" src="<?php echo get_template_directory_uri(); ?>/imgs/icon_deco.svg" alt="">
                        <img class="middle" src="<?php echo get_template_directory_uri(); ?>/imgs/icon_deco_desktop.svg" alt="">
                    </div>
                    <div class="careers-success-card">
                        <div class="careers-success-body">
                            <?php foreach ($careers_success_stats as $stat): 
                                $s_num = !empty($stat['number']) ? $stat['number'] : '';
                                $s_label = !empty($stat['label']) ? $stat['label'] : '';
                            ?>
                                <div class="careers-stat">
                                    <strong class="heading h0 h2_tb careers-stat-num"><?php echo esc_html($s_num); ?></strong>
                                    <span class="txt txt-18 txt-14_tb txt-14_mb txt-med careers-stat-label"><?php echo esc_html($s_label); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="careers-success-card-accent" aria-hidden="true"></div>
                    </div>
                </div>
            </div>

            <!-- Factory Image Background -->
            <div class="careers-success-media">
                <img src="<?php echo esc_url($careers_success_bg_url); ?>" class="img-fill" alt="Double T automated steel manufacturing facility" loading="lazy">
            </div>
        </section>
    </main>

<?php get_footer(); ?>