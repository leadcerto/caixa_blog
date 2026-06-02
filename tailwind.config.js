import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                // ── Paleta Caixa Econômica Federal ──────────────────────────
                'caixa-blue':       '#0072C6',
                'caixa-blue-dark':  '#005BA0',
                'caixa-blue-light': '#E6F2FB',

                'caixa-orange':       '#F7941E',
                'caixa-orange-dark':  '#E07E0F',
                'caixa-orange-light': '#FEF3E2',

                // ── Semântica de texto ───────────────────────────────────────
                'text-primary':   '#0F172A',
                'text-secondary': '#475569',
                'text-muted':     '#94A3B8',

                // ── Semântica de superfícies ─────────────────────────────────
                'surface':       '#FFFFFF',
                'surface-alt':   '#F8FAFC',
                'surface-muted': '#F1F5F9',

                // ── Borda padrão ─────────────────────────────────────────────
                'border': '#E2E8F0',
            },
        },
    },

    plugins: [forms, typography],
};
