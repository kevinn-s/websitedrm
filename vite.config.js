import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

/** @type {import('tailwindcss').Config} */
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        import('@tailwindcss/line-clamp'),
    ],
});
