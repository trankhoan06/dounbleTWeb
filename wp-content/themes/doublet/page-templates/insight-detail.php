<?php
/**
 * Template Name: Insight Detail
 */
get_header(); ?>



    <main class="main" id="mainContent">
        <section class="detail-hero" aria-labelledby="detailHeroTitle">
            <div class="detail-hero-inner">
                <div class="detail-hero-panel">
                    <div class="container detail-hero-container">
                        <nav class="detail-breadcrumb txt txt-14 txt-14_tb txt-14_mb" aria-label="Breadcrumb">
                            <a href="./index.html">Home</a>
                            <span class="detail-breadcrumb-devi" aria-hidden="true">/</span>
                            <span class="current">global steel market UPDATES AND INDUSTRY INSIGHTS</span>
                        </nav>
                        <h1 class="heading h2 h2_tb h3_mb detail-hero-title" id="detailHeroTitle">
                            GLOBAL STEEL MARKET UPDATES AND INDUSTRY INSIGHTS
                        </h1>
                    </div>
                </div>
                <div class="detail-hero-media">
                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/hero-img.jpg" class="img-fill" alt="Double T steel processing plant">
                </div>
            </div>
        </section>

        <!-- ==========================================================================
             2. Main Article Section (3-Column Layout: Share | Article | TOC)
             ========================================================================== -->
        <section class="detail-main-section">
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
                                <a href="https://www.facebook.com/sharer/sharer.php" target="_blank"
                                    rel="noopener noreferrer" class="detail-share-btn cut-diagonal"
                                    aria-label="Share on Facebook" title="Facebook">
                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                    </svg>
                                </a>
                                <!-- 3. Instagram -->
                                <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer"
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
                                <a href="https://twitter.com/intent/tweet" target="_blank" rel="noopener noreferrer"
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
                            <img src="<?php echo get_template_directory_uri(); ?>/imgs/service-item1.jpg" id="detailFeaturedImg" class="img-fill"
                                alt="Modern automated steel manufacturing facility" loading="eager">
                        </div>

                        <!-- Article Intro Title & Excerpt -->
                        <header class="detail-article-header">
                            <h2 class="heading h3 h4_tb h4_mb detail-article-headline">
                                Lorem ipsum dolor sit amet consectetur. Tortor suspendisse pharetra bibendum velit.
                            </h2>
                        </header>

                        <!-- Article Rich Content Blocks -->
                        <div class="detail-article-content">
                            <!-- Section 1 -->
                            <section class="detail-section" id="section-1"
                                data-toc-title="Massa iaculis feugiat nisi mauris maecenas molestie mi elit elit.">
                                <h3 class="heading h4 h6_tb detail-section-title">
                                    Massa iaculis feugiat nisi mauris maecenas molestie mi elit elit.
                                </h3>
                                <p class="txt txt-16 txt-14_mb detail-p">
                                    Lorem ipsum dolor sit amet consectetur. Non orci vel nibh leo amet scelerisque.
                                    Venenatis sit vel tellus amet facilisi elit sit sit. Dolor feugiat vitae gravida
                                    scelerisque elementum feugiat. Nisl ut nulla dolor ut aenean feugiat. Ullamcorper at
                                    eget egestas dolor a nisl elementum. Dignissim lorem diam at feugiat cursus. Sit
                                    pulvinar dolor viverra pretium.
                                </p>
                                <p class="txt txt-16 txt-14_mb detail-p">
                                    Amet aenean sed feugiat dictumst ac tristique. Integer id vulputate arcu dictum
                                    adipiscing diam. Nunc risus pellentesque ac in diam. Sagittis ultrices lectus sed
                                    sit et. Enim nulla sed tellus eget dolor cursus id.
                                </p>
                                <figure class="detail-inline-figure">
                                    <div class="detail-inline-img cut-tl">
                                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/commit-intro.jpg" class="img-fill"
                                            alt="Precision coil processing line in operation" loading="lazy">
                                    </div>
                                    <figcaption class="txt txt-13 detail-caption">
                                        Figure 1: High-precision slitting line automated manufacturing at Double T
                                        facility.
                                    </figcaption>
                                </figure>
                            </section>
                            <header class="detail-article-header">
                                <h2 class="heading h3 h4_tb h4_mb detail-article-headline">
                                    Lorem ipsum dolor sit amet consectetur. Tortor suspendisse pharetra bibendum velit.
                                </h2>
                            </header>
                            <section class="detail-section" id="section-2"
                                data-toc-title="Massa iaculis feugiat nisi mauris maecenas molestie mi elit elit.">
                                <h3 class="heading h4 h6_tb detail-section-title">
                                    Massa iaculis feugiat nisi mauris maecenas molestie mi elit elit.
                                </h3>
                                <p class="txt txt-16 txt-14_mb detail-p">
                                    Lorem ipsum dolor sit amet consectetur. Non orci vel nibh leo amet scelerisque.
                                    Venenatis sit vel tellus amet facilisi elit sit sit. Dolor feugiat vitae gravida
                                    scelerisque elementum feugiat. Nisl ut nulla dolor ut aenean feugiat. Ullamcorper at
                                    eget egestas dolor a nisl elementum. Dignissim lorem diam at feugiat cursus. Sit
                                    pulvinar dolor viverra pretium.
                                </p>
                                <p class="txt txt-16 txt-14_mb detail-p">
                                    Amet aenean sed feugiat dictumst ac tristique. Integer id vulputate arcu dictum
                                    adipiscing diam. Nunc risus pellentesque ac in diam. Sagittis ultrices lectus sed
                                    sit et. Enim nulla sed tellus eget dolor cursus id.
                                </p>
                            </section>


                        </div>

                        <!-- Article Navigation (Previous / Next Article) -->
                        <nav class="detail-article-nav middle" aria-label="Article navigation">
                            <!-- Previous Article -->
                            <a href="./insight-detail.html?id=1" class="detail-nav-item detail-nav-prev"
                                id="navPrevPost">
                                <div class="detail-nav-label">
                                    <svg class="detail-nav-arrow" viewBox="0 0 8 12" aria-hidden="true">
                                        <path d="M6.5 1.5L2 6l4.5 4.5" />
                                    </svg>
                                    <span class="txt txt-13 txt-semi detail-nav-tag">PREVIOUS</span>
                                </div>
                                <p class="txt h6 heading txt-14_mb txt-semi detail-nav-title" id="navPrevTitle">
                                    Deliver seamless experiences across all channels and gain valuable insights.
                                </p>
                            </a>

                            <!-- Next Article -->
                            <a href="./insight-detail.html?id=3" class="detail-nav-item detail-nav-next"
                                id="navNextPost">
                                <div class="detail-nav-label">
                                    <span class="txt txt-13 txt-semi detail-nav-tag">NEXT</span>
                                    <svg class="detail-nav-arrow" viewBox="0 0 8 12" aria-hidden="true">
                                        <path d="M1.5 1.5L6 6 1.5 10.5" />
                                    </svg>
                                </div>
                                <p class="txt h6 heading txt-14_mb txt-semi detail-nav-title" id="navNextTitle">
                                    Deliver seamless experiences across all channels and gain valuable insights.
                                </p>
                            </a>
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
                                        <li class="detail-toc-item">
                                            <a href="#section-1" class="txt txt-14 txt-med detail-toc-link active"
                                                data-target="section-1">
                                                Massa iaculis feugiat nisi mauris maecenas molestie mi elit elit.
                                            </a>
                                        </li>
                                        <li class="detail-toc-item">
                                            <a href="#section-2" class="txt txt-14 txt-med detail-toc-link"
                                                data-target="section-3">
                                                Massa iaculis feugiat nisi mauris maecenas molestie mi elit elit.
                                            </a>
                                        </li>
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

        <section class="detail-related-section" aria-labelledby="relatedSectionTag">
            <div class="container">
                <!-- Category Header Bar -->
                <div class="detail-related-bar">
                    <div class="detail-related-tag cut-tl" id="relatedSectionTag">
                        <span class="txt txt-16 txt-14_tb txt-semi detail-related-tag-text">RELATED ARTICLES</span>
                    </div>
                    <a href="./insight-category.html?category=market-news" class="detail-related-viewall"
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
                            <article class="detail-related-item swiper-slide">
                                <a href="./insight-detail.html?id=3" class="detail-related-card hover-img">
                                    <div class="detail-related-img cut-tl">
                                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/product.jpg" class="img-fill"
                                            alt="Latest Trends Shaping the Global Steel Market" loading="lazy">
                                    </div>
                                    <div class="detail-related-body">
                                        <h3 class="txt txt-16 txt-14_tb h6_mb txt-semi detail-related-title">
                                            Latest Trends Shaping the Global Steel Market
                                        </h3>
                                    </div>
                                </a>
                            </article>
                            <article class="detail-related-item swiper-slide">
                                <a href="./insight-detail.html?id=3" class="detail-related-card hover-img">
                                    <div class="detail-related-img cut-tl">
                                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/product.jpg" class="img-fill"
                                            alt="Latest Trends Shaping the Global Steel Market" loading="lazy">
                                    </div>
                                    <div class="detail-related-body">
                                        <h3 class="txt txt-16 txt-14_tb txt-semi detail-related-title">
                                            Latest Trends Shaping the Global Steel Market
                                        </h3>
                                    </div>
                                </a>
                            </article>
                            <article class="detail-related-item swiper-slide">
                                <a href="./insight-detail.html?id=3" class="detail-related-card hover-img">
                                    <div class="detail-related-img cut-tl">
                                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/product.jpg" class="img-fill"
                                            alt="Latest Trends Shaping the Global Steel Market" loading="lazy">
                                    </div>
                                    <div class="detail-related-body">
                                        <h3 class="txt txt-16 txt-14_tb txt-semi detail-related-title">
                                            Latest Trends Shaping the Global Steel Market
                                        </h3>
                                    </div>
                                </a>
                            </article>

                            <article class="detail-related-item swiper-slide">
                                <a href="./insight-detail.html?id=4" class="detail-related-card hover-img">
                                    <div class="detail-related-img cut-tl">
                                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/video-thumb.jpg" class="img-fill"
                                            alt="Steel Market Outlook and Emerging Industry Trends" loading="lazy">
                                    </div>
                                    <div class="detail-related-body">
                                        <h3 class="txt txt-16 txt-14_tb txt-semi detail-related-title">
                                            Steel Market Outlook and Emerging Industry Trends
                                        </h3>
                                    </div>
                                </a>
                            </article>

                            <article class="detail-related-item swiper-slide">
                                <a href="./insight-detail.html?id=5" class="detail-related-card hover-img">
                                    <div class="detail-related-img cut-tl">
                                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/cta.jpg" class="img-fill"
                                            alt="Key Developments Across the Global Steel Industry" loading="lazy">
                                    </div>
                                    <div class="detail-related-body">
                                        <h3 class="txt txt-16 txt-14_tb txt-semi detail-related-title">
                                            Key Developments Across the Global Steel Industry
                                        </h3>
                                    </div>
                                </a>
                            </article>
                            <article class="detail-related-item swiper-slide">
                                <a href="./insight-detail.html?id=5" class="detail-related-card hover-img">
                                    <div class="detail-related-img cut-tl">
                                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/cta.jpg" class="img-fill"
                                            alt="Key Developments Across the Global Steel Industry" loading="lazy">
                                    </div>
                                    <div class="detail-related-body">
                                        <h3 class="txt txt-16 txt-14_tb txt-semi detail-related-title">
                                            Key Developments Across the Global Steel Industry
                                        </h3>
                                    </div>
                                </a>
                            </article>
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

    </main>

    
<?php get_footer(); ?>