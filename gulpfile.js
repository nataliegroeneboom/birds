const gulp = require('gulp');
var sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass');
var livereload = require('gulp-livereload')


gulp.task('sass', function () {
  gulp.src('public/libs/scss/*.scss')
//    .pipe(plumber())
  //  .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
//    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('public/libs/css'));
});

//Type "gulp" on the command line to watch file changes
gulp.task('default', function(){
  livereload.listen();
    gulp.watch('./public/libs/scss/*.scss', ['sass']);
//    gulp.watch('./src/js/*.js', ['uglify']);
    gulp.watch(['./public/libs/css/*.css'], function (files){
      livereload.changed(files)
    });
});
