var gulp = require('gulp');
var concat = require('gulp-concat');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var minify = require('gulp-minify-css');
var imagemin = require('gulp-imagemin');
 
//Image Optimize Tasks
gulp.task('image-Optimize', function() {
    gulp.src('src/images/*')
    .pipe(imagemin())
    .pipe(gulp.dest('dest/images'));
 });

//SASS compile to CSS & Minify
gulp.task('css', function() {
    return gulp.src('src/scss/**/*.scss')
        .pipe(sass()) // Converts Sass to CSS with gulp-sass
        .pipe(minify())
        .pipe(gulp.dest('dest/css'));
});

//JavaScript Minify
gulp.task('js', function() {
    return gulp.src('src/js/*.js')
        .pipe(uglify())
        .pipe(gulp.dest('dest/js/'));
});

gulp.task('watch', function() {
    gulp.watch('src/scss/**/*.scss', gulp.series('css'));
    gulp.watch('src/js/*.js', gulp.series('js'));
    gulp.watch('src/images/*', gulp.series('image-Optimize'));
});