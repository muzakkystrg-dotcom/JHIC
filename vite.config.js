import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/chatbot.js',
                'resources/js/jurufind.js',
                'resources/js/ppdb.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        // Pisahkan pustaka pihak ketiga dari kode aplikasi agar:
        //  - browser bisa meng-cache vendor secara terpisah (jarang berubah)
        //  - Chart.js (~200 KB) hanya diunduh di halaman yang memakainya
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        if (id.includes('chart.js')) return 'chart';
                        if (id.includes('lucide')) return 'lucide';
                        if (id.includes('aos')) return 'aos';
                    }
                },
            },
        },
        // Naikkan sedikit batas agar tidak berisik; aset kita memang kecil.
        chunkSizeWarningLimit: 900,
    },
});
