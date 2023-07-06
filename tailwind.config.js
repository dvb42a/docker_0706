/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        darkText: '#1C2833',
        primary: '#113051',
        lightPrimary: '#1d518a',
        success: 'hsl(152, 52%,  52%)',
        danger: 'hsl(348, 80%, 56%)',
      },
      fontFamily: {
        poppins: ["Poppins", "Noto Sans TC", "sans-serif"],
      },
    },
  },
  plugins: [
  ],
}

