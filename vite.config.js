import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue2';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/alt-admin-bar.css',
            ],
            publicDirectory: 'resources/dist',
        }),
        vue(),
    ],
});
