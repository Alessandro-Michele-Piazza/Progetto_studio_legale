import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
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
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
