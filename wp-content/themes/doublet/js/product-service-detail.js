document.addEventListener('DOMContentLoaded', () => {
    // Initialize Other Products Swiper Slider
    const otherSliderEl = document.querySelector('#psdOtherSlider');
    if (otherSliderEl && typeof Swiper !== 'undefined') {
        const nextBtn = document.querySelector('#psdOtherNext');
        const prevBtn = document.querySelector('#psdOtherPrev');
        const paginationEl = document.querySelector('#psdOtherPagination');

        new Swiper(otherSliderEl, {
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
});
