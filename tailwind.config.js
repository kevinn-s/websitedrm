// tailwind.config.js
/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.{js,jsx,ts,tsx,blade.php,php}',
        './storage/framework/views/*.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    // Only add if you need JS-based customization
    // theme: { ... },
    // plugins: [],
    theme: {
        extend: {
            colors: {
                'primary-green': {
                    '50': 'rgb(240, 249, 244)',
                    '100': 'rgb(220, 242, 227)',
                    '200': 'rgb(188, 229, 202)',
                    '300': 'rgb(139, 210, 166)',
                    '400': 'rgb(83, 184, 125)',
                    '500': 'rgb(2, 116, 61)',
                    '600': 'rgb(1, 98, 51)',
                    '700': 'rgb(1, 80, 41)',
                    '800': 'rgb(1, 65, 34)',
                    '900': 'rgb(0, 53, 28)',
                    '950': 'rgb(0, 28, 15)',
                },
                'primary-gold': {
                    '50': 'rgb(253, 250, 242)',
                    '100': 'rgb(250, 243, 223)',
                    '200': 'rgb(245, 231, 191)',
                    '300': 'rgb(237, 213, 147)',
                    '400': 'rgb(220, 187, 90)',
                    '500': 'rgb(192, 152, 49)',
                    '600': 'rgb(163, 128, 38)',
                    '700': 'rgb(135, 105, 30)',
                    '800': 'rgb(110, 86, 26)',
                    '900': 'rgb(90, 70, 22)',
                    '950': 'rgb(48, 37, 12)',
                },
            },
            fontSize: {
                'xm': ['13px', { lineHeight: '1.43' }],      // 18.59px ≈ 19px
                'sm+': ['15px', { lineHeight: '1.47' }],     // 22.05px ≈ 22px
                'base+': ['17px', { lineHeight: '1.5' }],    // 25.5px ≈ 26px
                'lg+': ['19px', { lineHeight: '1.5' }],      // 28.5px ≈ 29px
                '1.5xl': ['22px', { lineHeight: '1.36' }],   // 29.92px ≈ 30px
                '2.5xl': ['27px', { lineHeight: '1.26' }],   // 34.02px ≈ 34px
                '3.5xl': ['33px', { lineHeight: '1.15' }],   // 37.95px ≈ 38px
                '4.5xl': ['42px', { lineHeight: '1.05' }],   // 44.1px ≈ 44px
            },
            fontFamily: {
                sora: ['Sora', 'sans-serif'],
                noto: ['Noto Sans', 'sans-serif']
            }
        }
    }
}
