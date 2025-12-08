import tailwindcss from "@tailwindcss/vite";

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    compatibilityDate: "2025-07-15",
    devtools: { enabled: true },
    css: ["~/assets/css/main.css"],
    vite: {
        plugins: [tailwindcss()],
    },
    modules: ["@nuxt/eslint", "@nuxt/icon", "@nuxtjs/google-fonts"],

    googleFonts: {
        families: {
            "Plus Jakarta Sans": [400, 500, 600, 700, 800],
            Inter: [400, 500, 600, 700],
        },
        display: "swap",
        preload: true,
    },
});
