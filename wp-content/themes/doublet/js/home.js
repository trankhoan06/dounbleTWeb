document.addEventListener('DOMContentLoaded', () => {
    // A small GPU-only parallax on the Home hero image. Scroll work is
    // coalesced to at most one update per animation frame.
    const heroSection = document.querySelector('.home-hero');
    const heroImage = heroSection?.querySelector('.home-hero-bg img');
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (heroSection && heroImage && !reducedMotion) {
        let parallaxFrame = null;

        heroImage.classList.add('has-parallax');

        const updateHeroParallax = () => {
            const heroRect = heroSection.getBoundingClientRect();
            const maxShift = Math.min(120, heroSection.offsetHeight * 0.13);
            const shift = Math.min(maxShift, Math.max(0, -heroRect.top * 0.16));

            heroImage.style.setProperty('--hero-parallax-y', `${shift.toFixed(2)}px`);
            parallaxFrame = null;
        };

        const requestHeroParallax = () => {
            if (parallaxFrame !== null) return;
            parallaxFrame = window.requestAnimationFrame(updateHeroParallax);
        };

        updateHeroParallax();
        window.addEventListener('scroll', requestHeroParallax, { passive: true });
        window.addEventListener('resize', requestHeroParallax, { passive: true });
    }

    // Use a subtle fade-up only. The selectors target small content units so
    // labels, titles, descriptions, images and cards reveal independently.
    if (typeof window.AOS === 'object') {
        const groups = [
            '.home-future-title, .home-future-sub, .home-future-btn, .home-future-img, .home-future-orbit',
            '.home-video-inner, .home-video-main, .home-video-control',
            '.home-product-label, .home-product-title, .home-product-cms, .home-product-control, .home-product-cta',
            '.home-service-img, .home-service-title, .home-service-sub, .home-service-btn, .home-service-cms',
            '.home-app-label, .home-app-title, .home-app-tab, .home-app-media, .home-app-content-title, .home-app-content-desc, .home-app-feature, .home-app-action',
            '.home-media-label, .home-media-title, .home-media-bar, .home-media-slider-wrap',
            '.home_intro_content, .home_intro_image, .home_specialize_title, .home_specialize_desc, .home_specialize_item, .home_services_title, .home_services_content, .home_case_item, .home_clients_title'
        ];

        groups.forEach((selector) => {
            document.querySelectorAll(selector).forEach((element, index) => {
                if (element.hasAttribute('data-aos')) return;
                element.setAttribute('data-aos', 'fade-up');
                element.setAttribute('data-aos-delay', String((index % 4) * 90));
                element.setAttribute('data-aos-duration', '650');
                element.setAttribute('data-aos-once', 'true');
            });
        });

        window.AOS.init({
            duration: 650,
            easing: 'ease-out',
            once: true,
            offset: 70,
            disable: () => window.matchMedia('(prefers-reduced-motion: reduce)').matches,
        });
    }

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

        const mediaSliderWraps = document.querySelectorAll('.home-media-slider-wrap');
        mediaSliderWraps.forEach(wrap => {
            const sliderEl = wrap.querySelector('.home-media-slider');
            if (!sliderEl) return;
            const nextBtn = wrap.querySelector('.home-media-next');
            const prevBtn = wrap.querySelector('.home-media-prev');
            const paginationEl = wrap.querySelector('.home-media-pagination');

            new Swiper(sliderEl, {
                ...swiperCommonOptions,
                navigation: {
                    nextEl: nextBtn,
                    prevEl: prevBtn,
                },
                pagination: {
                    el: paginationEl,
                    clickable: true,
                }
            });
        });
    }
});

