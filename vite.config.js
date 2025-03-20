import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import path from 'path';

export default defineConfig({
    plugins: [
        react(),
        laravel({
            input: ['resources/js/app.tsx', "resources/css/app.css"], // Ensure this matches your main TSX entry file
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/js"), // Ensure alias is correct
        },
        extensions: ['.js', '.jsx', '.ts', '.tsx'],
    },
});
