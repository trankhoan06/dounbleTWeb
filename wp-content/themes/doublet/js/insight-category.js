/**
 * Double T - Insight Category Listing Scripts
 * Handles category query params, dynamic card rendering, and sidebar state
 */

(function () {
    'use strict';

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
     * Category Listing Dynamic Template Engine
     */
    window.DoubleT_CategoryListing = {
        /**
         * Render an article card for the 3x4 grid
         * @param {Object} post 
         * @returns {string} HTML string
         */
        renderArticleCard: function (post) {
            if (!post) return '';
            const title = post.title || '';
            const img = post.image || './imgs/product.jpg';
            const alt = post.alt || title;
            const url = post.url || '#';
            const id = post.id || '';

            return `
                <article class="cat-article-item" data-post-id="${id}">
                    <a href="${url}" class="cat-article-card hover-img">
                        <div class="cat-article-img cut-tl">
                            <img src="${img}" class="img-fill" alt="${alt}" loading="lazy">
                        </div>
                        <div class="cat-article-body">
                            <h2 class="txt txt-16 h6_mb txt-semi cat-article-title">${title}</h2>
                        </div>
                    </a>
                </article>
            `;
        },

        /**
         * Render a mini card for the sidebar widget
         * @param {Object} post 
         * @returns {string} HTML string
         */
        renderMiniCard: function (post) {
            if (!post) return '';
            const title = post.title || '';
            const img = post.image || './imgs/product.jpg';
            const alt = post.alt || title;
            const url = post.url || '#';

            return `
                <a href="${url}" class="cat-mini-card hover-img">
                    <div class="cat-mini-img cut-tl">
                        <img src="${img}" class="img-fill" alt="${alt}" loading="lazy">
                    </div>
                    <h4 class="txt txt-14 txt-16_mb txt-semi cat-mini-title">${title}</h4>
                </a>
            `;
        },

        /**
         * Initialize page from URL category query param (?category=market-news)
         */
        initFromUrl: function () {
            const urlParams = new URLSearchParams(window.location.search);
            const categorySlug = urlParams.get('category') || 'market-news';

            fetch('./data/insights.json')
                .then(res => {
                    if (!res.ok) throw new Error('Data fetch failed');
                    return res.json();
                })
                .then(categories => {
                    if (!Array.isArray(categories)) return;

                    const currentCategory = categories.find(c => c.slug === categorySlug) || categories[0];
                    const otherCategory = categories.find(c => c.slug !== categorySlug) || categories[1] || categories[0];

                    if (currentCategory) {
                        // Update document title and hero banner
                        document.title = `${currentCategory.name} | Double T Insights`;

                        const titleEl = document.getElementById('catHeroTitle');
                        if (titleEl) titleEl.textContent = currentCategory.name;

                        const breadcrumbEl = document.getElementById('catBreadcrumbCurrent');
                        if (breadcrumbEl) breadcrumbEl.textContent = currentCategory.name;

                        // If custom posts are in json
                        const posts = currentCategory.listingPosts || [];
                        const gridEl = document.getElementById('catArticlesGrid');
                        if (gridEl && posts.length > 0) {
                            gridEl.innerHTML = posts.map(p => this.renderArticleCard(p)).join('');
                        }
                    }

                    if (otherCategory) {
                        // Update sidebar widget to show the other category
                        const widgetTagText = document.getElementById('catWidgetTagText');
                        if (widgetTagText) widgetTagText.textContent = otherCategory.name;

                        const widgetList = document.getElementById('catWidgetList');
                        const otherPosts = (otherCategory.subPosts || otherCategory.listingPosts || []).slice(0, 4);
                        if (widgetList && otherPosts.length > 0) {
                            widgetList.innerHTML = otherPosts.map(p => this.renderMiniCard(p)).join('');
                        }

                        const viewAllLink = document.getElementById('catWidgetViewAllLink');
                        if (viewAllLink) {
                            viewAllLink.href = `./insight-category.html?category=${otherCategory.slug}`;
                        }
                    }

                    if (typeof window.DoubleTRefreshReveals === 'function') {
                        window.DoubleTRefreshReveals();
                    }
                })
                .catch(err => {
                    // Static fallback HTML already exists in DOM for SEO
                    console.info('Using static rendered category listing:', err.message);
                });
        }
    };

    function setupPagination() {
        const paginationWrap = document.querySelector('.cat-pagination');
        if (!paginationWrap) return;

        paginationWrap.addEventListener('click', function (e) {
            const btn = e.target.closest('.cat-page-btn');
            if (!btn) return;
            e.preventDefault();

            const allBtns = paginationWrap.querySelectorAll('.cat-page-btn');
            allBtns.forEach(b => {
                b.classList.remove('active');
                b.removeAttribute('aria-current');
            });

            btn.classList.add('active');
            btn.setAttribute('aria-current', 'page');
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        setupActiveNav();
        setupPagination();
        DoubleT_CategoryListing.initFromUrl();
    });
})();
