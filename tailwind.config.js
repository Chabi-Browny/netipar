/** @type {import('tailwindcss').Config} */
module.exports = {
//  content: ["./resources/views/*.{html,blade.php,js}"],
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
      ],
    theme: {
        extend: {},
    },
    plugins: [],
}
