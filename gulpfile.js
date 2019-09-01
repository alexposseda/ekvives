const gulp = require('gulp');
const uglify = require('gulp-uglify');
const sass = require('gulp-sass');
const browserSync = require('browser-sync');
const csso = require('gulp-csso');
const concat = require('gulp-concat');
const rename = require('gulp-rename');
// const sourcemaps = require('gulp-sourcemaps');


gulp.task('buildCSS', function(){
    return gulp.src('resources/assets/sass/style.scss')
 
    .pipe(sass())
    .pipe(csso({
        sourceMap: true,
            debug: true
    }))
    .pipe(rename({suffix: '.min'}))
    // .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('public/css/'))
    .pipe(browserSync.reload({
        stream: true
    }));
});
gulp.task('browserSync', function () {
    browserSync.init({
        server: {
            baseDir: 'public/'
        }
    });
});

gulp.task('minifyJS', function () {
    gulp.src(['resources/assets/js/from_js/tether.js','resources/assets/js/from_js/jquery-2.2.4.min.js','resources/assets/js/from_js/jquery-ui.min.js','resources/assets/js/from_js/bootstrap.min.js','resources/assets/js/from_js/jquery-plugin-collection.js','resources/assets/js/from_js/revolution-slider/js/jquery.themepunch.tools.min.js','resources/assets/js/from_js/revolution-slider/js/jquery.themepunch.revolution.min.js'])
        .pipe(concat('all.js'))
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('public/js/'));
});
gulp.task('concatJS', function () {
    gulp.src(['resources/assets/js/from_js/jquery-plugin-collection.js','resources/assets/js/from_js/revolution-slider/js/jquery.themepunch.tools.min.js','resources/assets/js/from_js/revolution-slider/js/jquery.themepunch.revolution.min.js'])
        .pipe(concat('all.js'))
        .pipe(gulp.dest('public/js/'));
});

gulp.task('watch', [ 'buildCSS', 'minifyJS', 'browserSync'], function() {
    gulp.watch('resources/assets/sass/*.scss', ['buildCSS']); // Наблюдение за sass файлами
    gulp.watch('public/*.html', browserSync.reload); // Наблюдение за HTML файлами в корне проекта
    gulp.watch('resources/assets/js/**/*.js', ['minifyJS']); // Наблюдение за JS файлами в папке js
});