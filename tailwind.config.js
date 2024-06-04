/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './vendor/awcodes/filament-tiptap-editor/resources/**/*.blade.php'
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
}

