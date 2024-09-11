/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: ['variant', [
        '@media (prefers-color-scheme: dark) { &:not(.light *) }',
        '&:is(.dark *)',
    ]],
    theme: {
        extend: {},
    },
    plugins: [],
}

