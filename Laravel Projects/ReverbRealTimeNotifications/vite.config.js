import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
            hmr: true, // Enable Hot Module Replacement (HMR)
            hmrOptions: {
                host: 'localhost', // Set the host to enable HMR across multiple browser windows
            },
        }),
    ],
});
