/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.antlers.html',
        './resources/**/*.antlers.php',
        './resources/**/*.blade.php',
    ],

    theme: {
        extend: {
            "colors": {
                'alt-grey' : '#3C3C3C',
            }
        },
    },

    plugins: [
        require('@tailwindcss/typography'),
    ],
};
