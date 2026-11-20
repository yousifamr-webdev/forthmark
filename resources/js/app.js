import './bootstrap';

const themeToggles = document.querySelectorAll('[data-theme-toggle]');

if (themeToggles.length > 0) {
    const syncThemeToggles = () => {
        const isDark = document.documentElement.classList.contains('dark');

        themeToggles.forEach((toggle) => {
            toggle.setAttribute('aria-pressed', String(isDark));
            toggle.setAttribute('aria-label', `Switch to ${isDark ? 'light' : 'dark'} mode`);
        });
    };

    syncThemeToggles();

    themeToggles.forEach((toggle) => {
        toggle.addEventListener('click', () => {
            const isDark = document.documentElement.classList.toggle('dark');

            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            syncThemeToggles();
        });
    });
}