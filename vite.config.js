import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';


export default defineConfig({
    plugins: [
        laravel({
            // server: {
            //     hmr: {
            //         host: 'localhost:8000',
            //     },
            // },
            publicDir: 'public',
            build: {
                minify: true,
            },
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/oreho/bootstrap.min.css',
                'resources/oreho/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
                'resources/oreho/plugins/fontawesome-free/css/fontawesome.min.css',
                'resources/oreho/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
                'resources/oreho/select2.min.css',
                'resources/oreho/plugins/fontawesome-free/css/all.min.css',
                'resources/oreho/dist/css/skins/_all-skins.min.css',
                'resources/oreho/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
                'resources/oreho/dist/css/adminlte.min.css',
                'resources/oreho/my.css',
                'resources/oreho/plugins/jquery-ui/jquery-ui.min.js',
                // 'resources/oreho/ckeditor/adapters/jquery.js',
                // 'resources/oreho/assets/vendor/ckeditor5/build/ckeditor.js',

                'resources/oreho/my.js',
                'resources/oreho/dist/img/AdminLTELogo.png',
                'resources/oreho/dist/img/user1-128x128.jpg',
                'resources/oreho/dist/img/user8-128x128.jpg',
                'resources/oreho/dist/img/user3-128x128.jpg',
                'resources/oreho/dist/img/Northern_ Lights.jpg',
                'resources/oreho/dist/img/user.jpg',
                'resources/oreho/dist/img/lock.jpg',
                'resources/oreho/dist/img/1-interior-8.jpg',
                'resources/oreho/dist/img/interior-1.jpg',
                'resources/oreho/dist/img/No_image.png',
                'resources/oreho/dist/img/search.png',
            ],
            refresh: true,
        }),
    ],
});
