import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'public/css/open-iconic-bootstrap.min.css',
                'public/css/animate.css',
                'public/css/owl.carousel.min.css',
                'public/css/owl.theme.default.min.css',
                'public/css/magnific-popup.css',
                'public/css/aos.css',
                'public/css/ionicons.min.css',
                'public/css/bootstrap-datepicker.css',
                'public/css/jquery.timepicker.css',
                'public/css/flaticon.css',
                'public/css/icomoon.css',
                'public/css/style.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
