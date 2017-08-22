var gulp = require('gulp');
var bower = require('gulp-bower');
var elixir = require('laravel-elixir');

gulp.task('bower', function() {
    return bower();
});

var paths = {
    'jquery': 'assets/bower/jquery/dist',
    'bootstrap': 'assets/bower/bootstrap/dist',
    'bootswatch': 'assets/bower/bootswatch/journal',
    'fontawesome': 'assets/bower/font-awesome',
    'dataTables': 'assets/bower/datatables/media',
    'dataTablesBootstrap3Plugin': 'assets/bower/datatables-bootstrap3-plugin/media',
    'flag': 'assets/bower/flag-sprites/dist',
    'metisMenu': 'assets/bower/metisMenu/dist',
    'datatablesResponsive': 'assets/bower/datatables-responsive',
    'select2': 'assets/bower/select2/dist',
    'jquery_ui':  'assets/bower/jquery-ui',
    'select2BootstrapTheme':  'assets/bower/select2-bootstrap-theme/dist',
    'kartikv': 'assets/bower/kartik-v/bootstrap-fileinput',
    'toggle': 'assets/bower/bootstrap-toggle',
    'slider': 'assets/bower/seiyria-bootstrap-slider/dist',
    'dropzone': 'assets/bower/dropzone-4.3.0/dist'
};

elixir.config.sourcemaps = false;

elixir(function(mix) {

    // Run bower install
    mix.task('bower');

    // Copy fonts straight to public
    mix.copy('resources/' + paths.bootstrap + '/fonts/bootstrap/**', 'public/fonts');
    mix.copy('resources/' + paths.fontawesome + '/fonts/**', 'public/fonts');

    // Copy images straight to public
    mix.copy('resources/' + paths.jquery_ui + '/themes/base/images/**', 'public/css/images');


    // Copy flag resources
    mix.copy('resources/' + paths.flag + '/css/flag-sprites.min.css', 'public/css/flags.css');
    mix.copy('resources/' + paths.flag + '/img/flags.png', 'public/img/flags.png');

    // Merge Site CSSs.
    mix.styles([
        '../../' + paths.bootstrap + '/css/bootstrap.css',
        '../../' + paths.bootstrap + '/css/bootstrap-theme.css',
        '../../' + paths.fontawesome + '/css/font-awesome.css',
        '../../' + paths.bootswatch + '/bootstrap.css',
        '../../' + paths.select2 + '/css/select2.css',
        '../../' + paths.select2BootstrapTheme + '/select2-bootstrap.css',
        '../../' + paths.kartikv + '/css/fileinput.css',
        '../../' + paths.toggle + '/css/bootstrap2-toggle.min.css',
        '../../' + paths.slider + '/css/bootstrap-slider.css',
        '../../' + paths.dropzone + '/dropzone.css',
        'main.css',
        'star-rating.css'
    ], 'public/css/site.css');

    // Merge Site scripts.
    mix.scripts([
        '../../' + paths.jquery + '/jquery.js',
        '../../' + paths.jquery_ui + '/ui/jquery.ui.core.js',
        '../../' + paths.bootstrap + '/js/bootstrap.js',
        '../../' + paths.select2 + '/js/select2.js',
        '../../' + paths.kartikv + '/js/fileinput.js',
        '../../' + paths.toggle + '/js/bootstrap-toggle.min.js',
        '../../' + paths.slider + '/bootstrap-slider.js',
        'dropdown-toggle.js',
        'dropzone.js',
        'tinymce.min.js',
        'star-rating.js',
        'google-analitics.js'
    ], 'public/js/site.js');

    // Merge Admin CSSs.
    mix.styles([
        '../../' + paths.bootstrap + '/css/bootstrap.css',
        '../../' + paths.jquery_ui + '/themes/base/jquery.ui.all.css',
        '../../' + paths.bootstrap + '/css/bootstrap-theme.css',
        '../../' + paths.fontawesome + '/css/font-awesome.css',
        '../../' + paths.bootswatch + '/bootstrap.css',
        '../../' + paths.dataTables + '/css/dataTables.bootstrap.css',
        '../../' + paths.dataTablesBootstrap3Plugin + '/css/datatables-bootstrap3.css',
        '../../' + paths.metisMenu + '/metisMenu.css',
        '../../' + paths.select2 + '/css/select2.css',
        'sb-admin-2.css'
    ], 'public/css/admin.css');

    // Merge Admin scripts.
    mix.scripts([
        '../../' + paths.jquery + '/jquery.js',
        '../../' + paths.jquery_ui + '/ui/jquery.ui.core.js',
        '../../' + paths.bootstrap + '/js/bootstrap.js',
        '../../' + paths.dataTables + '/js/jquery.dataTables.js',
        '../../' + paths.dataTables + '/js/dataTables.bootstrap.js',
        '../../' + paths.dataTablesBootstrap3Plugin + '/js/datatables-bootstrap3.js',
        '../../' + paths.datatablesResponsive + '/js/dataTables.responsive.js',
        '../../' + paths.metisMenu + '/metisMenu.js',
        '../../' + paths.select2 + '/js/select2.js',
        'bootstrap-dataTables-paging.js',
        'dropzone.js',
        'dataTables.bootstrap.js',
        'datatables.fnReloadAjax.js',
        'sb-admin-2.js'
    ], 'public/js/admin.js');

});
