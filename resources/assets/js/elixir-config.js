/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 |
 */

module.exports = {
    "setConfig": function (elixir, gulp, themeInfo) {
        elixir.config.publicDir = '../../public';
        elixir.config.cssOutput = 'assets/css';
        elixir.config.jsOutput = 'assets/js';
        elixir.config.sourcemaps = true;
    }
}
