<?php
/**
 * Template Name: Insight
 */
get_header(); ?>



    <main class="main" id="mainContent">
        <!-- ==========================================================================
             1. Hero Section (Full width background with bottom-left cut-tr teal card)
             ========================================================================== -->
        <section class="insight-hero" aria-labelledby="insightHeroTitle">
            <div class="insight-hero-bg">
                <img src="<?php echo get_template_directory_uri(); ?>/imgs/commit-vison.jpg" class="img-fill"
                    alt="Double T steel processing manufacturing facility">
            </div>
            <div class="container insight-hero-container">
                <div class="insight-hero-panel">
                    <div class="insight-hero-panel-bg cut-tr"></div>
                    <nav class="insight-breadcrumb txt txt-14 txt-14_tb txt-14_mb" aria-label="Breadcrumb">
                        <a href="./index.html">Home</a>
                        <span class="separator" aria-hidden="true">/</span>
                        <span class="current">Insight</span>
                    </nav>
                    <h1 class="heading h1 h3_mb insight-hero-title" id="insightHeroTitle">
                        NEWS &amp; OPERATIONS
                    </h1>
                </div>
            </div>
        </section>

        <div class="insight-categories" id="insightCategoriesContainer">

            <!-- Category 1: MARKET NEWS -->
            <section class="insight-category" id="market-news" data-category="market-news"
                aria-labelledby="catLabel-market-news">
                <div class="container">
                    <!-- Category Header Bar (Industrial Tag + View All) -->
                    <div class="insight-category-bar">
                        <div class="insight-category-tag cut-tl" id="catLabel-market-news">
                            <span class="txt txt-16 txt-14_tb txt-semi insight-category-tag-text">MARKET NEWS</span>
                        </div>
                        <a href="./insight-category.html?category=market-news" class="insight-view-all"
                            aria-label="View all Market News articles">
                            <span class="txt txt-14 txt-semi insight-view-all-text">VIEW ALL</span>
                            <svg class="insight-view-all-icon" viewBox="0 0 8 12" aria-hidden="true">
                                <path d="M1.5 1.5L6 6L1.5 10.5" />
                            </svg>
                        </a>
                    </div>

                    <!-- Category Articles Grid (1 Featured Post + 4 Sub-posts in 2x2 grid) -->
                    <div class="insight-category-grid">
                        <!-- Featured Article (Left Column) -->
                        <article class="insight-featured-item" data-post-id="1">
                            <a href="./insight-detail.html?id=1" class="insight-featured-card hover-img">
                                <div class="insight-card-img cut-tl">
                                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/product.jpg" class="img-fill" alt="Steel coils warehouse storage"
                                        loading="lazy">
                                </div>
                                <div class="insight-card-body">
                                    <h2 class="heading h4 h5_tb h6_mb insight-card-title">
                                        Lorem ipsum dolor sit amet consectetur. Nisl lobortis porta pharetra aliquam at.
                                    </h2>
                                    <p class="txt txt-14 insight-card-excerpt middle">
                                        Lorem ipsum dolor sit amet consectetur. Sit nam amet tellus gravida risus
                                        tellus. Interdum duis sollicitudin arcu dignissim. Dolor dis mattis sed quam
                                        sagittis massa pulvinar volutpat enim.
                                    </p>
                                </div>
                            </a>
                        </article>

                        <!-- Sub-articles 2x2 Grid (Right Column) -->
                        <div class="insight-subgrid">
                            <!-- Sub-article 1 -->
                            <article class="insight-grid-item" data-post-id="2">
                                <a href="./insight-detail.html?id=2" class="insight-grid-card hover-img">
                                    <div class="insight-card-img cut-tl">
                                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/service-item1.jpg" class="img-fill"
                                            alt="Modern automated steel manufacturing facility" loading="lazy">
                                    </div>
                                    <div class="insight-card-body">
                                        <h3 class="txt h6 heading txt-16_tb txt-semi insight-card-title">
                                            Global Steel Market Updates and Industry Insights
                                        </h3>
                                    </div>
                                </a>
                            </article>

                            <!-- Sub-article 2 -->
                            <article class="insight-grid-item" data-post-id="3">
                                <a href="./insight-detail.html?id=3" class="insight-grid-card hover-img">
                                    <div class="insight-card-img cut-tl">
                                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/application.jpg" class="img-fill"
                                            alt="High quality finished steel coils" loading="lazy">
                                    </div>
                                    <div class="insight-card-body">
                                        <h3 class="txt h6 heading txt-16_tb txt-semi insight-card-title">
                                            Latest Trends Shaping the Global Steel Market
                                        </h3>
                                    </div>
                                </a>
                            </article>

                            <!-- Sub-article 3 -->
                            <article class="insight-grid-item" data-post-id="4">
                                <a href="./insight-detail.html?id=4" class="insight-grid-card hover-img">
                                    <div class="insight-card-img cut-tl">
                                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/video-thumb.jpg" class="img-fill"
                                            alt="Industrial structural steel beams and trusses" loading="lazy">
                                    </div>
                                    <div class="insight-card-body">
                                        <h3 class="txt h6 heading txt-16_tb txt-semi insight-card-title">
                                            Steel Market Outlook and Emerging Industry Trends
                                        </h3>
                                    </div>
                                </a>
                            </article>

                            <!-- Sub-article 4 -->
                            <article class="insight-grid-item" data-post-id="5">
                                <a href="./insight-detail.html?id=5" class="insight-grid-card hover-img">
                                    <div class="insight-card-img cut-tl">
                                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/cta.jpg" class="img-fill"
                                            alt="Infrastructure development and steel application" loading="lazy">
                                    </div>
                                    <div class="insight-card-body">
                                        <h3 class="txt h6 heading txt-16_tb txt-semi insight-card-title">
                                            Key Developments Across the Global Steel Industry
                                        </h3>
                                    </div>
                                </a>
                            </article>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Category 2: COMPANY OPERATIONS -->
            <section class="insight-category" id="company-operations" data-category="company-operations"
                aria-labelledby="catLabel-company-operations">
                <div class="container">
                    <!-- Category Header Bar (Industrial Tag + View All) -->
                    <div class="insight-category-bar">
                        <div class="insight-category-tag cut-tl" id="catLabel-company-operations">
                            <span class="txt txt-16 txt-14_tb txt-semi insight-category-tag-text">COMPANY
                                OPERATIONS</span>
                        </div>
                        <a href="./insight-category.html?category=company-operations" class="insight-view-all"
                            aria-label="View all Company Operations articles">
                            <span class="txt txt-14 txt-semi insight-view-all-text">VIEW ALL</span>
                            <svg class="insight-view-all-icon" viewBox="0 0 8 12" aria-hidden="true">
                                <path d="M1.5 1.5L6 6L1.5 10.5" />
                            </svg>
                        </a>
                    </div>

                    <!-- Category Articles Grid (1 Featured Post + 4 Sub-posts in 2x2 grid) -->
                    <div class="insight-category-grid">
                        <!-- Featured Article (Left Column) -->
                        <article class="insight-featured-item" data-post-id="6">
                            <a href="./insight-detail.html?id=6" class="insight-featured-card hover-img">
                                <div class="insight-card-img cut-tl">
                                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/product.jpg" class="img-fill" alt="Steel coils warehouse storage"
                                        loading="lazy">
                                </div>
                                <div class="insight-card-body">
                                    <h2 class="heading h4 h5_tb insight-card-title h6_mb">
                                        Lorem ipsum dolor sit amet consectetur. Nisl lobortis porta pharetra aliquam at.
                                    </h2>
                                    <p class="txt txt-14 insight-card-excerpt middle">
                                        Lorem ipsum dolor sit amet consectetur. Sit nam amet tellus gravida risus
                                        tellus. Interdum duis sollicitudin arcu dignissim. Dolor dis mattis sed quam
                                        sagittis massa pulvinar volutpat enim.
                                    </p>
                                </div>
                            </a>
                        </article>

                        <!-- Sub-articles 2x2 Grid (Right Column) -->
                        <div class="insight-subgrid">
                            <!-- Sub-article 1 -->
                            <article class="insight-grid-item" data-post-id="7">
                                <a href="./insight-detail.html?id=7" class="insight-grid-card hover-img">
                                    <div class="insight-card-img cut-tl">
                                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/service-item1.jpg" class="img-fill"
                                            alt="Modern automated steel manufacturing facility" loading="lazy">
                                    </div>
                                    <div class="insight-card-body">
                                        <h3 class="txt h6 heading txt-16_tb txt-semi insight-card-title">
                                            Global Steel Market Updates and Industry Insights
                                        </h3>
                                    </div>
                                </a>
                            </article>

                            <!-- Sub-article 2 -->
                            <article class="insight-grid-item" data-post-id="8">
                                <a href="./insight-detail.html?id=8" class="insight-grid-card hover-img">
                                    <div class="insight-card-img cut-tl">
                                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/application.jpg" class="img-fill"
                                            alt="High quality finished steel coils" loading="lazy">
                                    </div>
                                    <div class="insight-card-body">
                                        <h3 class="txt h6 heading txt-16_tb txt-semi insight-card-title">
                                            Latest Trends Shaping the Global Steel Market
                                        </h3>
                                    </div>
                                </a>
                            </article>

                            <!-- Sub-article 3 -->
                            <article class="insight-grid-item" data-post-id="9">
                                <a href="./insight-detail.html?id=9" class="insight-grid-card hover-img">
                                    <div class="insight-card-img cut-tl">
                                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/video-thumb.jpg" class="img-fill"
                                            alt="Industrial structural steel beams and trusses" loading="lazy">
                                    </div>
                                    <div class="insight-card-body">
                                        <h3 class="txt h6 heading txt-16_tb txt-semi insight-card-title">
                                            Steel Market Outlook and Emerging Industry Trends
                                        </h3>
                                    </div>
                                </a>
                            </article>

                            <!-- Sub-article 4 -->
                            <article class="insight-grid-item" data-post-id="10">
                                <a href="./insight-detail.html?id=10" class="insight-grid-card hover-img">
                                    <div class="insight-card-img cut-tl">
                                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/cta.jpg" class="img-fill"
                                            alt="Infrastructure development and steel application" loading="lazy">
                                    </div>
                                    <div class="insight-card-body">
                                        <h3 class="txt h6 heading txt-16_tb txt-semi insight-card-title">
                                            Key Developments Across the Global Steel Industry
                                        </h3>
                                    </div>
                                </a>
                            </article>
                        </div>
                    </div>
                </div>
            </section>

        </div>

    </main>

    <!-- ==========================================================================
         Global Footer
         ========================================================================== -->
    
<?php get_footer(); ?>