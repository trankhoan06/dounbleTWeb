/**
 * Global JavaScript for Double T Website
 * Handles:
 * 1. Header scroll state (Transparent to White)
 * 2. Language Selector Dropdown
 * 3. Scroll To Top button
 */
document.addEventListener('DOMContentLoaded', () => {
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
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
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
