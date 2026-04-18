import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('themeSwitcher', () => ({
    mode: localStorage.getItem('nbtech-theme') ?? 'system',
    resolvedMode: 'light',
    mediaQuery: null,
    init() {
        this.mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
        this.resolvedMode = this.mediaQuery.matches ? 'dark' : 'light';
        this.mediaQuery.addEventListener('change', (event) => {
            this.resolvedMode = event.matches ? 'dark' : 'light';

            if (this.mode === 'system') {
                this.applyTheme('system');
            }
        });

        this.applyTheme(this.mode);
    },
    setTheme(next) {
        this.mode = next;
        localStorage.setItem('nbtech-theme', next);
        this.applyTheme(next);
    },
    applyTheme(mode) {
        const systemPrefersDark = this.mediaQuery ? this.mediaQuery.matches : window.matchMedia('(prefers-color-scheme: dark)').matches;
        const isDark = mode === 'dark' || (mode === 'system' && systemPrefersDark);

        this.resolvedMode = isDark ? 'dark' : 'light';

        document.documentElement.classList.toggle('dark', isDark);
    },
}));

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
        event: 'page_viewed',
        path: window.location.pathname,
        title: document.title,
    });

    document.addEventListener('click', (event) => {
        const upButton = event.target.closest('[data-step-up]');
        const downButton = event.target.closest('[data-step-down]');
        const analyticsTarget = event.target.closest('[data-analytics-event]');

        if (analyticsTarget) {
            window.dataLayer.push({
                event: analyticsTarget.dataset.analyticsEvent,
                context: analyticsTarget.dataset.analyticsContext || null,
                label: analyticsTarget.dataset.analyticsLabel || null,
                href: analyticsTarget.getAttribute('href') || null,
                path: window.location.pathname,
            });
        }

        if (!upButton && !downButton) {
            return;
        }

        const targetId = upButton?.dataset.stepUp ?? downButton?.dataset.stepDown;
        const input = document.getElementById(targetId);

        if (!input || input.disabled) {
            return;
        }

        if (upButton) {
            input.stepUp();
        } else {
            input.stepDown();
        }

        input.dispatchEvent(new Event('input', { bubbles: true }));
        input.dispatchEvent(new Event('change', { bubbles: true }));
    });

    document.addEventListener('submit', (event) => {
        const form = event.target;

        if (!(form instanceof HTMLFormElement)) {
            return;
        }

        window.dataLayer.push({
            event: 'form_submitted',
            form_action: form.getAttribute('action'),
            form_id: form.getAttribute('id') || null,
            path: window.location.pathname,
        });
    });

    const targets = document.querySelectorAll('[data-reveal]');

    targets.forEach((target, index) => {
        const delay = Math.min((index % 4) * 28, 84);
        target.style.transitionDelay = `${delay}ms`;
    });

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting && entry.intersectionRatio >= 0.08) {
                    entry.target.classList.add('revealed');
                } else if (entry.intersectionRatio === 0) {
                    entry.target.classList.remove('revealed');
                }
            });
        },
        {
            threshold: [0, 0.08, 0.2],
            rootMargin: '0px 0px -2% 0px',
        },
    );

    targets.forEach((target) => observer.observe(target));
});
