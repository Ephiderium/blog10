/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",     // если используешь Blade
    "./resources/js/**/*.js",         // обычные JS-файлы
    "./resources/js/**/*.vue",        // ← ВАЖНО! Vue-компоненты
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
