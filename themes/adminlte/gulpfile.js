var gulp = require('gulp');
var less  = require('gulp-less');
var minifycss = require('gulp-minify-css');
var rename = require('gulp-rename');
var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var flatten = require('gulp-flatten');
var imagemin = require('gulp-imagemin');
var notify = require('gulp-notify');
var cache = require('gulp-cache');
var livereload = require('gulp-livereload');

gulp.task('dependencies-js', function() {
    return gulp.src([
            'assets/js/src/application.js',
            'assets/js/src/dashboard-view.js',
        ])
        .pipe(concat('dependencies.js'))
        .pipe(gulp.dest('assets/js'))
        .pipe(notify({ message: 'Dependencies JS task complete' }));
});

gulp.task('theme', function() {
    return gulp.src('assets/css/less/style.less')
        .pipe(less())
        .on('error', swallowError)
        .pipe(autoprefixer('last 10 version'))
        .pipe(gulp.dest('assets/css'))
        .pipe(rename({suffix: '.min'}))
        .pipe(minifycss())
        .pipe(gulp.dest('assets/css'))
        .pipe(livereload())
        .pipe(notify({ message: 'eBullion Theme styles built' }));
});

gulp.task('dependencies', ['dependencies-js']);
gulp.task('build', ['dependencies', 'theme']);

// add a watcher in for the theme less files
gulp.task('watch', function() {
    livereload.listen();

    gulp.watch('assets/css/**/*.less', ['theme']);
    gulp.watch('assets/css/less/variables.less', ['theme']);

    gulp.watch('assets/js/src/*.js', ['dependencies-js']);
});


function swallowError (error) {
    //If you want details of the error in the console
    console.log(error.toString());
    this.emit('end');
}
