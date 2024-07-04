import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/dropzone.css",
                "resources/js/app.js",
                "resources/js/dropzone.js",
                "resources/js/alert.js",
            ],
            /* input: ["resources/css/app.css", "resources/js/app.js"], */
            refresh: true,
        }),
    ],
});
