<?php
/**
 * Template Name: Careers
 */
get_header(); ?>



    <main class="main">
        <section class="careers-hero" aria-labelledby="careersHeroTitle">
            <div class="careers-hero-bg">
                <img src="<?php echo get_template_directory_uri(); ?>/imgs/product-banner.jpg" class="img-fill" alt="Double T steel processing factory">
            </div>
            <div class="container careers-hero-inner">
                <div class="careers-hero-panel ">
                    <div class="careers-hero-panel-bg cut-tr "></div>
                    <nav class="careers-breadcrumb txt txt-14 txt-14_tb txt-14_mb" aria-label="Breadcrumb">
                        <a href="./index.html">Home</a>
                        <span class="commit-hero-pagi-devi " aria-hidden="true">/</span>
                        <span class="current">Careers</span>
                    </nav>
                    <h1 class="heading h1 h3_mb careers-hero-title" id="careersHeroTitle">
                        JOB OPPORTUNITIES
                    </h1>
                </div>
            </div>
        </section>

        <!-- 2. Introduction & 4-Photo Working Environment Grid -->
        <section class="careers-intro">
            <div class="container">
                <p class="careers-intro-copy txt txt-16 txt-14_tb txt-14_mb txt-med">
                    At Double T, your skills and ideas directly shape your career and our industry. Whether you’re an
                    engineer, technician, strategist, or a graduate starting your first role, you’ll take on
                    challenging projects, learn from industry leaders, and grow in a company that invests in your
                    development. From cutting-edge steel plants to innovative green steel and digital operations, your
                    work here has real impact – on your career and on India’s steel industry.
                </p>

                <!-- 4-Image Grid matching design mockup -->
                <div class="careers-gallery">
                    <!-- Column 1: Tall Portrait Operator Photo -->
                    <figure class="careers-gallery-item careers-gallery-tall hover-img">
                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/career-gallery-1.jpg" class="img-fill"
                            alt="Double T engineers and machine operators on the production line" loading="lazy">
                    </figure>

                    <!-- Column 2-3 Row 1: Wide Aerial View of Complex -->
                    <figure class="careers-gallery-item careers-gallery-wide hover-img">
                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/video-thumb.jpg" class="img-fill"
                            alt="Aerial view of Double T steel processing manufacturing complex" loading="lazy">
                    </figure>

                    <!-- Column 2 Row 2: Slitting Line Machinery Operation -->
                    <figure class="careers-gallery-item careers-gallery-sub hover-img">
                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/product-banner.jpg" class="img-fill"
                            alt="Automated coil slitting line operation" loading="lazy">
                    </figure>

                    <!-- Column 3 Row 2: Operator with 20+ Stats Overlay -->
                    <figure class="careers-gallery-item careers-gallery-sub careers-gallery-stat hover-img">
                        <img src="<?php echo get_template_directory_uri(); ?>/imgs/commit-vison.jpg" class="img-fill"
                            alt="Double T technician at the precision control console" loading="lazy">
                        <div class="careers-gallery-overlay">
                            <span class="heading h1 h2_tb h3_mb txt-bold careers-gallery-stat-number">20+</span>
                        </div>
                    </figure>
                </div>
            </div>
        </section>

        <!-- 3. Job Openings / Career Development Listing -->
        <section class="careers-openings" id="job-openings">
            <div class="container">
                <div class="careers-section-heading">
                    <div class="label red-light cut-diagonal cut-sm">
                        <span class="txt txt-13 txt-semi">JOB OPENINGS</span>
                    </div>
                    <h2 class="heading h2 h3_tb h4_mb careers-section-title">Career Development</h2>
                </div>

                <div class="careers-jobs" role="list">
                    <!-- Table Header -->
                    <div class="careers-job careers-job-head txt txt-13 txt-med" aria-hidden="true">
                        <div>POSITION</div>
                        <div>LOCATION</div>
                        <div>DEADLINE</div>
                        <div></div>
                    </div>

                    <!-- Job Row 1 -->
                    <a href="#" class="careers-job" role="listitem">
                        <h3 class="heading h6 careers-job-title">Steel Production Engineer</h3>
                        <div class="txt txt-16 txt-14_mb careers-job-location">Office</div>
                        <div class="txt txt-16 txt-14_mb careers-job-deadline">20/10/2026</div>
                        <div class="careers-job-btn btn" aria-label="View details for Steel Production Engineer">
                            <span class="txt txt-14 txt-13_mb txt-semi">VIEW DETAIL</span>
                        </div>
                    </a>

                    <!-- Job Row 2 -->
                    <a href="#" class="careers-job" role="listitem">
                        <h3 class="heading h6 careers-job-title">Steel Quality Control Engineer</h3>
                        <div class="txt txt-16 txt-14_mb careers-job-location">Headquarters</div>
                        <div class="txt txt-16 txt-14_mb careers-job-deadline">20/10/2026</div>
                        <div class="careers-job-btn btn" aria-label="View details for Steel Quality Control Engineer">
                            <span class="txt txt-14 txt-13_mb txt-semi">VIEW DETAIL</span>
                        </div>
                    </a>

                    <!-- Job Row 3 -->
                    <a href="#" class="careers-job" role="listitem">
                        <h3 class="heading h6 careers-job-title">Steel Sales Manager</h3>
                        <div class="txt txt-16 txt-14_mb careers-job-location">Office</div>
                        <div class="txt txt-16 txt-14_mb careers-job-deadline">20/10/2026</div>
                        <div class="careers-job-btn btn" aria-label="View details for Steel Sales Manager">
                            <span class="txt txt-14 txt-13_mb txt-semi">VIEW DETAIL</span>
                        </div>
                    </a>

                    <!-- Job Row 4 -->
                    <a href="#" class="careers-job" role="listitem">
                        <h3 class="heading h6 careers-job-title">Steel Fabrication Supervisor</h3>
                        <div class="txt txt-16 txt-14_mb careers-job-location">Office</div>
                        <div class="txt txt-16 txt-14_mb careers-job-deadline">20/10/2026</div>
                        <div class="careers-job-btn btn" aria-label="View details for Steel Fabrication Supervisor">
                            <span class="txt txt-14 txt-13_mb txt-semi">VIEW DETAIL</span>
                        </div>
                    </a>

                    <!-- Job Row 5 -->
                    <a href="#" class="careers-job" role="listitem">
                        <h3 class="heading h6 careers-job-title">Project Engineer – Steel Structures</h3>
                        <div class="txt txt-16 txt-14_mb careers-job-location">Headquarters</div>
                        <div class="txt txt-16 txt-14_mb careers-job-deadline">20/10/2026</div>
                        <div class="careers-job-btn btn"
                            aria-label="View details for Project Engineer – Steel Structures">
                            <span class="txt txt-14 txt-13_mb txt-semi">VIEW DETAIL</span>
                        </div>
                    </a>
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
                            Together We Build<br><span class="careers-success-accent">Success</span>
                        </h2>
                    </div>
                </div>

                <!-- Floating Teal Stats Card with Top-Left Chamfer and Bottom-Right Red Accent -->
                <div class="careers-success-card-wrap">

                    <div class="careers-success-deco " aria-hidden="true">
                        <img class="mobile" src="/imgs/icon_deco.svg" alt="">
                        <img class="middle" src="/imgs/icon_deco_desktop.svg" alt="">
                    </div>
                    <div class="careers-success-card">
                        <div class="careers-success-body">
                            <div class="careers-stat">
                                <strong class="heading h0 h2_tb careers-stat-num">10+</strong>
                                <span class="txt txt-18 txt-14_tb txt-14_mb txt-med careers-stat-label">Year of
                                    Development</span>
                            </div>
                            <div class="careers-stat">
                                <strong class="heading h0 h2_tb careers-stat-num">100+</strong>
                                <span class="txt txt-18 txt-14_tb txt-14_mb txt-med careers-stat-label">Human
                                    Resources</span>
                            </div>
                            <div class="careers-stat">
                                <strong class="heading h0 h2_tb careers-stat-num">2</strong>
                                <span class="txt txt-18 txt-14_tb txt-14_mb txt-med careers-stat-label">Branch</span>
                            </div>
                        </div>
                        <div class="careers-success-card-accent" aria-hidden="true"></div>
                    </div>
                </div>
            </div>
            <!-- Factory Image & Floating Stats Card Wrapper -->
            <div class="careers-success-media">
                <img src="<?php echo get_template_directory_uri(); ?>/imgs/hero-img.jpg" class="img-fill" alt="Double T automated steel manufacturing facility"
                    loading="lazy">
            </div>
        </section>
    </main>

    
<?php get_footer(); ?>