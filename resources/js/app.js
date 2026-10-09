import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Custom Alpine store or directives if needed
document.addEventListener('alpine:init', () => {
    Alpine.store('app', {
        mobileMenuOpen: false,
        scrolled: false,
    });
});

Alpine.start();
