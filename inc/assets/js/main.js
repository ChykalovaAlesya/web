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
});
