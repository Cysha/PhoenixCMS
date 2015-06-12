/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

module.exports = {
    "themePublish": function (elixir, gulp, shell, themeInfo) {
        elixir.extend('themePublish', function() {
            gulp.task('themePublish', ['less', 'scripts'], function() {
                gulp.src('').pipe(shell('php ../../artisan theme:publish '+themeInfo.name));
            });

            this.registerWatcher('themePublish', '**/*.less');

            return this.queueTask('themePublish');
        });
    },

    "setConfig": function (elixir, gulp, shell, themeInfo) {
        elixir.config.publicDir = '../../public';
        elixir.config.cssOutput = 'assets/css';
        elixir.config.jsOutput = 'assets/js';
    }
}
