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
            colors: {
                'primary-green': {
                    // Lighter variants (for backgrounds, hover states)
                    '50': '#f0f9f4',
                    '100': '#dcf2e3',
                    '200': '#bce5ca',
                    '300': '#8bd2a6',
                    '400': '#53b87d',
                    // Base color
                    '500': '#02743D', // Your original primary
                    // Darker variants (for hover states, text on light backgrounds)
                    '600': '#016233',
                    '700': '#015029',
                    '800': '#014122', // Your current rgb(13,72,45) equivalent
                    '900': '#00351c',
                    '950': '#001c0f',
                },
                'primary-gold': 'rgb(192,152,49)',


            },
            fontFamily: {
                source: ['Source Sans 3', 'sans-serif'],
                inter: ['Inter', 'sans-serif'],
                sans: ['Open Sans', 'sans-serif'],
                playfair: ['Playfair Display', 'serif'],
                moda: ['Bodoni Moda', 'serif'],
                sora: ['Sora', 'sans-serif'],
                noto: ['Noto Sans', 'sans-serif']
            },
            fontSize: {
                'xm': '13px',
                'sm+': '15px',
                'base+': '17px',
                '1.5xl': ['1.375rem', { lineHeight: '1.45' }], // previous one
                '2.5xl': ['1.6875rem', { lineHeight: '1.47' }],
            }
        },
    },

    plugins: [forms, typography],
};
