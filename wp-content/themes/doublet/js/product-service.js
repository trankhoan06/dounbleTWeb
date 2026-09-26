document.addEventListener('DOMContentLoaded', () => {
    const tabs = Array.from(document.querySelectorAll('[data-service-tab]'));
    const sections = Array.from(document.querySelectorAll('[data-service-section]'));

    if (!tabs.length || !sections.length) return;

    const setActiveTab = (sectionId) => {
        tabs.forEach((tab) => {
            const isActive = tab.dataset.serviceTab === sectionId;
            tab.classList.toggle('active', isActive);

            if (isActive) {
                tab.setAttribute('aria-current', 'true');
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
});
