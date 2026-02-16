import daisyui from "daisyui";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    plugins: [daisyui],
    daisyui: {
        themes: ["light", "dark", "corporate", "cupcake"],
    },
};
