<?php
get_header();

$post_id = get_the_ID();
$categories = get_the_category($post_id);
$first_cat = !empty($categories) ? $categories[0] : null;
$cat_name = $first_cat ? $first_cat->name : 'Insights';
$cat_link = $first_cat ? get_category_link($first_cat->term_id) : home_url('/insight');

// 1. Hero Data
$hero_title = tr_posts_field('insight_hero_title') ?: get_the_title();
$hero_img_id = tr_posts_field('insight_hero_img');
$hero_img_url = $hero_img_id ? wp_get_attachment_image_url($hero_img_id, 'full') : (get_the_post_thumbnail_url($post_id, 'full') ?: get_template_directory_uri() . '/imgs/hero-img.jpg');

// 2. Share URLs
$post_url = get_permalink($post_id);
$post_title_encoded = urlencode(get_the_title());
$post_url_encoded = urlencode($post_url);
$fb_share_url = "https://www.facebook.com/sharer/sharer.php?u={$post_url_encoded}";
$twitter_share_url = "https://twitter.com/intent/tweet?url={$post_url_encoded}&text={$post_title_encoded}";
$instagram_url = tr_options_field('theme_options.instagram_url') ?: 'https://www.instagram.com';

// 3. Featured Image & Sapo
$featured_img_id = tr_posts_field('insight_featured_img');
$featured_img_url = $featured_img_id ? wp_get_attachment_image_url($featured_img_id, 'full') : (get_the_post_thumbnail_url($post_id, 'full') ?: get_template_directory_uri() . '/imgs/service-item1.jpg');
$sapo = tr_posts_field('insight_sapo') ?: (has_excerpt() ? get_the_excerpt() : 'Lorem ipsum dolor sit amet consectetur. Tortor suspendisse pharetra bibendum velit.');

// 4. Sections & TOC
$sections = tr_posts_field('insight_sections');
$has_custom_sections = (is_array($sections) && !empty($sections));

// Fallback to demo content if no repeater sections and post content is empty
$has_wp_content = !empty(trim(get_the_content(null, false, $post_id)));

if (!$has_custom_sections && !$has_wp_content) {
    $sections = [
        [
            'title' => 'Massa iaculis feugiat nisi mauris maecenas molestie mi elit elit.',
            'content' => '<p class="txt txt-16 txt-14_mb detail-p">Lorem ipsum dolor sit amet consectetur. Non orci vel nibh leo amet scelerisque. Venenatis sit vel tellus amet facilisi elit sit sit. Dolor feugiat vitae gravida scelerisque elementum feugiat. Nisl ut nulla dolor ut aenean feugiat. Ullamcorper at eget egestas dolor a nisl elementum. Dignissim lorem diam at feugiat cursus. Sit pulvinar dolor viverra pretium.</p><p class="txt txt-16 txt-14_mb detail-p">Amet aenean sed feugiat dictumst ac tristique. Integer id vulputate arcu dictum adipiscing diam. Nunc risus pellentesque ac in diam. Sagittis ultrices lectus sed sit et. Enim nulla sed tellus eget dolor cursus id.</p>',
            'image' => '',
            'default_image' => get_template_directory_uri() . '/imgs/commit-intro.jpg',
            'caption' => 'Figure 1: High-precision slitting line automated manufacturing at Double T facility.',
            'headline_after' => 'Lorem ipsum dolor sit amet consectetur. Tortor suspendisse pharetra bibendum velit.'
        ],
        [
            'title' => 'Massa iaculis feugiat nisi mauris maecenas molestie mi elit elit.',
            'content' => '<p class="txt txt-16 txt-14_mb detail-p">Lorem ipsum dolor sit amet consectetur. Non orci vel nibh leo amet scelerisque. Venenatis sit vel tellus amet facilisi elit sit sit. Dolor feugiat vitae gravida scelerisque elementum feugiat. Nisl ut nulla dolor ut aenean feugiat. Ullamcorper at eget egestas dolor a nisl elementum. Dignissim lorem diam at feugiat cursus. Sit pulvinar dolor viverra pretium.</p><p class="txt txt-16 txt-14_mb detail-p">Amet aenean sed feugiat dictumst ac tristique. Integer id vulputate arcu dictum adipiscing diam. Nunc risus pellentesque ac in diam. Sagittis ultrices lectus sed sit et. Enim nulla sed tellus eget dolor cursus id.</p>',
            'image' => '',
            'default_image' => '',
            'caption' => '',
            'headline_after' => ''
        ]
    ];
}

// 5. Prev / Next Navigation
$prev_post = get_previous_post();
$next_post = get_next_post();

// 6. Related Posts Query
$related_args = [
    'post_type' => 'post',
    'posts_per_page' => 6,
    'post__not_in' => [$post_id],
    'post_status' => 'publish'
];
if ($first_cat) {
    $related_args['cat'] = $first_cat->term_id;
}
$related_query = new WP_Query($related_args);
?>

<main class="main default-single-page" data-namespace="singlePost">
    <!-- 1. Hero Section -->
    <section class="detail-hero" aria-labelledby="detailHeroTitle">
        <div class="detail-hero-inner">
            <div class="detail-hero-panel hero-enter-item hero-enter-panel">
                <div class="container detail-hero-container">
                    <nav class="detail-breadcrumb txt txt-14 txt-14_tb txt-14_mb" aria-label="Breadcrumb">
                        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                        <span class="detail-breadcrumb-devi" aria-hidden="true">/</span>
                        <a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a>
                        <span class="detail-breadcrumb-devi" aria-hidden="true">/</span>
                        <span class="current"><?php echo esc_html(get_the_title()); ?></span>
                    </nav>
                    <h1 class="heading h2 h2_tb h3_mb detail-hero-title" id="detailHeroTitle">
                        <?php echo wp_kses_post($hero_title); ?>
                    </h1>
                </div>
            </div>
            <div class="detail-hero-media hero-enter-item">
                <img src="<?php echo esc_url($hero_img_url); ?>" class="img-fill" alt="<?php echo esc_attr(get_the_title()); ?>">
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         2. Main Article Section (3-Column Layout: Share | Article | TOC)
         ========================================================================== -->
    <section class="detail-main-section page-first-section-reveal reveal-ready">
        <div class="container detail-container">
            <div class="detail-layout">

                <!-- Column 1: Sticky Social Share Bar -->
                <aside class="detail-share-col" aria-label="Share this article">
                    <div class="detail-share-sticky">
                        <span class="txt txt-13 txt-semi detail-share-label">Share</span>
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
                    </div>
                </aside>

                <!-- Column 2: Main Article Body -->
                <article class="detail-article-col" id="articleBody">
                    <!-- Featured Article Hero Image -->
                    <div class="detail-featured-img-wrap desktop">
                        <img src="<?php echo esc_url($featured_img_url); ?>" id="detailFeaturedImg" class="img-fill"
                            alt="<?php echo esc_attr(get_the_title()); ?>" loading="eager">
                    </div>

                    <!-- Article Intro Title & Excerpt -->
                    <?php if (!empty($sapo)): ?>
                    <header class="detail-article-header">
                        <h2 class="heading h3 h4_tb h4_mb detail-article-headline">
                            <?php echo wp_kses_post($sapo); ?>
                        </h2>
                    </header>
                    <?php endif; ?>

                    <!-- Article Rich Content Blocks -->
                    <div class="detail-article-content">
                        <?php if (!empty($sections)): 
                            foreach ($sections as $s_idx => $sec): 
                                $sec_id = 'section-' . ($s_idx + 1);
                                $sec_title = !empty($sec['title']) ? $sec['title'] : '';
                                $sec_content = !empty($sec['content']) ? $sec['content'] : '';
                                $sec_img_id = !empty($sec['image']) ? $sec['image'] : null;
                                $sec_default_img = !empty($sec['default_image']) ? $sec['default_image'] : '';
                                $sec_img_url = $sec_img_id ? wp_get_attachment_image_url($sec_img_id, 'full') : $sec_default_img;
                                $sec_caption = !empty($sec['caption']) ? $sec['caption'] : '';
                                $headline_after = !empty($sec['headline_after']) ? $sec['headline_after'] : '';
                        ?>
                            <!-- Section <?php echo ($s_idx + 1); ?> -->
                            <section class="detail-section" id="<?php echo esc_attr($sec_id); ?>"
                                data-toc-title="<?php echo esc_attr($sec_title); ?>">
                                <?php if (!empty($sec_title)): ?>
                                    <h3 class="heading h4 h6_tb detail-section-title">
                                        <?php echo esc_html($sec_title); ?>
                                    </h3>
                                <?php endif; ?>

                                <?php echo wp_kses_post($sec_content); ?>

                                <?php if (!empty($sec_img_url)): ?>
                                    <figure class="detail-inline-figure">
                                        <div class="detail-inline-img cut-tl">
                                            <img src="<?php echo esc_url($sec_img_url); ?>" class="img-fill"
                                                alt="<?php echo esc_attr($sec_caption ?: $sec_title); ?>" loading="lazy">
                                        </div>
                                        <?php if (!empty($sec_caption)): ?>
                                            <figcaption class="txt txt-13 detail-caption">
                                                <?php echo esc_html($sec_caption); ?>
                                            </figcaption>
                                        <?php endif; ?>
                                    </figure>
                                <?php endif; ?>
                            </section>

                            <?php if (!empty($headline_after)): ?>
                                <header class="detail-article-header">
                                    <h2 class="heading h3 h4_tb h4_mb detail-article-headline">
                                        <?php echo wp_kses_post($headline_after); ?>
                                    </h2>
                                </header>
                            <?php endif; ?>

                        <?php endforeach; 
                        elseif ($has_wp_content): ?>
                            <div class="detail-wp-content">
                                <?php the_content(); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Article Navigation (Previous / Next Article) -->
                    <nav class="detail-article-nav middle" aria-label="Article navigation">
                        <!-- Previous Article -->
                        <?php if ($prev_post): ?>
                            <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="detail-nav-item detail-nav-prev" id="navPrevPost">
                                <div class="detail-nav-label">
                                    <svg class="detail-nav-arrow" viewBox="0 0 8 12" aria-hidden="true">
                                        <path d="M6.5 1.5L2 6l4.5 4.5" />
                                    </svg>
                                    <span class="txt txt-13 txt-semi detail-nav-tag">PREVIOUS</span>
                                </div>
                                <p class="txt h6 heading txt-14_mb txt-semi detail-nav-title" id="navPrevTitle">
                                    <?php echo esc_html(get_the_title($prev_post)); ?>
                                </p>
                            </a>
                        <?php else: ?>
                            <div class="detail-nav-item detail-nav-prev disabled" style="opacity: 0.5;">
                                <div class="detail-nav-label">
                                    <svg class="detail-nav-arrow" viewBox="0 0 8 12" aria-hidden="true">
                                        <path d="M6.5 1.5L2 6l4.5 4.5" />
                                    </svg>
                                    <span class="txt txt-13 txt-semi detail-nav-tag">PREVIOUS</span>
                                </div>
                                <p class="txt h6 heading txt-14_mb txt-semi detail-nav-title">
                                    First Article
                                </p>
                            </div>
                        <?php endif; ?>

                        <!-- Next Article -->
                        <?php if ($next_post): ?>
                            <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="detail-nav-item detail-nav-next" id="navNextPost">
                                <div class="detail-nav-label">
                                    <span class="txt txt-13 txt-semi detail-nav-tag">NEXT</span>
                                    <svg class="detail-nav-arrow" viewBox="0 0 8 12" aria-hidden="true">
                                        <path d="M1.5 1.5L6 6 1.5 10.5" />
                                    </svg>
                                </div>
                                <p class="txt h6 heading txt-14_mb txt-semi detail-nav-title" id="navNextTitle">
                                    <?php echo esc_html(get_the_title($next_post)); ?>
                                </p>
                            </a>
                        <?php else: ?>
                            <div class="detail-nav-item detail-nav-next disabled" style="opacity: 0.5;">
                                <div class="detail-nav-label">
                                    <span class="txt txt-13 txt-semi detail-nav-tag">NEXT</span>
                                    <svg class="detail-nav-arrow" viewBox="0 0 8 12" aria-hidden="true">
                                        <path d="M1.5 1.5L6 6 1.5 10.5" />
                                    </svg>
                                </div>
                                <p class="txt h6 heading txt-14_mb txt-semi detail-nav-title">
                                    Latest Article
                                </p>
                            </div>
                        <?php endif; ?>
                    </nav>
                </article>

                <!-- Column 3: Sticky Table of Contents -->
                <aside class="detail-toc-col" aria-label="Table of contents">
                    <div class="detail-toc-sticky">
                        <div class="detail-toc-card cut-tl cut-br" id="tocCard">
                            <!-- Top-Left Chamfer Border Line -->
                            <div class="detail-toc-corner-line" aria-hidden="true"></div>

                            <!-- Header: Icon + "CONTENTS" -->
                            <div class="detail-toc-head">
                                <svg class="detail-toc-icon" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <circle cx="3" cy="5" r="1.5" />
                                    <rect x="7" y="4" width="10" height="2" rx="1" />
                                    <circle cx="3" cy="10" r="1.5" />
                                    <rect x="7" y="9" width="10" height="2" rx="1" />
                                    <circle cx="3" cy="15" r="1.5" />
                                    <rect x="7" y="14" width="10" height="2" rx="1" />
                                </svg>
                                <h2 class="txt h6 heading txt-14_tb txt-bold detail-toc-title">CONTENTS</h2>
                            </div>

                            <!-- TOC Navigation Links -->
                            <nav class="detail-toc-nav" id="tocNav">
                                <ul class="detail-toc-list">
                                    <?php if (!empty($sections)): 
                                        foreach ($sections as $t_idx => $t_sec):
                                            $t_id = 'section-' . ($t_idx + 1);
                                            $t_title = !empty($t_sec['title']) ? $t_sec['title'] : ('Section ' . ($t_idx + 1));
                                            $is_first = ($t_idx === 0);
                                    ?>
                                        <li class="detail-toc-item">
                                            <a href="#<?php echo esc_attr($t_id); ?>" 
                                               class="txt txt-14 txt-med detail-toc-link <?php echo $is_first ? 'active' : ''; ?>"
                                               data-target="<?php echo esc_attr($t_id); ?>">
                                                <?php echo esc_html($t_title); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; 
                                    else: ?>
                                        <li class="detail-toc-item">
                                            <a href="#articleBody" class="txt txt-14 txt-med detail-toc-link active" data-target="articleBody">
                                                Overview
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>

                            <!-- Bottom-Right Red Corner Accent Triangle -->
                            <div class="detail-toc-accent" aria-hidden="true"></div>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </section>

    <!-- 3. Related Articles Section -->
    <section class="detail-related-section" aria-labelledby="relatedSectionTag">
        <div class="container">
            <!-- Category Header Bar -->
            <div class="detail-related-bar">
                <div class="detail-related-tag cut-tl" id="relatedSectionTag">
                    <span class="txt txt-16 txt-14_tb txt-semi detail-related-tag-text">RELATED ARTICLES</span>
                </div>
                <a href="<?php echo esc_url($cat_link); ?>" class="detail-related-viewall"
                    aria-label="View all related articles">
                    <span class="txt txt-14 txt-semi detail-related-viewall-text">VIEW ALL</span>
                    <svg class="detail-related-viewall-icon" viewBox="0 0 8 12" aria-hidden="true">
                        <path d="M1.5 1.5L6 6L1.5 10.5" />
                    </svg>
                </a>
            </div>

            <div class="detail-related-wrap">
                <div class="detail-related-grid swiper" id="relatedArticlesGrid">
                    <div class="detail-related-grid-wrap swiper-wrapper">
                        <?php if ($related_query->have_posts()): 
                            while ($related_query->have_posts()): $related_query->the_post(); 
                                $r_thumb = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: get_template_directory_uri() . '/imgs/product.jpg';
                        ?>
                            <article class="detail-related-item swiper-slide">
                                <a href="<?php echo esc_url(get_permalink()); ?>" class="detail-related-card hover-img">
                                    <div class="detail-related-img cut-tl">
                                        <img src="<?php echo esc_url($r_thumb); ?>" class="img-fill"
                                            alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
                                    </div>
                                    <div class="detail-related-body">
                                        <h3 class="txt txt-16 txt-14_tb txt-semi detail-related-title">
                                            <?php echo esc_html(get_the_title()); ?>
                                        </h3>
                                    </div>
                                </a>
                            </article>
                        <?php endwhile; wp_reset_postdata(); 
                        else: 
                            // Demo fallback items
                            $demo_related = [
                                ['title' => 'Latest Trends Shaping the Global Steel Market', 'img' => get_template_directory_uri() . '/imgs/product.jpg'],
                                ['title' => 'Latest Trends Shaping the Global Steel Market', 'img' => get_template_directory_uri() . '/imgs/product.jpg'],
                                ['title' => 'Latest Trends Shaping the Global Steel Market', 'img' => get_template_directory_uri() . '/imgs/product.jpg'],
                                ['title' => 'Steel Market Outlook and Emerging Industry Trends', 'img' => get_template_directory_uri() . '/imgs/video-thumb.jpg'],
                                ['title' => 'Key Developments Across the Global Steel Industry', 'img' => get_template_directory_uri() . '/imgs/cta.jpg'],
                                ['title' => 'Key Developments Across the Global Steel Industry', 'img' => get_template_directory_uri() . '/imgs/cta.jpg']
                            ];
                            foreach ($demo_related as $d_rel):
                        ?>
                            <article class="detail-related-item swiper-slide">
                                <a href="<?php echo esc_url($cat_link); ?>" class="detail-related-card hover-img">
                                    <div class="detail-related-img cut-tl">
                                        <img src="<?php echo esc_url($d_rel['img']); ?>" class="img-fill"
                                            alt="<?php echo esc_attr($d_rel['title']); ?>" loading="lazy">
                                    </div>
                                    <div class="detail-related-body">
                                        <h3 class="txt txt-16 txt-14_tb txt-semi detail-related-title">
                                            <?php echo esc_html($d_rel['title']); ?>
                                        </h3>
                                    </div>
                                </a>
                            </article>
                        <?php endforeach; 
                        endif; ?>
                    </div>
                </div>
                <button class="psd-other-nav middle psd-other-prev cut-diagonal cut-sm" id="psdOtherPrev"
                    aria-label="Previous products">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M7.5 2.5L4 6L7.5 9.5" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <button class="psd-other-nav middle psd-other-next cut-diagonal cut-sm" id="psdOtherNext"
                    aria-label="Next products">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M4.5 2.5L8 6L4.5 9.5" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Copy Toast Notification -->
    <div class="detail-toast" id="copyToast" role="alert" aria-live="polite" aria-hidden="true">
        <span class="detail-toast-text">Link copied to clipboard!</span>
    </div>
</main>

<?php get_footer(); ?>
