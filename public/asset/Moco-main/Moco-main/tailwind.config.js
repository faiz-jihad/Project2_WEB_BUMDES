/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js}"],
  theme: {
    extend: {
      colors: {
        primary: '#FF801A',
      },
      backgroundImage: {
        'liburan': "url('./img/Liburan.png')",
      },
    },
  },
  plugins: [],
};
