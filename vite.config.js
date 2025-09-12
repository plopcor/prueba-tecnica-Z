import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        // tailwindcss(),
        vue(),
    ],
    server: { // Exponer al host de docker
        host: true,
        port: 8500,
        hmr: {
            host: 'localhost'
        },
    }
});
