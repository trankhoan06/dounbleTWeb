/**
 * Double T - Insight Page Scripts
 * Modular structure for easy blog & category data population
 */

(function () {
    'use strict';

    /**
     * Set active state for INSIGHT navigation item in header
     */
    function setupActiveNav() {
        const menuLinks = document.querySelectorAll('.header-menu-item');
        menuLinks.forEach(link => {
            const href = link.getAttribute('href') || '';
            if (href.includes('insight')) {
                link.classList.add('active');
            }
        });
    }

    /**
     * Insights Data Handler & Dynamic Template Engine
     * Designed so developers can easily feed JSON data, WordPress REST API, or headless CMS data
     */
    window.DoubleT_Insights = {
        /**
         * Render HTML for a single featured card (Left Column)
         * @param {Object} post 
         * @returns {string} HTML string
         */
        renderFeaturedCard: function (post) {
            if (!post) return '';
            const safeTitle = post.title || '';
            const safeExcerpt = post.excerpt || '';
            const safeImg = post.image || './imgs/product.jpg';
            const safeAlt = post.alt || safeTitle;
            const safeUrl = post.url || '#';
            const postId = post.id || '';

            return `
                <article class="insight-featured-item" data-post-id="${postId}">
                    <a href="${safeUrl}" class="insight-featured-card hover-img">
                        <div class="insight-card-img cut-tl">
                            <img src="${safeImg}" class="img-fill" alt="${safeAlt}" loading="lazy">
                        </div>
                        <div class="insight-card-body">
                            <h2 class="heading h4 h5_tb insight-card-title">${safeTitle}</h2>
                            <p class="txt txt-14 insight-card-excerpt">${safeExcerpt}</p>
                        </div>
                    </a>
                </article>
            `;
        },

        /**
         * Render HTML for a single sub-card (2x2 grid item)
         * @param {Object} post 
         * @returns {string} HTML string
         */
        renderSubCard: function (post) {
            if (!post) return '';
            const safeTitle = post.title || '';
            const safeImg = post.image || './imgs/product.jpg';
            const safeAlt = post.alt || safeTitle;
            const safeUrl = post.url || '#';
            const postId = post.id || '';

            return `
                <article class="insight-grid-item" data-post-id="${postId}">
                    <a href="${safeUrl}" class="insight-grid-card hover-img">
                        <div class="insight-card-img cut-tl">
                            <img src="${safeImg}" class="img-fill" alt="${safeAlt}" loading="lazy">
                        </div>
                        <div class="insight-card-body">
                            <h3 class="txt txt-16 txt-14_tb txt-semi insight-card-title">${safeTitle}</h3>
                        </div>
                    </a>
                </article>
            `;
        },

        /**
         * Render HTML for an entire category section
         * @param {Object} category 
         * @returns {string} HTML string
         */
        renderCategorySection: function (category) {
            if (!category) return '';
            const catId = category.id || category.slug || 'category';
            const catName = category.name || 'Category';
            const viewAllUrl = category.viewAllUrl || `./insight.html#${catId}`;
            const featuredHtml = this.renderFeaturedCard(category.featuredPost);
            const subPostsHtml = (category.subPosts || []).map(post => this.renderSubCard(post)).join('');

            return `
                <section class="insight-category" id="${catId}" data-category="${catId}" aria-labelledby="catLabel-${catId}">
                    <div class="container">
                        <!-- Category Header Bar (Industrial Tag + View All) -->
                        <div class="insight-category-bar">
                            <div class="insight-category-tag cut-tl" id="catLabel-${catId}">
                                <span class="txt txt-16 txt-14_tb txt-semi insight-category-tag-text">${catName}</span>
                            </div>
                            <a href="${viewAllUrl}" class="insight-view-all" aria-label="View all ${catName} articles">
                                <span class="txt txt-14 txt-semi insight-view-all-text">VIEW ALL</span>
                                <svg class="insight-view-all-icon" viewBox="0 0 8 12" aria-hidden="true">
                                    <path d="M1.5 1.5L6 6L1.5 10.5"/>
                                </svg>
                            </a>
                        </div>

                        <!-- Category Articles Grid (1 Featured Card + 4 Sub-articles 2x2 grid) -->
                        <div class="insight-category-grid">
                            ${featuredHtml}
                            <div class="insight-subgrid">
                                ${subPostsHtml}
                            </div>
                        </div>
                    </div>
                </section>
            `;
        },

        /**
         * Dynamic Loader: Fetch insights JSON and render to container
         * Can be called whenever data needs to be loaded via AJAX/API
         * @param {string} jsonUrl 
         * @param {string} containerSelector 
         */
        loadFromApi: function (jsonUrl, containerSelector) {
            const container = document.querySelector(containerSelector || '#insightCategoriesContainer');
            if (!container) return;

            fetch(jsonUrl || './data/insights.json')
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(categories => {
                    if (Array.isArray(categories) && categories.length > 0) {
                        const html = categories.map(cat => this.renderCategorySection(cat)).join('');
                        container.innerHTML = html;
                    }
                })
                .catch(err => {
                    console.info('Using static rendered insights:', err.message);
                });
        }
    };

    document.addEventListener('DOMContentLoaded', function () {
        setupActiveNav();
    });
})();
