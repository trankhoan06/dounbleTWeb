<?php
/**
 * Template Name: Insight Category
 */
get_header(); ?>



    <main class="main" id="mainContent">
        <section class="cat-hero" aria-labelledby="catHeroTitle">
            <div class="cat-hero-inner">
                <div class="cat-hero-panel">
                    <div class="container cat-hero-container">
                        <nav class="cat-breadcrumb txt txt-14 txt-14_tb txt-14_mb" aria-label="Breadcrumb">
                            <a href="./index.html">Home</a>
                            <span class="cat-breadcrumb-devi" aria-hidden="true">/</span>
                            <a class="middle" href="./product-service.html">Product &amp; Service</a>
                            <a class="mobile" href="./product-service.html">...</a>
                            <span class="cat-breadcrumb-devi" aria-hidden="true">/</span>
                            <span class="current">Market News</span>
                        </nav>
                        <h1 class="heading h1 h2_tb h3_mb cat-hero-title" id="catHeroTitle">
                            MARKET NEWS
                        </h1>
                    </div>
                </div>
                <div class="cat-hero-media desktop">
                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/hero-img.jpg" class="img-fill" alt="Double T steel processing plant">
                </div>
            </div>
        </section>

        <section class="cat-listing-section" id="categoryListingSection">
            <div class="container">
                <div class="cat-listing-layout">

                    <!-- Left Main Column: 3x4 Grid of Articles -->
                    <div class="cat-main-col">
                        <div class="cat-articles-grid" id="catArticlesGrid">

                        </div>

                        <!-- Pagination Navigation matching mockup -->
                        <div class="cat-pagination-wrap">
                            <nav class="cat-pagination cut-diagonal" aria-label="Article page navigation">
                                <a href="#" class="cat-page-btn cut-tl active" aria-current="page" data-page="1">
                                    <span class="txt txt-15 txt-14_tb txt-semi">1</span>
                                </a>
                                <a href="#" class="cat-page-btn" data-page="2">
                                    <span class="txt txt-15 txt-14_tb txt-semi">2</span>
                                </a>
                                <a href="#" class="cat-page-btn" data-page="3">
                                    <span class="txt txt-15 txt-14_tb txt-semi">3</span>
                                </a>
                                <span class="cat-page-dots txt txt-15 txt-14_tb txt-semi" aria-hidden="true">...</span>
                                <a href="#" class="cat-page-btn" data-page="8">
                                    <span class="txt txt-15 txt-14_tb txt-semi">8</span>
                                </a>
                                <a href="#" class="cat-page-btn" data-page="9">
                                    <span class="txt txt-15 txt-14_tb txt-semi">9</span>
                                </a>
                                <a href="#" class="cat-page-btn cut-br" data-page="10">
                                    <span class="txt txt-15 txt-14_tb txt-semi">10</span>
                                </a>
                            </nav>
                        </div>
                    </div>

                    <!-- Right Sidebar: Widgets Column -->
                    <aside class="cat-sidebar" aria-label="Sidebar highlights">
                        <!-- Widget 1: Promo Banner Card -->
                        <div class="cat-promo-card cut-tl">
                            <div class="cat-promo-img-wrap">
                                <img src="<?php echo get_template_directory_uri(); ?>/imgs/commit-intro.jpg" alt="Double T factory engineer and steel processing"
                                    loading="lazy">
                            </div>
                            <div class="cat-promo-content">
                                <div class="cat-promo-watermark" aria-hidden="true">
                                    <img src="<?php echo get_template_directory_uri(); ?>/imgs/logo_marker.png" alt="">
                                </div>
                                <div class="cat-promo-badge label label-red cut-diagonal">
                                    <span class="txt txt-13 txt-bold">PRODUCT DOUBLE T</span>
                                </div>
                                <h3 class="heading h5 h4_mb cat-promo-title">
                                    Professional steel supplier and processor.
                                </h3>
                                <a href="./product-service.html" class="cat-promo-btn btn-outline btn">
                                    <span class="txt txt-13 txt-semi cat-promo-btn-text">VIEW ALL PRODUCTS</span>
                                    <span class="cat-promo-btn-accent" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>

                        <!-- Widget 2: Other Category Card -->
                        <div class="cat-sidebar-widget cut-tl" id="catSidebarOtherWidget">
                            <div class="cat-widget-head">
                                <div class="cat-widget-tag cut-tl" id="catWidgetTag">
                                    <span class="txt txt-14 txt-semi cat-widget-tag-text" id="catWidgetTagText">COMPANY
                                        OPERATIONS</span>
                                </div>
                            </div>

                            <div class="cat-widget-list" id="catWidgetList">
                            </div>

                            <div class="cat-widget-footer">
                                <a href="./insight-category.html?category=company-operations" class="cat-widget-viewall"
                                    id="catWidgetViewAllLink" aria-label="View all related articles">
                                    <span class="txt txt-14 txt-semi cat-widget-viewall-text">VIEW ALL</span>
                                    <svg class="cat-widget-viewall-icon" viewBox="0 0 8 12" aria-hidden="true">
                                        <path d="M1.5 1.5L6 6L1.5 10.5" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </aside>

                </div>
            </div>
        </section>

        <?php render_consultation_cta(); ?>

    </main>

    
<?php get_footer(); ?>