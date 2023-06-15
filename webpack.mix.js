const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.styles([
    'resources/css/google-fonts.css',
    'resources/lib/font-awesome/css/all.css',
    'resources/lib/font-awesome/css/v4-shims.css',

    'resources/css/nucleo-icons.css',
    'resources/css/nucleo-svg.css',
    'resources/lib/dropzone/dropzone.css',
    'resources/lib/fancybox/fancybox.css',
    'resources/lib/flatpickr/flatpickr.min.css',

    'resources/lib/fullcalendar/main.min.css',
    'resources/lib/select2/css/select2.css',
    'resources/lib/datatable/datatables.css',
    'resources/css/soft-ui-dashboard.css',
    'resources/lib/jkanban/jkanban.css',

    'resources/css/misc.css',

], 'public/css/app.css');

mix.scripts([
    'resources/js/jquery.min.js',
    'resources/js/popper.min.js',
    'resources/js/bootstrap.min.js',
    'resources/lib/dropzone/dropzone.js',
    'resources/lib/fancybox/fancybox.umd.js',
    'resources/lib/flatpickr/flatpickr.js',
    'resources/lib/fullcalendar/main.min.js',
    'resources/lib/select2/js/select2.full.js',
    'resources/lib/masonry.pkgd.min.js',
    'resources/js/soft-ui-dashboard.js',
    'resources/lib/datatable/datatables.js',
    'resources/lib/jkanban/jkanban.js',
    'resources/js/app.js',
],'public/js/app.js');

mix.scripts([
    'resources/lib/literallycanvas/js/react-with-addons.js',
    'resources/lib/literallycanvas/js/react-dom.js',
    'resources/lib/literallycanvas/js/literallycanvas.js',
],'public/lib/canvas/js/canvas.min.js')
