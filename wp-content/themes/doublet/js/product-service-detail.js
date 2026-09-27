/**
 * Double T - Product Service Detail Script
 */

function initOtherProductsSwiper() {
    const otherSliderEl = document.querySelector('#psdOtherSlider') || document.querySelector('#psdOtherSwiper') || document.querySelector('.psd-other-slider');
    if (!otherSliderEl) return;

    if (otherSliderEl.swiper) {
        return;
    }

    if (typeof Swiper === 'undefined') {
        // Retry once Swiper is available
        let retryCount = 0;
        const checkSwiper = setInterval(() => {
            retryCount++;
            if (typeof Swiper !== 'undefined') {
                clearInterval(checkSwiper);
                initOtherProductsSwiper();
            } else if (retryCount > 50) {
                clearInterval(checkSwiper);
            }
        }, 100);
        return;
    }

    const wrap = otherSliderEl.closest('.psd-other-slider-wrap') || otherSliderEl.parentElement || document;
    const nextBtn = wrap.querySelector('#psdOtherNext') || wrap.querySelector('.psd-other-next') || document.querySelector('#psdOtherNext');
    const prevBtn = wrap.querySelector('#psdOtherPrev') || wrap.querySelector('.psd-other-prev') || document.querySelector('#psdOtherPrev');
    const paginationEl = wrap.querySelector('#psdOtherPagination') || wrap.querySelector('.psd-other-pagination') || document.querySelector('#psdOtherPagination');

    new Swiper(otherSliderEl, {
        slidesPerView: 1.15,
        slidesPerGroup: 1,
        spaceBetween: 16,
        speed: 600,
        grabCursor: true,
        watchOverflow: true,
        observer: true,
        observeParents: true,
        resizeObserver: true,
        navigation: {
            nextEl: nextBtn,
            prevEl: prevBtn,
        },
        pagination: {
            el: paginationEl,
            clickable: true,
        },
        breakpoints: {
            576: {
                slidesPerView: 1.6,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2.2,
                spaceBetween: 24,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 32,
            },
        },
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initOtherProductsSwiper);
} else {
    initOtherProductsSwiper();
}
