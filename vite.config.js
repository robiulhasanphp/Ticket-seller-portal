import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import colors from "tailwindcss/colors";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/nanobar.js'
            ],
            refresh: true,
        }),
    ],
});


