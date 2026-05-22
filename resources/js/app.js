import './bootstrap';

document.addEventListener('click', (event) => {
    const button = event.target.closest('[data-mobile-toggle]');
    if (!button) return;

    const targetId = button.getAttribute('data-mobile-toggle');
    const target = targetId ? document.getElementById(targetId) : null;
    if (!target) return;

    const isHidden = target.classList.contains('hidden');
    target.classList.toggle('hidden', !isHidden);
});
