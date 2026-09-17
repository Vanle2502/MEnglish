document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const motionElements = [...document.querySelectorAll('[data-motion]')];
    const panScopes = [...document.querySelectorAll('[data-pan-scope]')];

    if (panScopes.length) {
        body.classList.add('pan-motion-ready');

        if (reducedMotion.matches || !('IntersectionObserver' in window)) {
            panScopes.forEach((scope) => scope.classList.add('is-pan-visible'));
        } else {
            const panObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    const scope = entry.target;

                    if (entry.isIntersecting) {
                        const isReturning = scope.dataset.panSeen === 'true';
                        scope.dataset.panSeen = 'true';
                        scope.classList.remove('is-pan-exiting');

                        if (!isReturning) {
                            scope.classList.add('is-pan-visible');
                            return;
                        }

                        scope.classList.add('is-pan-resetting');
                        window.requestAnimationFrame(() => {
                            window.requestAnimationFrame(() => {
                                scope.classList.remove('is-pan-resetting');
                                scope.classList.add('is-pan-visible');
                            });
                        });
                        return;
                    }

                    if (scope.dataset.panSeen === 'true') {
                        scope.classList.remove('is-pan-visible');
                        scope.classList.add('is-pan-exiting');
                    }
                });
            }, {
                threshold: 0.18,
                rootMargin: '-5% 0px -5% 0px',
            });

            window.requestAnimationFrame(() => {
                panScopes.forEach((scope) => panObserver.observe(scope));
            });
        }
    }

    if (motionElements.length) {
        body.classList.add('motion-observer-ready');
        const motionScopes = [...document.querySelectorAll('[data-motion-scope]')];
        const standaloneElements = motionElements.filter((element) => !element.closest('[data-motion-scope]'));
        let userHasScrolled = window.scrollY > 4;
        let scrollFrame = 0;

        const showElement = (element) => {
            if (element.classList.contains('is-motion-visible')) return;
            element.classList.add('is-motion-visible');

            if (reducedMotion.matches) {
                element.classList.add('is-motion-complete');
                return;
            }

            const finish = (event) => {
                if (event.target !== element) return;
                element.classList.add('is-motion-complete');
                element.removeEventListener('transitionend', finish);
            };
            element.addEventListener('transitionend', finish);
        };

        const showScope = (scope) => {
            if (scope.classList.contains('is-motion-scope-visible')) return;
            scope.classList.add('is-motion-scope-visible');
            scope.querySelectorAll('[data-motion]').forEach(showElement);
        };

        const revealVisibleScopes = () => {
            scrollFrame = 0;
            if (!userHasScrolled) return;

            motionScopes.forEach((scope) => {
                if (scope.classList.contains('is-motion-scope-visible')) return;
                const bounds = scope.getBoundingClientRect();
                if (bounds.top <= window.innerHeight * 0.9 && bounds.bottom >= 0) {
                    showScope(scope);
                }
            });
        };

        const handleScroll = () => {
            userHasScrolled = true;
            if (scrollFrame) return;
            scrollFrame = window.requestAnimationFrame(revealVisibleScopes);
        };

        if (reducedMotion.matches || !('IntersectionObserver' in window)) {
            motionScopes.forEach(showScope);
            standaloneElements.forEach(showElement);
        } else {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    if (!userHasScrolled) return;
                    showScope(entry.target);
                    observer.unobserve(entry.target);
                });
            }, {
                threshold: 0.05,
                rootMargin: '0px 0px -5% 0px',
            });

            // Wait one frame so the browser commits each preset's start state.
            window.requestAnimationFrame(() => {
                motionScopes.forEach((scope) => observer.observe(scope));
                standaloneElements.forEach((element) => {
                    const standaloneObserver = new IntersectionObserver((entries) => {
                        if (!entries[0]?.isIntersecting) return;
                        showElement(element);
                        standaloneObserver.disconnect();
                    }, { threshold: 0.15 });
                    standaloneObserver.observe(element);
                });
            });

            window.addEventListener('scroll', handleScroll, { passive: true });
        }
    }

    if (!body.classList.contains('home')) {
        return;
    }

    if (reducedMotion.matches) {
        body.classList.add('is-home-intro-complete');
        return;
    }

    // Release compositor layers after the opening sequence has settled.
    window.setTimeout(() => {
        body.classList.add('is-home-intro-complete');
    }, 5200);
});
