// Scroll reveal
const revealElements = document.querySelectorAll('.reveal');
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
            setTimeout(() => entry.target.classList.add('visible'), i * 100);
        }
    });
}, {
    threshold: 0.1
});
revealElements.forEach(el => observer.observe(el));

// Nav transparency on scroll
const nav = document.querySelector('nav');
window.addEventListener('scroll', () => {
    if (window.scrollY > 60) {
        nav.style.background = 'rgba(13,27,42,0.97)';
    } else {
        nav.style.background = 'rgba(13,27,42,0.92)';
    }
});