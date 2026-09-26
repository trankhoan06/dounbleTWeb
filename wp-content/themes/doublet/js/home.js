document.addEventListener('DOMContentLoaded', () => {
    // Product Swiper Slider
    const productSliderEl = document.querySelector('.home-product-slider');
    if (productSliderEl && typeof Swiper !== 'undefined') {
        const productSection = productSliderEl.closest('.home-product');
        const productPrev = productSection?.querySelector('.home-product-prev');
        const productNext = productSection?.querySelector('.home-product-next');
        const productProgress = productSection?.querySelector('.home-product-control-progress-inner');

        const updateProductProgress = (swiper) => {
            if (!productProgress) return;

            const totalSteps = Math.max(swiper.snapGrid.length, 1);
            const currentStep = Math.min(swiper.snapIndex + 1, totalSteps);
            productProgress.style.transform = `scaleX(${currentStep / totalSteps})`;
        };

        new Swiper(productSliderEl, {
            slidesPerView: 1.1,
            slidesPerGroup: 1,
            spaceBetween: 16,
            speed: 600,
            grabCursor: true,
            watchOverflow: true,
            navigation: {
                prevEl: productPrev,
                nextEl: productNext,
            },
            breakpoints: {
                576: {
                    slidesPerView: 1.5,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 24,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 32,
                },
            },
            on: {
                init(swiper) {
                    updateProductProgress(swiper);
                },
                slideChange(swiper) {
                    updateProductProgress(swiper);
                },
                resize(swiper) {
                    updateProductProgress(swiper);
                },
            },
        });
    }

    // Service Showcase Swiper Slider
    const serviceSliderEl = document.querySelector('.home-service-slider');
    if (serviceSliderEl && typeof Swiper !== 'undefined') {
        const progressBar = serviceSliderEl.querySelector('.home-service-progress-bar');
        const nextTab = serviceSliderEl.querySelector('.home-service-next-tab');
        const tabItems = nextTab ? Array.from(nextTab.querySelectorAll('.home-service-next-tab-item')) : [];

        const updateControls = (sw) => {
            const total = sw.slides.length;
            const current = sw.realIndex;

            // Update Progress Bar
            if (progressBar) {
                const percentage = ((current + 1) / total) * 100;
                progressBar.style.width = `${percentage}%`;
            }

            // Update Next Tab Preview with pure fade transition
            if (tabItems.length > 0) {
                const nextIndex = (current + 1) % total;
                tabItems.forEach((item) => {
                    const itemTarget = parseInt(item.dataset.slideIndex, 10);
                    if (itemTarget === nextIndex) {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }
                });
            }
        };

        const serviceSwiper = new Swiper(serviceSliderEl, {
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            slidesPerView: 1,
            speed: 600,
            allowTouchMove: true,
            navigation: {
                nextEl: '.home-service-next',
                prevEl: '.home-service-prev',
            },
            on: {
                init: function () {
                    updateControls(this);
                },
                slideChange: function () {
                    updateControls(this);
                }
            }
        });

        // Click next tab to slide to next service
        if (nextTab) {
            nextTab.addEventListener('click', () => {
                const nextIndex = (serviceSwiper.realIndex + 1) % serviceSwiper.slides.length;
                serviceSwiper.slideTo(nextIndex);
            });
        }
    }

    // Practical Production Tabs Switching (.home-app)
    const appTabs = document.querySelectorAll('.home-app-tab');
    const appPanels = document.querySelectorAll('.home-app-panel');

    if (appTabs.length > 0 && appPanels.length > 0) {
        appTabs.forEach((tab) => {
            tab.addEventListener('click', () => {
                const targetIndex = tab.dataset.tab;

                // Deactivate all tabs
                appTabs.forEach((t) => {
                    t.classList.remove('active');
                    t.setAttribute('aria-selected', 'false');
                });

                // Activate clicked tab
                tab.classList.add('active');
                tab.setAttribute('aria-selected', 'true');

                // Switch corresponding panel
                appPanels.forEach((panel) => {
                    if (panel.dataset.panel === targetIndex) {
                        panel.classList.add('active');
                    } else {
                        panel.classList.remove('active');
                    }
                });
            });
        });
    }

    // Featured Media Sliders (Market News & Company Operations)
    if (typeof Swiper !== 'undefined') {
        const swiperCommonOptions = {
            slidesPerView: 1.2,
            spaceBetween: 16,
            speed: 600,
            grabCursor: true,
            breakpoints: {
                576: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 24
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 32
                }
            }
        };

        const marketSliderEl = document.querySelector('.home-media-market-slider');
        if (marketSliderEl) {
            new Swiper(marketSliderEl, {
                ...swiperCommonOptions,
                navigation: {
                    nextEl: '.home-media-market-next',
                    prevEl: '.home-media-market-prev',
                },
                pagination: {
                    el: '.home-media-market-pagination',
                    clickable: true,
                }
            });
        }

        const opsSliderEl = document.querySelector('.home-media-ops-slider');
        if (opsSliderEl) {
            new Swiper(opsSliderEl, {
                ...swiperCommonOptions,
                navigation: {
                    nextEl: '.home-media-ops-next',
                    prevEl: '.home-media-ops-prev',
                },
                pagination: {
                    el: '.home-media-ops-pagination',
                    clickable: true,
                }
            });
        }
    }
});

