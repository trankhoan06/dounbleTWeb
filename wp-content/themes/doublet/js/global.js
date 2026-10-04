/**
 * Global JavaScript for Double T Website
 * Handles:
 * 1. Header scroll state (Transparent to White)
 * 2. Language Selector Dropdown
 * 3. Scroll To Top button
 */
document.addEventListener('DOMContentLoaded', () => {
    // Keep above-the-fold items hidden until every DOM-ready initializer has
    // run. Two frames prevent a visible pre-initialization flash.
    window.requestAnimationFrame(() => {
        window.requestAnimationFrame(() => {
            document.documentElement.classList.remove('is-first-loading');
            const firstLoadItems = document.querySelectorAll('.first-load-item');
            const heroEnterItems = document.querySelectorAll('.hero-enter-item, .hero-enter-bg');
            const reduceFirstLoadMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const cleanupDelay = reduceFirstLoadMotion ? 0 : 550;

            window.setTimeout(() => {
                firstLoadItems.forEach((element) => {
                    element.classList.remove('first-load-item');
                });
            }, cleanupDelay);

            window.setTimeout(() => {
                heroEnterItems.forEach((element) => {
                    element.classList.remove('hero-enter-item', 'hero-enter-panel', 'hero-enter-bg');
                });
            }, reduceFirstLoadMotion ? 0 : 1000);
        });
    });

    // Smooth scrolling is intentionally disabled for users who request reduced
    // motion. Native scroll remains the fallback if Lenis cannot be loaded.
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    if (typeof window.Lenis === 'function' && !reducedMotion.matches) {
        const lenis = new window.Lenis({
            lerp: 0.1,
            wheelMultiplier: 0.9,
            touchMultiplier: 1,
            smoothWheel: true,
            syncTouch: false,
        });

        const raf = (time) => {
            lenis.raf(time);
            window.requestAnimationFrame(raf);
        };
        window.requestAnimationFrame(raf);
        window.lenis = lenis;
    }

    // Match Home's restrained hero parallax on every image-based inner-page
    // hero. One shared animation frame updates all matching layouts, including
    // full-width backgrounds and split detail/category heroes.
    const pageHeroImages = Array.from(document.querySelectorAll([
        '.commit-hero-bg img',
        '.careers-hero-bg img',
        '.contact-hero-bg img',
        '.insight-hero-bg img',
        '.ps-hero-bg img',
        '.cat-hero-media img',
        '.detail-hero-media img',
        '.psd-hero-media img',
    ].join(',')));

    if (pageHeroImages.length && !reducedMotion.matches) {
        let pageHeroParallaxFrame = null;

        const pageHeroes = pageHeroImages.map((image) => {
            const section = image.closest('section');
            image.classList.add('has-page-hero-parallax');
            return { image, section };
        }).filter(({ section }) => section);

        const updatePageHeroParallax = () => {
            pageHeroes.forEach(({ image, section }) => {
                const rect = section.getBoundingClientRect();
                const maxShift = Math.min(90, section.offsetHeight * 0.12);
                const shift = Math.min(maxShift, Math.max(0, -rect.top * 0.15));
                image.style.setProperty('--page-hero-parallax-y', `${shift.toFixed(2)}px`);
            });
            pageHeroParallaxFrame = null;
        };

        const requestPageHeroParallax = () => {
            if (pageHeroParallaxFrame !== null) return;
            pageHeroParallaxFrame = window.requestAnimationFrame(updatePageHeroParallax);
        };

        updatePageHeroParallax();
        window.addEventListener('scroll', requestPageHeroParallax, { passive: true });
        window.addEventListener('resize', requestPageHeroParallax, { passive: true });
    }

    // The header enters as one unit. Remove the entrance classes afterward so
    // its regular scroll hide/show transform can take over without conflicts.
    const reducedRevealMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const headerEntrance = document.querySelector('.header');

    if (headerEntrance) {
        const finishHeaderEntrance = () => {
            headerEntrance.classList.remove('header-enter-ready');
        };

        if (reducedRevealMotion) {
            finishHeaderEntrance();
        } else {
            headerEntrance.addEventListener('animationend', finishHeaderEntrance, { once: true });
            window.setTimeout(finishHeaderEntrance, 1500);
        }
    }

    // Shared fade-up reveals outside Home's AOS scope.
    const revealTargets = [
        // Non-home templates often expose the start of section two in the
        // initial viewport. Keep that section gated until the user scrolls it
        // through the middle of the viewport, then let its child reveals run.
        { selector: '.page-first-section-reveal', stagger: 0, duration: 600, distance: 0, rootMargin: '0px 0px -50% 0px' },
        { selector: '.consultation-cta-bg img, .consultation-cta-title, .consultation-cta-desc, .consultation-cta-action', stagger: 80 },
        { selector: '.footer-col', stagger: 90 },

        // Careers
        { selector: '.careers-intro-copy', stagger: 0 },
        { selector: '.careers-gallery-item', stagger: 80, cycle: 4 },
        { selector: '.careers-section-heading > .label, .careers-section-title', stagger: 90, cycle: 2 },
        { selector: '.careers-job', stagger: 65, cycle: 6 },
        { selector: '.careers-success-title, .careers-success-card, .careers-success-media', stagger: 100, cycle: 3 },
        { selector: '.career-content-block', stagger: 70, cycle: 4 },
        { selector: '.career-detail-share, .career-detail-content, .career-detail-info-card', stagger: 90, cycle: 3 },
        { selector: '.career-apply-title, .career-apply-form .form-group, .career-apply-form .form-submit-wrap, .career-apply-form .form-subtext', stagger: 60, cycle: 5 },
        { selector: '.career-detail-info-card', stagger: 0 },

        // Commitment
        { selector: '.commit-intro-content > .label, .commit-intro-title, .commit-intro-copy', stagger: 90, cycle: 3 },
        { selector: '.commit-intro-media', stagger: 0, duration: 750, distance: 32, rootMargin: '0px 0px -25% 0px' },
        { selector: '.commit-capabilities-label, .commit-capabilities-title, .commit-capabilities-summary', stagger: 90, cycle: 3 },
        { selector: '.commit-capabilities-number, .commit-capabilities-card, .commit-capabilities-slide-right, .commit-capabilities-controls', stagger: 80, cycle: 4 },
        { selector: '.commit-mission-vision-label, .commit-mission-vision-title', stagger: 90, cycle: 2 },
        { selector: '.commit-mission-media, .commit-mission-title, .commit-mission-item, .commit-vision-brand, .commit-vision-content', stagger: 80, cycle: 4 },

        // Contact
        { selector: '.contact-info-label, .contact-info-heading, .contact-info-group, .contact-social-title, .contact-info-col > .footer-socials', stagger: 75, cycle: 4 },
        { selector: '.contact-form .form-group, .contact-form .form-submit-wrap, .contact-form .form-submit-note', stagger: 60, cycle: 5 },
        { selector: '.contact-map-section iframe', stagger: 0 },

        // Insight listing and category
        { selector: '.insight-category-bar', stagger: 0 },
        { selector: '.insight-featured-item, .insight-grid-item', stagger: 75, cycle: 5 },
        { selector: '.cat-article-item', stagger: 65, cycle: 6 },
        { selector: '.cat-pagination-wrap, .cat-promo-card, .cat-sidebar-widget', stagger: 90, cycle: 3 },
        { selector: '.cat-mini-card', stagger: 65, cycle: 4 },

        // Insight detail
        { selector: '.detail-featured-img-wrap, .detail-article-header', stagger: 90, cycle: 2 },
        { selector: '.detail-share-col, .detail-toc-card', stagger: 90, cycle: 2 },
        { selector: '.detail-section-title, .detail-section .detail-p, .detail-inline-figure', stagger: 70, cycle: 4 },
        { selector: '.detail-nav-item', stagger: 90, cycle: 2 },
        { selector: '.detail-related-bar', stagger: 0 },
        { selector: '.detail-related-item', stagger: 75, cycle: 4 },

        // Product & Service
        { selector: '.ps-section-label, .ps-products-title', stagger: 90, cycle: 2, duration: 650, distance: 24, rootMargin: '0px 0px -25% 0px' },
        { selector: '.ps-product-card', stagger: 75, cycle: 4 },
        { selector: '.ps-products-action', stagger: 0 },
        { selector: '.ps-services-label, .ps-services-title, .ps-services-desc, .ps-services-emphasis, .ps-services-overview-media', stagger: 80, cycle: 5 },
        { selector: '.ps-service-tabs', stagger: 0 },
        { selector: '.ps-service-content, .ps-service-media', stagger: 90, cycle: 2 },

        // Product detail
        { selector: '.psd-section-tag, .psd-app-desc', stagger: 80, cycle: 2 },
        { selector: '.psd-spec-item', stagger: 65, cycle: 5 },
        { selector: '.psd-spec-frame-wrap, .psd-spec-card', stagger: 90, cycle: 2 },
        { selector: '.psd-app-card', stagger: 75, cycle: 4 },
        { selector: '.psd-other-slider-wrap, .psd-other-nav, .psd-other-pagination', stagger: 75, cycle: 4 },
    ];

    if (!reducedRevealMotion) {
        const preparedRevealElements = new WeakSet();
        const revealedElements = new WeakSet();
        const revealCleanupTimes = new WeakMap();

        const revealElement = (element) => {
            if (revealedElements.has(element)) return;

            const sectionGate = element.closest('.page-first-section-reveal.reveal-ready');
            if (sectionGate && sectionGate !== element && !sectionGate.classList.contains('is-revealed')) {
                return;
            }

            revealedElements.add(element);
            const cleanup = () => {
                element.classList.remove('reveal-ready', 'is-revealed');
                element.style.removeProperty('--reveal-delay');
                element.style.removeProperty('--reveal-duration');
                element.style.removeProperty('--reveal-distance');
            };
            const handleTransitionEnd = (event) => {
                if (event.target !== element || event.propertyName !== 'transform') return;
                element.removeEventListener('transitionend', handleTransitionEnd);
                cleanup();
            };

            element.addEventListener('transitionend', handleTransitionEnd);
            element.classList.add('is-revealed');

            if (element.classList.contains('page-first-section-reveal')) {
                window.requestAnimationFrame(() => {
                    element.querySelectorAll('.reveal-ready').forEach((child) => revealElement(child));
                });
            }

            window.setTimeout(cleanup, revealCleanupTimes.get(element) || 1400);
        };

        const prepareRevealGroup = ({ selector, immediate, stagger = 0, duration = 600, distance, startDelay, cycle = 4, rootMargin = '0px 0px -10% 0px', threshold = 0 }) => {
            const elements = Array.from(document.querySelectorAll(selector)).filter((element) => !preparedRevealElements.has(element));
            elements.forEach((element, index) => {
                preparedRevealElements.add(element);
                element.classList.add('reveal-ready');
                const delay = (index % cycle) * stagger;
                element.style.setProperty('--reveal-delay', `${delay}ms`);
                if (duration) element.style.setProperty('--reveal-duration', `${duration}ms`);
                if (distance) element.style.setProperty('--reveal-distance', `${distance}px`);
                revealCleanupTimes.set(element, duration + delay + 200);
            });
            if (!elements.length) return;

            if (immediate) {
                // Force the initial hidden style to be committed, then reveal
                // after a short paint-safe delay. This remains visible even on
                // browsers that coalesce requestAnimationFrame before first paint.
                elements.forEach((element) => void element.offsetHeight);
                window.setTimeout(() => {
                    elements.forEach(revealElement);
                }, startDelay || 100);
                return;
            }

            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries, currentObserver) => {
                    entries.forEach((entry) => {
                        if (!entry.isIntersecting) return;
                        revealElement(entry.target);
                        currentObserver.unobserve(entry.target);
                    });
                // Start when the target has entered roughly 10% of the viewport.
                // A positive bottom margin would trigger while it is still off-screen.
                }, { rootMargin, threshold });
                elements.forEach((element) => observer.observe(element));
            } else {
                elements.forEach(revealElement);
            }
        };

        const refreshRevealTargets = () => revealTargets.forEach(prepareRevealGroup);
        window.DoubleTRefreshReveals = refreshRevealTargets;
        refreshRevealTargets();
    }

    // Partners needs one stable observer because its marquee track is already
    // transformed continuously. Start the marquee only after the stagger ends.
    const partnersSection = document.querySelector('.home-partners');
    if (partnersSection && !reducedRevealMotion) {
        partnersSection.classList.add('partners-reveal-ready');
        let maxPartnerStagger = 0;
        partnersSection.querySelectorAll('.home-partners-card').forEach((card, index) => {
            const stagger = (index % 10) * 70;
            maxPartnerStagger = Math.max(maxPartnerStagger, stagger);
            card.style.setProperty('--partner-stagger', `${stagger}ms`);
        });

        const revealPartners = () => {
            partnersSection.classList.add('is-revealed');
            window.setTimeout(() => {
                partnersSection.classList.add('is-marquee-running');
            }, maxPartnerStagger + 650);
        };

        if ('IntersectionObserver' in window) {
            const partnersObserver = new IntersectionObserver((entries, observer) => {
                if (!entries[0].isIntersecting) return;
                revealPartners();
                observer.disconnect();
            }, { rootMargin: '0px 0px -18% 0px' });
            partnersObserver.observe(partnersSection);
        } else {
            revealPartners();
        }
    }

    // Load legacy data-src media only when it is close to the viewport. Several
    // homepage blocks already use this markup but previously had no loader.
    const lazyMedia = document.querySelectorAll('img[data-src], video[data-src]');
    if (lazyMedia.length) {
        const loadMedia = (element) => {
            const src = element.dataset.src;
            if (!src) return;

            if (element.tagName === 'VIDEO') {
                element.src = src;
                element.preload = 'metadata';
                element.load();
                const playAttempt = element.play();
                if (playAttempt) playAttempt.catch(() => {});
            } else {
                element.src = src;
            }
            element.removeAttribute('data-src');
        };

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries, currentObserver) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    loadMedia(entry.target);
                    currentObserver.unobserve(entry.target);
                });
            }, { rootMargin: '300px 0px' });
            lazyMedia.forEach((element) => observer.observe(element));
        } else {
            lazyMedia.forEach(loadMedia);
        }
    }

    // 0. Ensure Active State for Header Navigation Items
    const setupHeaderActiveNav = () => {
        const menuItems = document.querySelectorAll('.header-menu-item');
        if (!menuItems.length) return;

        // If server already applied active class, no need to override
        const hasServerActive = Array.from(menuItems).some(item => item.classList.contains('active'));
        if (hasServerActive) return;

        const path = window.location.pathname.toLowerCase().replace(/\/+$/, '') || '/';
        const bodyClasses = document.body.className.toLowerCase();

        menuItems.forEach(item => {
            const href = (item.getAttribute('href') || '').toLowerCase().replace(/\/+$/, '');
            if (!href) return;

            // Home check
            if (path === '/' || path === '') {
                if (href === window.location.origin.toLowerCase() || href === '' || href.endsWith('/')) {
                    item.classList.add('active');
                }
                return;
            }

            // Commitment
            if (path.includes('commitment') && href.includes('commitment')) {
                item.classList.add('active');
            }
            // Product & Service
            else if ((path.includes('product') || bodyClasses.includes('product')) && (href.includes('product-service') || href.includes('product'))) {
                item.classList.add('active');
            }
            // Insight
            else if ((path.includes('insight') || bodyClasses.includes('insight') || path.includes('category')) && href.includes('insight')) {
                item.classList.add('active');
            }
            // Careers
            else if ((path.includes('career') || bodyClasses.includes('career')) && (href.includes('career') || href.includes('careers'))) {
                item.classList.add('active');
            }
            // Contact
            else if (path.includes('contact') && href.includes('contact')) {
                item.classList.add('active');
            }
            // General exact path check
            else {
                try {
                    const itemUrl = new URL(item.href, window.location.origin);
                    const itemPath = itemUrl.pathname.toLowerCase().replace(/\/+$/, '');
                    if (itemPath && itemPath !== '/' && path.startsWith(itemPath)) {
                        item.classList.add('active');
                    }
                } catch (e) {}
            }
        });
    };
    setupHeaderActiveNav();

    // 1. Header Scroll State & Mobile Hide/Show Behavior
    const header = document.querySelector('.header');
    const headerLangs = document.querySelectorAll('.header-lang');
    const headerIconMenu = document.querySelector('.header-iconmenu');
    const headerMenu = document.querySelector('.header-menu');

    if (header) {
        let lastScrollY = window.scrollY;
        const scrollThreshold = 8;

        const handleHeaderScroll = () => {
            const currentScrollY = window.scrollY;

            // Desktop logic (> 991px)
            if (window.innerWidth > 991) {
                header.classList.remove('is-hidden');

                if (currentScrollY > 40) {
                    header.classList.add('is-scrolled');
                    // Close language dropdown if scrolling
                    headerLangs.forEach(lang => {
                        lang.classList.remove('is-open');
                        lang.setAttribute('aria-expanded', 'false');
                    });
                } else {
                    header.classList.remove('is-scrolled');
                }
                lastScrollY = currentScrollY <= 0 ? 0 : currentScrollY;
                return;
            }

            // Mobile logic (<= 991px)
            // If mobile menu is open, keep header visible
            const isMenuOpen = headerMenu && headerMenu.classList.contains('active');
            if (isMenuOpen) {
                header.classList.remove('is-hidden');
                lastScrollY = currentScrollY <= 0 ? 0 : currentScrollY;
                return;
            }

            // When at top = 0
            if (currentScrollY <= 0) {
                header.classList.remove('is-hidden');
                header.classList.remove('is-scrolled');
                lastScrollY = 0;
                return;
            }

            const delta = currentScrollY - lastScrollY;

            // Scroll down past header -> Hide header
            if (delta > scrollThreshold && currentScrollY > 60) {
                header.classList.add('is-hidden');
            }
            // Scroll up -> Show header
            else if (delta < -scrollThreshold) {
                header.classList.remove('is-hidden');
            }

            lastScrollY = currentScrollY;
        };

        window.addEventListener('scroll', handleHeaderScroll, { passive: true });
        window.addEventListener('resize', handleHeaderScroll, { passive: true });
        handleHeaderScroll(); // Check on initial page load

        // Handle mobile/tablet menu click
        if (headerIconMenu) {
            headerIconMenu.addEventListener('click', () => {
                headerIconMenu.classList.toggle('active');
                if (headerMenu) headerMenu.classList.toggle('active');
                header.classList.remove('is-hidden');
            });
        }

        // Close mobile menu when clicking menu link
        if (headerMenu) {
            const menuLinks = headerMenu.querySelectorAll('.header-menu-item, .header-cta');
            menuLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (headerIconMenu && headerIconMenu.classList.contains('active')) {
                        headerIconMenu.classList.remove('active');
                        headerMenu.classList.remove('active');
                    }
                });
            });
        }
    }

    // 2. Language Selector Dropdown
    headerLangs.forEach(headerLang => {
        const trigger = headerLang.querySelector('.header-lang-trigger');
        const currentFlag = trigger ? trigger.querySelector('.header-lang-flag') : null;
        const currentCode = trigger ? trigger.querySelector('.header-lang-code') : null;
        const langItems = headerLang.querySelectorAll('.header-lang-item');

        const toggleLangDropdown = (e) => {
            e.stopPropagation();
            const isOpen = headerLang.classList.contains('is-open');
            headerLangs.forEach(hl => {
                hl.classList.remove('is-open');
                hl.setAttribute('aria-expanded', 'false');
            });
            if (!isOpen) {
                headerLang.classList.add('is-open');
                headerLang.setAttribute('aria-expanded', 'true');
            }
        };

        if (trigger) {
            trigger.addEventListener('click', toggleLangDropdown);
        }

        langItems.forEach((item) => {
            item.addEventListener('click', () => {
                headerLangs.forEach(hl => {
                    hl.classList.remove('is-open');
                    hl.setAttribute('aria-expanded', 'false');
                });
            });
        });
    });

    // Close language dropdowns when clicking outside
    document.addEventListener('click', (e) => {
        let clickedInside = false;
        headerLangs.forEach(hl => {
            if (hl.contains(e.target)) clickedInside = true;
        });
        if (!clickedInside) {
            headerLangs.forEach(hl => {
                hl.classList.remove('is-open');
                hl.setAttribute('aria-expanded', 'false');
            });
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            headerLangs.forEach(hl => {
                hl.classList.remove('is-open');
                hl.setAttribute('aria-expanded', 'false');
            });
        }
    });

    // 3. Scroll To Top Button
    const scrollTopBtn = document.getElementById('scrollTopBtn');
    if (scrollTopBtn) {
        const handleScrollBtn = () => {
            if (window.scrollY > 300) {
                scrollTopBtn.classList.add('is-visible');
            } else {
                scrollTopBtn.classList.remove('is-visible');
            }
        };

        window.addEventListener('scroll', handleScrollBtn, { passive: true });
        handleScrollBtn(); // Check on initial page load

        scrollTopBtn.addEventListener('click', () => {
            if (window.lenis) {
                window.lenis.scrollTo(0, { duration: 0.9 });
            } else {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    }

    // 4. Consultation Modal (Triggered by .header-cta and other CTA buttons)
    const consultationModal = document.getElementById('consultationModal');
    const modalCloseBtn = document.getElementById('modalCloseBtn');
    const consultationForm = document.getElementById('consultationForm');
    const consultationTriggers = document.querySelectorAll('.header-cta, [data-modal-target="consultationModal"]');

    if (consultationModal) {
        const openModal = () => {
            consultationModal.classList.add('is-open');
            consultationModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            if (window.lenis) window.lenis.stop();
            // Set focus to the first input
            setTimeout(() => {
                const firstInput = consultationModal.querySelector('input, select, textarea');
                if (firstInput) firstInput.focus();
            }, 100);
        };

        const closeModal = () => {
            consultationModal.classList.remove('is-open');
            consultationModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            if (window.lenis) window.lenis.start();
        };

        // Open modal when clicking CTA trigger buttons
        consultationTriggers.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                openModal();
            });
        });

        // Close button click
        if (modalCloseBtn) {
            modalCloseBtn.addEventListener('click', (e) => {
                e.preventDefault();
                closeModal();
            });
        }

        // Close on backdrop click (click outside modal-container)
        consultationModal.addEventListener('click', (e) => {
            if (e.target === consultationModal) {
                closeModal();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && consultationModal.classList.contains('is-open')) {
                closeModal();
            }
        });

        // Custom Service Dropdown in Modal
        const serviceDropdown = document.getElementById('modalServiceDropdown');
        if (serviceDropdown) {
            const dropdownTrigger = serviceDropdown.querySelector('.custom-dropdown-trigger');
            const dropdownVal = serviceDropdown.querySelector('.custom-dropdown-val');
            const dropdownItems = serviceDropdown.querySelectorAll('.custom-dropdown-item');
            const nativeSelect = serviceDropdown.querySelector('.custom-dropdown-native');

            const openServiceDropdown = () => {
                serviceDropdown.classList.add('is-open');
                if (dropdownTrigger) dropdownTrigger.setAttribute('aria-expanded', 'true');
            };

            const closeServiceDropdown = () => {
                serviceDropdown.classList.remove('is-open');
                if (dropdownTrigger) dropdownTrigger.setAttribute('aria-expanded', 'false');
            };

            const toggleServiceDropdown = (e) => {
                e.stopPropagation();
                if (serviceDropdown.classList.contains('is-open')) {
                    closeServiceDropdown();
                } else {
                    openServiceDropdown();
                }
            };

            if (dropdownTrigger) {
                dropdownTrigger.addEventListener('click', toggleServiceDropdown);
            }

            dropdownItems.forEach((item) => {
                item.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const val = item.dataset.value;
                    const text = item.querySelector('.custom-dropdown-text')?.textContent || '';

                    // Update UI text and states
                    if (dropdownVal) dropdownVal.textContent = text;
                    serviceDropdown.classList.add('has-value');
                    serviceDropdown.classList.remove('has-error');

                    dropdownItems.forEach((i) => i.classList.remove('is-selected'));
                    item.classList.add('is-selected');

                    // Update native select for form validity & submission
                    if (nativeSelect) {
                        nativeSelect.value = val;
                        nativeSelect.dispatchEvent(new Event('change', { bubbles: true }));
                    }

                    closeServiceDropdown();
                });
            });

            // Close when clicking outside dropdown
            document.addEventListener('click', (e) => {
                if (!serviceDropdown.contains(e.target)) {
                    closeServiceDropdown();
                }
            });

            // Close on Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && serviceDropdown.classList.contains('is-open')) {
                    closeServiceDropdown();
                }
            });

            // Helper to reset custom dropdown
            serviceDropdown.resetDropdown = () => {
                if (dropdownVal) dropdownVal.textContent = 'Please select a service';
                serviceDropdown.classList.remove('has-value', 'has-error', 'is-open');
                dropdownItems.forEach((i) => i.classList.remove('is-selected'));
                if (dropdownTrigger) dropdownTrigger.setAttribute('aria-expanded', 'false');
                if (nativeSelect) nativeSelect.value = '';
            };
        }

        // Form submission handling
        if (consultationForm) {
            consultationForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const nativeSelect = document.getElementById('service');

                if (nativeSelect && !nativeSelect.value) {
                    if (serviceDropdown) {
                        serviceDropdown.classList.add('has-error');
                        const trigger = serviceDropdown.querySelector('.custom-dropdown-trigger');
                        if (trigger) trigger.focus();
                    }
                    return;
                }

                const submitBtn = consultationForm.querySelector('.modal-submit-btn');
                const originalText = submitBtn ? submitBtn.innerHTML : '';

                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<span class="txt txt-14 txt-semi">SENDING...</span>';
                }

                setTimeout(() => {
                    if (submitBtn) {
                        submitBtn.innerHTML = '<span class="txt txt-14 txt-semi">SENT SUCCESSFULLY!</span>';
                    }
                    setTimeout(() => {
                        consultationForm.reset();
                        if (serviceDropdown && typeof serviceDropdown.resetDropdown === 'function') {
                            serviceDropdown.resetDropdown();
                        }
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalText;
                        }
                        closeModal();
                    }, 1500);
                }, 800);
            });
        }
    }
});
