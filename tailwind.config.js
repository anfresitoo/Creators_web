/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        'neon-cyan': '#00f3ff',
        'neon-magenta': '#ff00ff',
        'neon-green': '#39ff14',
        'dark-bg': '#0a0a0a',
        'dark-panel': '#171717',
        'dark-border': '#262626',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
};
