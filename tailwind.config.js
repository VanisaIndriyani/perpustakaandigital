/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './app/Filament/**/*.php',
    './vendor/filament/**/*.blade.php',
  ],
  theme: {
    extend: {
      boxShadow: {
        soft: '0 10px 30px -18px rgb(2 6 23 / 0.25)',
      },
    },
  },
  plugins: [],
}
