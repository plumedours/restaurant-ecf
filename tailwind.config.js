/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './templates/**/*.{twig,html.twig}',
    './assets/js/**/*.{js,jsx,ts,tsx,vue}',
    './node_modules/flowbite/**/*.js'
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
}
