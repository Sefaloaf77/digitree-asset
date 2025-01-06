const defaultTheme = require("tailwindcss/defaultTheme");
const forms = require("@tailwindcss/forms");

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
    "assets/js/**/*.js",
  ],
  darkMode: "class",
  theme: {
    container: {
      center: true,
      padding: "1rem",
    },
    extend: {
      fontFamily: {
        sans: ["Manrope", "Figtree", ...defaultTheme.fontFamily.sans],
        manrope: {
          regular: ["Manrope-Regular", "sans-serif"],
          medium: ["Manrope-medium", "sans-serif"],
          semibold: ["Manrope-semibold", "sans-serif"],
          bold: ["Manrope-bold", "sans-serif"],
          extrabold: ["Manrope-extrabold", "sans-serif"],
          black: ["Manrope-black", "sans-serif"],
        },
      },
      colors: {
        transparent: "transparent",
        current: "currentColor",
        white: "#ffffff",
        primary: "#267DFF",
        purple: "#7B6AFE",
        pink: "#FF51A4",
        orange: "#FF7C51",
        success: "#00D085",
        warning: "#FFC41F",
        danger: "#FF3232",
        dark: "#050C17",
        gray: "#7780A1",
        lightgray: "#5A6383",
        "dark-2": "#8A99AF",
        "green-digitree": "#00A859",
        "blue-btn": "#2663FF",
        "red-btn": "#DD2A56",
      },
    },
  },
  plugins: [
    require("@tailwindcss/forms")({
      strategy: "base",
    }),
    require("tailwind-scrollbar"),
    forms,
    // require("daisyui"), // Uncomment if you want to use DaisyUI
  ],
};
