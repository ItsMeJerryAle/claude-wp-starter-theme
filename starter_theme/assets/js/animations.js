/**
 * Entrance animations — fade slide up
 * Observes all [data-animate] elements and adds .is-visible when scrolled into view.
 * Use data-delay="300" (ms) to stagger.
 */
(function () {
    var els = document.querySelectorAll('[data-animate]');
    if (!els.length) return;

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                var el    = entry.target;
                var delay = parseInt(el.getAttribute('data-delay') || 0, 10);
                setTimeout(function () {
                    el.classList.add('is-visible');
                }, delay);
                observer.unobserve(el);
            }
        });
    }, { threshold: 0.12 });

    els.forEach(function (el) { observer.observe(el); });
})();
