import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        // Mengaktifkan minifikasi untuk CSS dan JS
        minify: 'terser',
        // Mengoptimalkan ukuran bundle
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['aos'],
                    utils: ['axios']
                }
            }
        },
        // Mengaktifkan kompresi
        terserOptions: {
            compress: {
                drop_console: true,
                drop_debugger: true
            }
        },
        // Mengaktifkan chunking untuk performa yang lebih baik
        chunkSizeWarningLimit: 1000,
        // Mengoptimalkan CSS
        cssCodeSplit: true
    },
    optimizeDeps: {
        include: ['axios', 'aos']
    }
});
