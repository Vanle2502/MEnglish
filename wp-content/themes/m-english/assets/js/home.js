document.addEventListener('DOMContentLoaded', () => {
    const hero = document.querySelector('.home-hero');
    const slides = [...document.querySelectorAll('.home-hero__slide')];

    if (!hero || slides.length < 2) return;

    const previousButton = hero.querySelector('.home-hero__arrow--prev');
    const nextButton = hero.querySelector('.home-hero__arrow--next');
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const autoplayDelay = 3000;
    const introDelay = 5200;
    let index = slides.findIndex(slide => slide.classList.contains('is-active'));
    let animating = false;
    let autoplayTimer = 0;
    let introComplete = reducedMotion;

    if (index < 0) index = 0;

    const stopAutoplay = () => {
        window.clearTimeout(autoplayTimer);
        autoplayTimer = 0;
    };

    const scheduleAutoplay = () => {
        stopAutoplay();
        if (document.hidden || hero.matches(':hover') || hero.contains(document.activeElement)) return;
        const delay = introComplete ? autoplayDelay : introDelay;
        autoplayTimer = window.setTimeout(() => {
            introComplete = true;
            show(index + 1, 1);
        }, delay);
    };

    const show = (requestedIndex, direction) => {
        if (animating) return;

        const nextIndex = (requestedIndex + slides.length) % slides.length;
        if (nextIndex === index) return;

        const currentSlide = slides[index];
        const nextSlide = slides[nextIndex];
        const enterClass = direction > 0 ? 'is-from-right' : 'is-from-left';
        const leaveClass = direction > 0 ? 'is-to-left' : 'is-to-right';

        animating = true;
        nextSlide.classList.add('is-preparing', enterClass);
        nextSlide.setAttribute('aria-hidden', 'false');

        // Force the starting position to render before both slides animate.
        void nextSlide.offsetWidth;
        currentSlide.classList.add('is-leaving', leaveClass);
        nextSlide.classList.remove('is-preparing');
        nextSlide.classList.add('is-active');
        currentSlide.classList.remove('is-active');

        const finish = () => {
            currentSlide.classList.remove('is-leaving', leaveClass);
            currentSlide.setAttribute('aria-hidden', 'true');
            nextSlide.classList.remove(enterClass);
            index = nextIndex;
            animating = false;
            scheduleAutoplay();
        };

        if (reducedMotion) {
            finish();
        } else {
            window.setTimeout(finish, 680);
        }
    };

    previousButton?.addEventListener('click', () => {
        stopAutoplay();
        show(index - 1, -1);
    });
    nextButton?.addEventListener('click', () => {
        stopAutoplay();
        show(index + 1, 1);
    });

    hero.addEventListener('mouseenter', stopAutoplay);
    hero.addEventListener('mouseleave', scheduleAutoplay);
    hero.addEventListener('focusin', stopAutoplay);
    hero.addEventListener('focusout', () => window.setTimeout(scheduleAutoplay, 0));
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) stopAutoplay();
        else scheduleAutoplay();
    });

    scheduleAutoplay();
});
