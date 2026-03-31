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



/**
 * Lança um Toast dinâmico na tela.
 * @param {string} tipo - 'sucesso', 'erro', 'info', 'alerta'
 * @param {string} mensagem - A mensagem a ser exibida
 */
function lancarToast(tipo, mensagem) {
    const tipos = {
        'sucesso': 'text-bg-success',
        'erro': 'text-bg-danger',
        'info': 'text-bg-info',
        'alerta': 'text-bg-warning'
    };

    const bgClass = tipos[tipo] || 'text-bg-primary';
    const textClass = tipo === 'alerta' ? 'text-dark' : 'text-white';
    const btnCloseClass = tipo === 'alerta' ? '' : 'btn-close-white';

    let toastContainer = document.querySelector('.toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3 mt-5';
        toastContainer.style.zIndex = '1055';
        document.body.appendChild(toastContainer);
    }

    const toastId = 'toast-' + Date.now();
    const toastHtml = `
    <div id="${toastId}" class="toast align-items-center ${bgClass} ${textClass} border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          ${mensagem}
        </div>
        <button type="button" class="btn-close ${btnCloseClass} me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  `;

    toastContainer.insertAdjacentHTML('beforeend', toastHtml);

    const toastElement = document.getElementById(toastId);
    const toast = new bootstrap.Toast(toastElement);
    toast.show();

    toastElement.addEventListener('hidden.bs.toast', () => {
        toastElement.remove();
    });
}

// Contact form loading state
document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Enviando...';
            }
        });
    }
});