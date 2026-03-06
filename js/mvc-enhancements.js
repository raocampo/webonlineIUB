document.addEventListener('DOMContentLoaded', function () {
    const backTop = document.getElementById('ux-backtop');
    if (!backTop) {
        return;
    }

    const toggleButton = function () {
        if (window.scrollY > 320) {
            backTop.classList.add('show');
            backTop.setAttribute('aria-hidden', 'false');
        } else {
            backTop.classList.remove('show');
            backTop.setAttribute('aria-hidden', 'true');
        }
    };

    window.addEventListener('scroll', toggleButton, { passive: true });

    backTop.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    toggleButton();

    const detailTitles = document.querySelectorAll('.ux-legacy-shell--carreras .titulo-click');
    detailTitles.forEach(function (title) {
        const detail = title.closest('.detalle');
        const content = detail ? detail.querySelector('.contenido') : null;
        if (!content) {
            return;
        }

        title.setAttribute('role', 'button');
        title.setAttribute('tabindex', '0');
        title.setAttribute('aria-expanded', 'false');

        if (!content.dataset.enhanced) {
            content.dataset.enhanced = '1';
            content.style.display = 'none';
        }

        const toggleDetail = function () {
            const isVisible = content.style.display !== 'none';
            content.style.display = isVisible ? 'none' : 'block';
            title.setAttribute('aria-expanded', isVisible ? 'false' : 'true');
        };

        title.addEventListener('click', toggleDetail);
        title.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                toggleDetail();
            }
        });
    });

    const revealItems = document.querySelectorAll('.ux-legacy-shell .tarjeta-evento, .ux-legacy-shell .detalle, .ux-legacy-shell .faq-item');
    revealItems.forEach(function (item, index) {
        item.style.transition = 'transform 0.25s ease, opacity 0.25s ease';
        item.style.opacity = '0';
        item.style.transform = 'translateY(8px)';

        setTimeout(function () {
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, 35 * index);
    });
});
