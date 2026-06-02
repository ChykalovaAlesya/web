document.addEventListener('scroll', function() {
    const header = document.querySelector('header#masthead');
    if (window.scrollY > 1) {
        header.classList.add('sticky');
    } else {
        header.classList.remove('sticky');
    }
});
