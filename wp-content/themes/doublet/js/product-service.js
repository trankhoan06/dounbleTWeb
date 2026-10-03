document.addEventListener('DOMContentLoaded', () => {
    // 1. Tabs & Scroll Spy Logic
    const tabs = Array.from(document.querySelectorAll('[data-service-tab]'));
    const sections = Array.from(document.querySelectorAll('[data-service-section]'));

    if (tabs.length && sections.length) {
        const setActiveTab = (sectionId) => {
            tabs.forEach((tab) => {
                const isActive = tab.dataset.serviceTab === sectionId;
                tab.classList.toggle('active', isActive);

                if (isActive) {
                    tab.setAttribute('aria-current', 'true');

                    // Center the active tab in its scrollable container on mobile
                    if (window.innerWidth <= 991) {
                        const tabsContainer = tab.closest('.ps-service-tabs');
                        if (tabsContainer) {
                            const scrollLeft = tab.offsetLeft - (tabsContainer.offsetWidth / 2) + (tab.offsetWidth / 2);
                            tabsContainer.scrollTo({
                                left: scrollLeft,
                                behavior: 'smooth'
                            });
                        }
                    }
                } else {
                    tab.removeAttribute('aria-current');
                }
            });
        };

        tabs.forEach((tab) => {
            tab.addEventListener('click', (event) => {
                const section = document.getElementById(tab.dataset.serviceTab);
                if (!section) return;

                event.preventDefault();

                const headerHeight = document.querySelector('.header')?.offsetHeight ?? 0;
                const tabsHeight = document.querySelector('.ps-service-tabs')?.offsetHeight ?? 0;
                const targetTop = section.getBoundingClientRect().top + window.scrollY - headerHeight - tabsHeight - 16;
                const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

                setActiveTab(section.id);
                window.scrollTo({
                    top: targetTop,
                    behavior: reduceMotion ? 'auto' : 'smooth',
                });
                window.history.replaceState(null, '', `#${section.id}`);
            });
        });

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                const visibleEntry = entries
                    .filter((entry) => entry.isIntersecting)
                    .sort((first, second) => second.intersectionRatio - first.intersectionRatio)[0];

                if (visibleEntry) setActiveTab(visibleEntry.target.id);
            }, {
                rootMargin: '-25% 0px -55% 0px',
                threshold: [0.05, 0.2, 0.4],
            });

            sections.forEach((section) => observer.observe(section));
        }
    }

    // 2. Load More Products Logic (xổ 6 item mỗi lần click, ẩn nút khi hết)
    const productsGrid = document.getElementById('psProductsGrid') || document.querySelector('.ps-products-grid');
    const moreBtn = document.getElementById('psProductsMore') || document.querySelector('.ps-products-more');
    const moreActionWrap = document.getElementById('psProductsAction') || document.querySelector('.ps-products-action');

    if (productsGrid && moreBtn) {
        const ITEMS_PER_LOAD = 6;

        moreBtn.addEventListener('click', (event) => {
            event.preventDefault();

            const hiddenCards = Array.from(productsGrid.querySelectorAll('.ps-product-card.is-hidden'));
            const toShow = hiddenCards.slice(0, ITEMS_PER_LOAD);

            toShow.forEach((card) => {
                card.classList.remove('is-hidden');
                card.classList.add('fade-in');
            });

            // Nếu số lượng card ẩn còn lại <= 6, tức là sau lượt này đã hết toàn bộ, ẩn nút
            if (hiddenCards.length <= ITEMS_PER_LOAD) {
                if (moreActionWrap) {
                    moreActionWrap.style.display = 'none';
                } else {
                    moreBtn.style.display = 'none';
                }
            }
        });
    }
});
