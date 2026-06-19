// Sticky header on scroll
document.addEventListener('scroll', function () {
    const header = document.querySelector('header#masthead');
    if (!header) return;
    if (window.scrollY > 1) {
        header.classList.add('sticky');
    } else {
        header.classList.remove('sticky');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // --- Expandable header search ---
    const search = document.querySelector('.header-search');
    if (search) {
        const toggle = search.querySelector('.header-search__toggle');
        const field = search.querySelector('.header-search__field');

        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            const willOpen = !search.classList.contains('is-open');
            search.classList.toggle('is-open', willOpen);
            if (willOpen) {
                field.focus();
            } else if (!field.value) {
                // keep closed
            }
        });

        // Close when clicking outside (only if empty)
        document.addEventListener('click', function (e) {
            if (search.classList.contains('is-open') && !search.contains(e.target) && !field.value) {
                search.classList.remove('is-open');
            }
        });
    }

    // --- Styled CF7 file dropzone: show the chosen file name ---
    function ccfRenderFile(input) {
        const drop = input.closest('.ccf__drop');
        if (!drop) return;
        const inner = drop.querySelector('.ccf__drop-inner');
        if (!inner) return;
        if (!inner.dataset.default) inner.dataset.default = inner.innerHTML;
        if (input.files && input.files.length) {
            const names = Array.from(input.files).map(f => f.name).join(', ');
            const p = document.createElement('p');
            p.className = 'ccf__file-name';
            p.textContent = '✓ ' + names;
            inner.innerHTML = '';
            inner.appendChild(p);
            drop.classList.add('has-file');
        } else {
            inner.innerHTML = inner.dataset.default;
            drop.classList.remove('has-file');
        }
    }
    document.addEventListener('change', function (e) {
        if (e.target && e.target.matches('.ccf__field--file input[type="file"]')) {
            ccfRenderFile(e.target);
        }
    });
    // Reset the dropzone label after a successful send / form reset
    document.addEventListener('wpcf7mailsent', function (e) {
        e.target.querySelectorAll('.ccf__field--file input[type="file"]').forEach(ccfRenderFile);
    });
    document.addEventListener('wpcf7reset', function (e) {
        e.target.querySelectorAll('.ccf__field--file input[type="file"]').forEach(ccfRenderFile);
    });

    // --- Horizontal card sliders (Виграні справи / Практика) ---
    // Each .fp-nav drives the scroll track (.fp-cases__grid) in its section.
    document.querySelectorAll('.fp-nav').forEach(function (nav) {
        const section = nav.closest('section') || document;
        const track = section.querySelector('.fp-cases__grid, .fp-articles__grid');
        if (!track) return;
        const prev = nav.querySelector('[data-dir="prev"]');
        const next = nav.querySelector('[data-dir="next"]');

        function step() {
            const card = track.querySelector(':scope > *');
            if (!card) return track.clientWidth;
            const cs = getComputedStyle(track);
            const gap = parseInt(cs.columnGap || cs.gap, 10) || 16;
            return card.getBoundingClientRect().width + gap;
        }
        function update() {
            const max = track.scrollWidth - track.clientWidth - 1;
            const noOverflow = track.scrollWidth <= track.clientWidth + 2;
            nav.classList.toggle('is-hidden', noOverflow);
            if (prev) prev.disabled = track.scrollLeft <= 0;
            if (next) next.disabled = track.scrollLeft >= max;
        }
        if (prev) prev.addEventListener('click', function () {
            track.scrollBy({ left: -step(), behavior: 'smooth' });
        });
        if (next) next.addEventListener('click', function () {
            track.scrollBy({ left: step(), behavior: 'smooth' });
        });
        track.addEventListener('scroll', update, { passive: true });
        window.addEventListener('resize', update);
        update();
    });

    // --- Services mega menu: click/keyboard toggle (hover handled by CSS) ---
    const mega = document.querySelector('.has-mega');
    if (mega) {
        const megaToggle = mega.querySelector('.mega-toggle');
        megaToggle.addEventListener('click', function (e) {
            // Allow anchor jump on desktop hover; toggle for touch/keyboard
            e.preventDefault();
            mega.classList.toggle('is-open');
        });
        document.addEventListener('click', function (e) {
            if (!mega.contains(e.target)) {
                mega.classList.remove('is-open');
            }
        });
    }

    // --- FAQ: single-open accordion (opening one closes the others) ---
    document.querySelectorAll('.fp-faq__list').forEach(function (list) {
        const items = list.querySelectorAll('details.faq-item');
        items.forEach(function (item) {
            item.addEventListener('toggle', function () {
                if (item.open) {
                    items.forEach(function (other) {
                        if (other !== item) other.open = false;
                    });
                }
            });
        });
    });

    // --- Services cards: whole card opens its side panel (the inner button
    // opens the Telegram popup; popups.js stops its click from bubbling here).
    // The click itself is wired via the .open-popup class in popups.js — here
    // we only make the card feel clickable + support keyboard (role="button").
    document.querySelectorAll('.svc-card.open-popup, .svc-wide.open-popup').forEach(function (card) {
        card.style.cursor = 'pointer';
        card.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                card.click();
            }
        });
    });

    // --- Telegram button: docked in the hero (Figma) until the hero scrolls
    // out of view, then floats fixed in the viewport bottom-right. ---
    (function () {
        const btn = document.querySelector('.fp-tg-float');
        const hero = document.querySelector('.fp-hero');
        if (!btn || !hero) return;
        function onScroll() {
            // float once the hero's bottom edge is above the viewport bottom
            btn.classList.toggle('is-floating', hero.getBoundingClientRect().bottom < window.innerHeight);
        }
        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll);
        onScroll();
    })();
});
