document.addEventListener('DOMContentLoaded', () => {
    const sliderEl = document.querySelector('.commit-capabilities-slider');

    if (!sliderEl || typeof Swiper === 'undefined') return;

    const prevButton = sliderEl.querySelector('.commit-capabilities-prev');
    const nextButton = sliderEl.querySelector('.commit-capabilities-next');
    const nextTab = sliderEl.querySelector('.commit-capabilities-next-tab');
    const progressBar = sliderEl.querySelector('.commit-capabilities-progress-bar');
    const nextItems = Array.from(sliderEl.querySelectorAll('.commit-capabilities-next-item'));
    const totalSlides = sliderEl.querySelectorAll('.commit-capabilities-slide').length;

    const updateControls = (swiper) => {
        const currentIndex = swiper.realIndex;
        const nextIndex = (currentIndex + 1) % totalSlides;

        if (progressBar) {
            progressBar.style.transform = `scaleX(${(currentIndex + 1) / totalSlides})`;
        }

        nextItems.forEach((item) => {
            const itemIndex = Number.parseInt(item.dataset.slideIndex, 10);
            item.classList.toggle('active', itemIndex === nextIndex);
        });
    };

    const capabilitiesSwiper = new Swiper(sliderEl, {
        effect: 'fade',
        fadeEffect: {
            crossFade: true,
        },
        slidesPerView: 1,
        speed: 600,
        allowTouchMove: true,
        navigation: {
            prevEl: prevButton,
            nextEl: nextButton,
        },
        on: {
            init(swiper) {
                updateControls(swiper);
            },
            slideChange(swiper) {
                updateControls(swiper);
            },
        },
    });

    if (nextTab) {
        nextTab.addEventListener('click', () => {
            capabilitiesSwiper.slideNext();
        });
    }
});
