
//Admin
mix.js('resources/admin/js/app.js', 'public/vendor/admin/js').extract()
    .sass('resources/admin/sass/app.scss', 'public/vendor/admin/css')
    .copy('resources/admin/images/', 'public/vendor/admin/images');

if (mix.config.inProduction) {
    mix.version();
}
