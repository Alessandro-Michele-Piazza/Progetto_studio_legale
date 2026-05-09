import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/auth.css',
                'resources/css/contact-cards.css',
                'resources/js/app.js',
                'resources/js/auth-password-toggle.js',
                'resources/js/article-editor.js',
                'resources/js/contact-card-professionals.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
