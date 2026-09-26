/**
 * Double T - Insight Article Detail Page Script
 * Features:
 * 1. IntersectionObserver / ScrollSpy for Table of Contents
 * 2. Smooth scrolling to article sections with sticky header offset
 * 3. Copy Link to clipboard with animated Double T Toast Notification
 * 4. Dynamic query parameter parser (?id=... / ?slug=...) loading from data/insights.json
 */

document.addEventListener('DOMContentLoaded', () => {
    initScrollSpy();
    initCopyLink();
    initArticleRouting();
    initRelatedSwiper();
});

/**
 * 1. ScrollSpy for Table of Contents
 */
function initScrollSpy() {
    const tocLinks = document.querySelectorAll('.detail-toc-link');
    const sections = document.querySelectorAll('.detail-section');

    if (!tocLinks.length || !sections.length) return;

    // Smooth scroll on click
    tocLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);

            if (targetSection) {
                const header = document.querySelector('.header') || document.querySelector('header');
                const headerHeight = header ? header.offsetHeight : 100;
                const targetPosition = targetSection.getBoundingClientRect().top + window.scrollY - headerHeight - 24;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });

                // Update active class immediately
                setActiveToc(link);
            }
        });
    });

    // Scroll listener for active link detection
    function onScroll() {
        const header = document.querySelector('.header') || document.querySelector('header');
        const headerHeight = header ? header.offsetHeight : 100;
        const scrollPosition = window.scrollY + headerHeight + 60;

        let currentSectionId = '';

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;

            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                currentSectionId = section.getAttribute('id');
            }
        });

        // If at the top of first section
        if (!currentSectionId && sections.length > 0) {
            if (scrollPosition < sections[0].offsetTop) {
                currentSectionId = sections[0].getAttribute('id');
            } else if (scrollPosition >= sections[sections.length - 1].offsetTop) {
                currentSectionId = sections[sections.length - 1].getAttribute('id');
            }
        }

        if (currentSectionId) {
            tocLinks.forEach(link => {
                if (link.getAttribute('href') === `#${currentSectionId}`) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll(); // initial check
}

function setActiveToc(activeLink) {
    document.querySelectorAll('.detail-toc-link').forEach(link => link.classList.remove('active'));
    activeLink.classList.add('active');
}

/**
 * 2. Copy Link Button with Toast Notification
 */
function initCopyLink() {
    const copyBtn = document.getElementById('btnCopyLink');
    const toast = document.getElementById('copyToast');

    if (!copyBtn || !toast) return;

    let toastTimer = null;

    copyBtn.addEventListener('click', async () => {
        try {
            await navigator.clipboard.writeText(window.location.href);
            showToast('Link copied to clipboard!');
        } catch (err) {
            // Fallback for non-HTTPS / restricted environments
            const tempInput = document.createElement('input');
            tempInput.value = window.location.href;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            showToast('Link copied to clipboard!');
        }
    });

    function showToast(message) {
        const toastText = toast.querySelector('.detail-toast-text');
        if (toastText) toastText.textContent = message;

        toast.classList.add('show');
        toast.setAttribute('aria-hidden', 'false');

        if (toastTimer) clearTimeout(toastTimer);
        toastTimer = setTimeout(() => {
            toast.classList.remove('show');
            toast.setAttribute('aria-hidden', 'true');
        }, 3000);
    }
}

/**
 * 3. Dynamic Article Data Loader (via ?id=... or ?slug=...)
 */
async function initArticleRouting() {
    const params = new URLSearchParams(window.location.search);
    const postId = params.get('id');
    const postSlug = params.get('slug');

    if (!postId && !postSlug) return;

    try {
        const res = await fetch('./data/insights.json');
        if (!res.ok) return;

        const categories = await res.json();
        let targetPost = null;
        let parentCat = null;

        // Search through all posts across categories
        for (const cat of categories) {
            if (cat.featuredPost && (String(cat.featuredPost.id) === postId || cat.featuredPost.slug === postSlug)) {
                targetPost = cat.featuredPost;
                parentCat = cat;
                break;
            }
            if (cat.subPosts) {
                const found = cat.subPosts.find(p => String(p.id) === postId || p.slug === postSlug);
                if (found) {
                    targetPost = found;
                    parentCat = cat;
                    break;
                }
            }
            if (cat.listingPosts) {
                const found = cat.listingPosts.find(p => String(p.id) === postId || p.slug === postSlug);
                if (found) {
                    targetPost = found;
                    parentCat = cat;
                    break;
                }
            }
        }

        if (targetPost) {
            renderArticleData(targetPost, parentCat);
        }
    } catch (e) {
        console.warn('Could not load dynamic article data:', e);
    }
}

function initRelatedSwiper() {
    const swiperEl = document.getElementById('relatedArticlesGrid');
    if (swiperEl && typeof Swiper !== 'undefined') {
        const nextBtn = document.querySelector('#psdOtherNext');
        const prevBtn = document.querySelector('#psdOtherPrev');
        new Swiper(swiperEl, {
            slidesPerView: 1.15,
            slidesPerGroup: 1,
            spaceBetween: 16,
            speed: 600,
            grabCursor: true,
            watchOverflow: true,
            navigation: {
                nextEl: nextBtn,
                prevEl: prevBtn,
            },
            breakpoints: {
                390: {
                    slidesPerView: 1.2,
                    spaceBetween: 16,
                },
                768: {
                    slidesPerView: 2.5,
                    spaceBetween: 24,
                },
                992: {
                    slidesPerView: 4,
                    spaceBetween: 32,
                },
            },
        });
    }
}

function renderArticleData(post, cat) {
    const titleEl = document.getElementById('detailHeroTitle');
    const breadcrumbCurrent = document.getElementById('breadcrumbCurrent');
    const breadcrumbCategory = document.getElementById('breadcrumbCategory');
    const featuredImg = document.getElementById('detailFeaturedImg');

    if (titleEl && post.title) {
        titleEl.textContent = post.title;
        document.title = `${post.title} | Double T Insights`;
    }

    if (breadcrumbCurrent && post.title) {
        breadcrumbCurrent.textContent = post.title.length > 25 ? post.title.substring(0, 25) + '...' : post.title;
    }

    if (breadcrumbCategory && cat) {
        breadcrumbCategory.textContent = cat.name;
        breadcrumbCategory.href = `./insight-category.html?category=${cat.slug || cat.id}`;
    }

    if (featuredImg && post.image) {
        featuredImg.src = post.image;
        if (post.alt) featuredImg.alt = post.alt;
    }

    // Dynamic Previous / Next Article Links
    const navPrevPost = document.getElementById('navPrevPost');
    const navNextPost = document.getElementById('navNextPost');
    const navPrevTitle = document.getElementById('navPrevTitle');
    const navNextTitle = document.getElementById('navNextTitle');

    if (cat) {
        const allPosts = [cat.featuredPost, ...(cat.subPosts || []), ...(cat.listingPosts || [])].filter(Boolean);
        const currentIndex = allPosts.findIndex(p => String(p.id) === String(post.id));

        if (currentIndex !== -1 && allPosts.length > 1) {
            const prevIndex = (currentIndex - 1 + allPosts.length) % allPosts.length;
            const nextIndex = (currentIndex + 1) % allPosts.length;

            if (navPrevPost && navPrevTitle && allPosts[prevIndex]) {
                navPrevPost.href = `./insight-detail.html?id=${allPosts[prevIndex].id}`;
                navPrevTitle.textContent = allPosts[prevIndex].title;
            }
            if (navNextPost && navNextTitle && allPosts[nextIndex]) {
                navNextPost.href = `./insight-detail.html?id=${allPosts[nextIndex].id}`;
                navNextTitle.textContent = allPosts[nextIndex].title;
            }
        }
    }
}
