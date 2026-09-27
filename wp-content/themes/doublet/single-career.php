<?php
get_header();

$post_id = get_the_ID();
$post_url = get_permalink($post_id);
$post_title = get_the_title($post_id) ?: 'Steel Production Engineer';
$post_url_encoded = urlencode($post_url);
$post_title_encoded = urlencode($post_title);

$fb_share_url = "https://www.facebook.com/sharer/sharer.php?u={$post_url_encoded}";
$twitter_share_url = "https://twitter.com/intent/tweet?url={$post_url_encoded}&text={$post_title_encoded}";
$instagram_url = tr_options_field('theme_options.instagram_url') ?: 'https://www.instagram.com';

// 1. Hero Fields
$career_hero_title = tr_posts_field('career_hero_title') ?: ($post_title !== 'Auto Draft' ? strtoupper($post_title) : 'STEEL PRODUCTION ENGINEER');
$career_hero_breadcrumb = tr_posts_field('career_hero_breadcrumb') ?: ($post_title !== 'Auto Draft' ? $post_title : 'Steel Production Engineer');

// 2. Info Card Fields (Sidebar)
$career_salary = tr_posts_field('career_salary') ?: 'Negotiate';
$career_experience = tr_posts_field('career_experience') ?: '2 Years';
$career_quantity = tr_posts_field('career_quantity') ?: '02';
$career_deadline = tr_posts_field('career_deadline') ?: '20/10/2026';

// 3. Details Content
$career_obj_title = tr_posts_field('career_obj_title') ?: 'Job Objective';
$career_obj_desc = tr_posts_field('career_obj_desc') ?: 'Lorem ipsum dolor sit amet consectetur. Sed pharetra nullam mauris in facilisi sagittis. Lorem eget ac turpis pellentesque ultricies eu dictum eu id. Convallis in nibh vitae mus neque mauris. Tristique id penatibus habitant non curabitur urna. Senectus eget quam blandit praesent est porta euismod nunc. Dignissim ut tincidunt feugiat enim id. Placerat et lacus commodo in velit blandit mattis ultrices sit. Lectus vulputate lacus lectus sit. Morbi commodo malesuada a sagittis sit blandit amet eget.';

$career_resp_title = tr_posts_field('career_resp_title') ?: 'Key Responsibilities';
$career_resp_content = tr_posts_field('career_resp_content') ?: '<ul class="txt txt-16 txt-14_tb txt-14_mb">
    <li>Lorem ipsum dolor sit amet consectetur. Ac sit nulla velit justo erat sit id. Dui quisque nec massa sed. Posuere aenean enim maecenas est ac quis egestas integer. Metus eu massa enim amet porta dictum id ut. Vestibulum platea pulvinar libero arcu neque. Eu suspendisse sit duis tortor sed dapibus.</li>
    <li>Ornare diam aliquam aliquet sit. Id placerat vitae in habitant tincidunt amet ultricies convallis in. Ut non sollicitudin eget eu interdum tristique tortor purus. Pulvinar sit gravida egestas molestie. Lobortis sed in massa vulputate tristique duis. Phasellus elit et bibendum porta imperdiet scelerisque ornare sem.</li>
    <li>Lorem ipsum dolor sit amet consectetur. Ac sit nulla velit justo erat sit id. Dui quisque nec massa sed. Posuere aenean enim maecenas est ac quis egestas integer. Metus eu massa enim amet porta dictum id ut. Vestibulum platea pulvinar libero arcu neque. Eu suspendisse sit duis tortor sed dapibus.</li>
</ul>';

$career_req_title = tr_posts_field('career_req_title') ?: 'Job Requirements';
$career_req_content = tr_posts_field('career_req_content') ?: '<ul class="txt txt-16 txt-14_tb txt-14_mb">
    <li>Lorem ipsum dolor sit amet consectetur. Odio gravida magna semper fames ut rutrum platea vitae. Auctor condimentum vulputate sit enim dictum cursus. Laoreet non interdum risus faucibus venenatis et. Velit ultrices tortor tortor pretium pulvinar in sit viverra. Praesent mollis vitae leo dolor.</li>
    <li>Scelerisque nibh lobortis lacinia urna mi elit libero. Habitasse sit aliquam lorem quisque. Nibh lacinia sodales commodo cum consequat vestibulum.</li>
    <li>Ornare diam aliquam aliquet sit. Id placerat vitae in habitant tincidunt amet ultricies convallis in. Ut non sollicitudin eget eu interdum tristique tortor purus. Pulvinar sit gravida egestas molestie. Lobortis sed in massa vulputate tristique duis. Phasellus elit et bibendum porta imperdiet scelerisque ornare sem.</li>
</ul>';

$career_prior_title = tr_posts_field('career_prior_title') ?: 'Prioritize';
$career_prior_content = tr_posts_field('career_prior_content') ?: '<ul class="txt txt-16 txt-14_tb txt-14_mb">
    <li>Lorem ipsum dolor sit amet consectetur. Ut pellentesque pellentesque magna neque consequat. Ligula leo ipsum libero vel proin mi. Rhoncus quis et vitae in vel metus phasellus gravida gravida. Egestas donec interdum posuere ultricies feugiat ornare. Ac est dui habitant tellus justo.</li>
    <li>Lorem ipsum dolor sit amet consectetur. Ut pellentesque pellentesque magna neque consequat. Ligula leo ipsum libero vel proin mi. Rhoncus quis et vitae in vel metus phasellus gravida gravida. Egestas donec interdum posuere ultricies feugiat ornare. Ac est dui habitant tellus justo.</li>
</ul>';

$career_ben_title = tr_posts_field('career_ben_title') ?: 'Benefit';
$career_ben_content = tr_posts_field('career_ben_content') ?: '<ul class="txt txt-16 txt-14_tb txt-14_mb">
    <li>Lorem ipsum dolor sit amet consectetur. Arcu ac et in quis ornare ac. Neque vel eu ultricies egestas hendrerit nisl morbi. Aliquam tortor dolor nam vitae. Id nec varius vitae dolor tellus fringilla interdum gravida convallis. Dictumst vel fames ultricies elementum sit. Ligula sed at sed blandit molestie dolor eu eu.</li>
    <li>Placerat viverra porta vel hac justo in in in. Vulputate vestibulum nibh pharetra tempor. Suspendisse elementum nunc id sodales. Et id odio tempor purus. Quis ornare gravida mattis lacus nisl nec habitasse.</li>
    <li>Lorem ipsum dolor sit amet consectetur. Arcu ac et in quis ornare ac. Neque vel eu ultricies egestas hendrerit nisl morbi. Aliquam tortor dolor nam vitae. Id nec varius vitae dolor tellus fringilla interdum gravida convallis. Dictumst vel fames ultricies elementum sit. Ligula sed at sed blandit molestie dolor eu eu.</li>
</ul>';
?>

<main class="main default-single-page" data-namespace="singlePost">
    <!-- Hero Section -->
    <section class="career-detail-hero">
        <div class="container">
            <div class="career-detail-hero-content">
                <nav class="career-detail-breadcrumb txt txt-14 txt-14_tb txt-14_mb" aria-label="Breadcrumb">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    <span class="career-detail-breadcrumb-sep">/</span>
                    <a href="<?php echo esc_url(home_url('/careers')); ?>">Careers</a>
                    <span class="career-detail-breadcrumb-sep">/</span>
                    <span class="career-detail-breadcrumb-current"><?php echo esc_html($career_hero_breadcrumb); ?></span>
                </nav>
                <h1 class="heading h1 h2_tb h3_mb career-detail-hero-title"><?php echo esc_html($career_hero_title); ?></h1>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="career-detail-main">
        <div class="container">
            <div class="career-detail-grid">

                <!-- Left Sidebar: Share -->
                <aside class="career-detail-share">
                    <span class="txt txt-14 txt-semi career-detail-share-title">Share</span>
                    <div class="detail-share-list">
                        <!-- 1. Copy Link -->
                        <button type="button" class="detail-share-btn cut-diagonal" id="btnCopyLink"
                            aria-label="Copy link to clipboard" title="Copy Link">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                            </svg>
                        </button>
                        <!-- 2. Facebook -->
                        <a href="<?php echo esc_url($fb_share_url); ?>" target="_blank"
                            rel="noopener noreferrer" class="detail-share-btn cut-diagonal"
                            aria-label="Share on Facebook" title="Facebook">
                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                            </svg>
                        </a>
                        <!-- 3. Instagram -->
                        <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" rel="noopener noreferrer"
                            class="detail-share-btn cut-diagonal" aria-label="Follow Double T on Instagram"
                            title="Instagram">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                            </svg>
                        </a>
                        <!-- 4. X (Twitter) -->
                        <a href="<?php echo esc_url($twitter_share_url); ?>" target="_blank" rel="noopener noreferrer"
                            class="detail-share-btn cut-diagonal" aria-label="Share on X" title="X (Twitter)">
                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                            </svg>
                        </a>
                    </div>
                </aside>

                <!-- Center Content -->
                <div class="career-detail-content">
                    <!-- Objective -->
                    <?php if (!empty($career_obj_desc)): ?>
                    <div class="career-content-block">
                        <h2 class="heading h4 career-detail-section-title"><?php echo esc_html($career_obj_title); ?></h2>
                        <p class="txt txt-16 txt-14_tb txt-14_mb">
                            <?php echo wp_kses_post(nl2br($career_obj_desc)); ?>
                        </p>
                    </div>
                    <?php endif; ?>

                    <!-- Responsibilities -->
                    <?php if (!empty($career_resp_content)): ?>
                    <div class="career-content-block">
                        <h2 class="heading h4 career-detail-section-title"><?php echo esc_html($career_resp_title); ?></h2>
                        <?php echo wp_kses_post($career_resp_content); ?>
                    </div>
                    <?php endif; ?>

                    <!-- Requirements -->
                    <?php if (!empty($career_req_content)): ?>
                    <div class="career-content-block">
                        <h2 class="heading h4 career-detail-section-title"><?php echo esc_html($career_req_title); ?></h2>
                        <?php echo wp_kses_post($career_req_content); ?>
                    </div>
                    <?php endif; ?>

                    <!-- Prioritize -->
                    <?php if (!empty($career_prior_content)): ?>
                    <div class="career-content-block">
                        <h2 class="heading h4 career-detail-section-title"><?php echo esc_html($career_prior_title); ?></h2>
                        <?php echo wp_kses_post($career_prior_content); ?>
                    </div>
                    <?php endif; ?>

                    <!-- Benefit -->
                    <?php if (!empty($career_ben_content)): ?>
                    <div class="career-content-block">
                        <h2 class="heading h4 career-detail-section-title"><?php echo esc_html($career_ben_title); ?></h2>
                        <?php echo wp_kses_post($career_ben_content); ?>
                    </div>
                    <?php endif; ?>

                    <!-- Apply Form Section -->
                    <div class="career-apply-section" id="apply-form">
                        <h2 class="heading h3 h4_tb h5_mb career-apply-title">Apply for this Position</h2>
                        <form action="#" class="career-apply-form">
                            <div class="form-group">
                                <label class="txt txt-14 form-label">Full name <span class="req">*</span></label>
                                <input type="text" class="form-control" placeholder="Your name" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="txt txt-14 form-label">Email <span class="req">*</span></label>
                                    <input type="email" class="form-control" placeholder="Enter your email" required>
                                </div>
                                <div class="form-group">
                                    <label class="txt txt-14 form-label">Phone Number <span class="req">*</span></label>
                                    <input type="tel" class="form-control" placeholder="Enter your phone number" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="txt txt-14 form-label">Upload CV <span class="req">*</span></label>
                                <div class="upload-area" id="cv-upload-area">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4.35435 30.7084C6.14546 32.4584 8.30491 33.3334 10.8327 33.3334H30.8327C32.916 33.3334 34.6871 32.6045 36.146 31.1467C37.6038 29.6879 38.3327 27.9167 38.3327 25.8334C38.3327 23.9167 37.701 22.2429 36.4377 20.8117C35.1732 19.3817 33.5827 18.5556 31.666 18.3334C31.666 15.0834 30.5338 12.3262 28.2694 10.0617C26.006 7.79841 23.2493 6.66675 19.9993 6.66675C17.3605 6.66675 14.9993 7.45842 12.916 9.04175C10.8327 10.6251 9.44379 12.6945 8.74935 15.2501C6.63824 15.7223 4.9299 16.8056 3.62435 18.5001C2.31879 20.1945 1.66602 22.1251 1.66602 24.2917C1.66602 26.8195 2.56213 28.9584 4.35435 30.7084ZM13.4031 23.3425L17.9404 23.3426V28.3295H22.1417V23.3426L26.679 23.3427L20.6899 15.9843C20.3565 15.5746 19.731 15.5745 19.3975 15.984L13.4031 23.3425Z"
                                            fill="#0B6F7E" />
                                    </svg>
                                    <input type="file" id="cv-upload-input" accept=".pdf,.doc,.docx"
                                        style="display: none;">
                                    <span class="txt txt-14 upload-text" id="cv-upload-text">Select or drag and drop files to upload</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="txt txt-14 form-label">Introduce yourself <span class="req">*</span></label>
                                <textarea class="form-control" placeholder="Enter message" required></textarea>
                            </div>
                            <div class="form-submit-wrap">
                                <button type="submit" class="btn btn-primary">
                                    <span class="txt txt-14 txt-semi">APPLY NOW</span>
                                </button>
                            </div>
                            <div class="txt txt-13 form-subtext">
                                You will receive a confirmation email, and we will contact you within 5-7 business days if you are a potential candidate.
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Sidebar: Info Card -->
                <aside class="detail-toc-col">
                    <div class="career-detail-info-card">
                        <div class="career-info-item">
                            <span class="txt txt-13 txt-med career-info-label">SALARY</span>
                            <strong class="txt txt-16 txt-med career-info-value"><?php echo esc_html($career_salary); ?></strong>
                        </div>
                        <div class="career-info-item">
                            <span class="txt txt-13 txt-med career-info-label">EXPERIENCE</span>
                            <strong class="txt txt-16 txt-med career-info-value"><?php echo esc_html($career_experience); ?></strong>
                        </div>
                        <div class="career-info-item">
                            <span class="txt txt-13 txt-med career-info-label">QUANTITY</span>
                            <strong class="txt txt-16 txt-med career-info-value"><?php echo esc_html($career_quantity); ?></strong>
                        </div>
                        <div class="career-info-item">
                            <span class="txt txt-13 txt-med career-info-label">DEADLINE</span>
                            <strong class="txt txt-16 txt-med career-info-value"><?php echo esc_html($career_deadline); ?></strong>
                        </div>

                        <a href="#apply-form" class="btn btn-primary">
                            <span class="txt txt-14 txt-semi">APPLY NOW</span>
                        </a>
                    </div>
                </aside>

            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
