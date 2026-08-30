/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './app/Livewire/**/*.php',
        './app/Http/Livewire/**/*.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            },
            colors: {
                brand: {
                    blue: '#2E2F7F',
                    pink: '#E63E8C',
                    light: '#F8F9FC',
                    dark: '#15173F',
                    soft: '#EEF1FF',
                    mist: '#FFF0F7',
                },
            },
            boxShadow: {
                glow: '0 24px 70px rgba(46, 47, 127, 0.14)',
                card: '0 18px 45px rgba(46, 47, 127, 0.1)',
            },
        },
    },
    plugins: [],
};
