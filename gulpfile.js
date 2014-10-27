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

// bootstrap
gulp.task('bootstrap-mix', function(){
    gulp.src('app/assets/less/bootstrap.less')
        .pipe(less())
        .pipe(rename({basename: 'bootstrap-mix'}))
        .pipe(gulp.dest('public/assets/css'))
        .pipe(rename({suffix: '.min'}))
        .pipe(minifycss())
        .pipe(gulp.dest('public/assets/css'))
        .pipe(notify({ message: 'Bootstrap-mix CSS task complete' }));

    gulp.src([
            'app/assets/vendor/jquery/dist/jquery.js',
            'app/assets/vendor/bootstrap/dist/js/bootstrap.js',
            'app/assets/vendor/jasny-bootstrap/dist/js/jasny-bootstrap.js'
        ])
        .pipe(concat('bootstrap-mix.js'))
        .pipe(uglify())
        .pipe(gulp.dest('public/assets/js'))
        .pipe(notify({ message: 'Bootstrap-mix JS task complete' }));
});

// Copy all fonts from app/assets to public/assets
gulp.task('copy-fonts', function() {
    gulp.src('app/assets/vendor/**/*.{ttf,woff,eof,svg}')
        .pipe(flatten())
        .pipe(gulp.dest('public/assets/fonts'))
        .pipe(notify({ message: 'Fonts task complete' }));
});

// Copy all images from app/assets to public/assets
//gulp.task('images', function() {
//    gulp.src('app/assets/images/**/*.{png,jpg,jpeg,gif}')
//        .pipe(imagemin({ optimizationLevel: 5, progressive: true, interlaced: true }))
//        .pipe(gulp.dest('public/assets/img'))
//        .pipe(notify({ message: 'Images task complete' }));
//});

// run gulp build
gulp.task('build', ['bootstrap-mix', 'copy-fonts']);

gulp.task('default', ['build']);
