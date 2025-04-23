/** @type {import('tailwindcss').Config} */
export default {
    prefix: 'alt-admin-bar-',
    content: [
        './resources/**/*.antlers.html',
        './resources/**/*.antlers.php',
        './resources/**/*.blade.php',
    ],
    theme: {
        extend: {
            backgroundSize: {
                '400': '400% 100%',
            },
            keyframes: {
                'gradient-x': {
                    '0%, 100%': { backgroundPosition: '0% 50%' },
                    '50%': { backgroundPosition: '100% 50%' },
                }
            },
            animation: {
                'gradient-x': 'gradient-x 5s ease infinite',
            }
        },
    },
};
