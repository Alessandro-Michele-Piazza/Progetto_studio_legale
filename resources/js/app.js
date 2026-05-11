import './bottone.js';

function initDeferredBootstrapModules() {
    const triggerSelector = '[data-bs-toggle="collapse"], [data-bs-toggle="dropdown"]';

    if (!document.querySelector(triggerSelector)) {
        return;
    }

    let bootstrapPromise = null;
    let isBootstrapReady = false;

    function loadBootstrapModules() {
        if (isBootstrapReady) {
            return Promise.resolve();
        }

        if (!bootstrapPromise) {
            bootstrapPromise = Promise.all([
                import('bootstrap/js/dist/collapse'),
                import('bootstrap/js/dist/dropdown'),
            ]).then(function () {
                isBootstrapReady = true;
                document.removeEventListener('click', handleFirstToggleClick, true);
            });
        }

        return bootstrapPromise;
    }

    function handleFirstToggleClick(event) {
        if (isBootstrapReady) {
            return;
        }

        const toggle = event.target.closest(triggerSelector);
        if (!toggle) {
            return;
        }

        event.preventDefault();
        event.stopPropagation();

        loadBootstrapModules().then(function () {
            toggle.dispatchEvent(new MouseEvent('click', {
                bubbles: true,
                cancelable: true,
                view: window,
            }));
        });
    }

    document.addEventListener('click', handleFirstToggleClick, true);

    const warmupEvents = ['pointerdown', 'keydown', 'touchstart'];
    const warmupBootstrap = function () {
        loadBootstrapModules();
    };

    warmupEvents.forEach(function (eventName) {
        window.addEventListener(eventName, warmupBootstrap, {
            once: true,
            passive: true,
        });
    });
}

function applyBackgroundImage(element) {
    const imageUrl = element.dataset.bg;

    if (!imageUrl || element.dataset.bgLoaded === 'true') {
        return;
    }

    element.style.backgroundImage = 'url(' + imageUrl + ')';
    element.dataset.bgLoaded = 'true';
}

function initLazyBackgrounds() {
    const lazyBackgroundElements = document.querySelectorAll('[data-bg]');

    if (!lazyBackgroundElements.length) {
        return;
    }

    if (!('IntersectionObserver' in window)) {
        lazyBackgroundElements.forEach(applyBackgroundImage);
        return;
    }

    const observer = new IntersectionObserver(function (entries, intersectionObserver) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) {
                return;
            }

            applyBackgroundImage(entry.target);
            intersectionObserver.unobserve(entry.target);
        });
    }, {
        rootMargin: '200px 0px',
    });

    lazyBackgroundElements.forEach(function (element) {
        observer.observe(element);
    });
}

function initDeferredHeroVideo() {
    const heroVideo = document.querySelector('[data-hero-video]');
    const source = heroVideo ? heroVideo.querySelector('source[data-src]') : null;

    if (!heroVideo || !source) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const isSmallScreen = window.matchMedia('(max-width: 767.98px)').matches;

    if (prefersReducedMotion || isSmallScreen) {
        return;
    }

    const loadVideo = function () {
        if (heroVideo.dataset.initialized === 'true') {
            return;
        }

        source.src = source.dataset.src;
        heroVideo.dataset.initialized = 'true';

        heroVideo.addEventListener('loadeddata', function () {
            heroVideo.classList.add('is-ready');
        }, { once: true });

        heroVideo.load();

        const playResult = heroVideo.play();
        if (playResult && typeof playResult.catch === 'function') {
            playResult.catch(function () {
                // Ignore autoplay blocking errors to avoid noisy console logs.
            });
        }
    };

    const scheduleLoad = function () {
        window.setTimeout(loadVideo, 4500);
    };

    if ('requestIdleCallback' in window) {
        requestIdleCallback(scheduleLoad, { timeout: 8000 });
        return;
    }

    window.addEventListener('load', scheduleLoad, { once: true });
}

document.addEventListener('DOMContentLoaded', function () {
    initDeferredBootstrapModules();
    initLazyBackgrounds();
    initDeferredHeroVideo();
});