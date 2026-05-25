import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            hotFile: 'storage/vite.hot',
            input: [
                'resources/css/app.css',
                'resources/css/fonts-optional.css',
                'resources/css/icons.css',
                'resources/css/auth.css',
                'resources/css/contact-cards.css',
                'resources/css/footer.css',
                'resources/css/welcome.css',
                'resources/css/contatti.css',
                'resources/css/articles/listing.css',
                'resources/css/articles/single.css',
                'resources/css/articles/editor.css',
                'resources/css/articles/category.css',
                'resources/js/app.js',
                'resources/js/auth-password-toggle.js',
                'resources/js/auth-profile-image-preview.js',
                'resources/js/article-editor.js',
                'resources/js/contact-card-professionals.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        minify: 'terser',
        cssCodeSplit: true,
        terserOptions: {
            compress: {
                passes: 2,
            },
            format: {
                comments: false,
            },
        },
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (!id.includes('node_modules')) {
                        return;
                    }

                    if (id.includes('bootstrap/js/dist')) {
                        return 'vendor-bootstrap';
                    }

                    if (id.includes('axios')) {
                        return 'vendor-axios';
                    }
                },
            },
        },
    },
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
