const gulp = require('gulp');
var sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass');
var livereload = require('gulp-livereload');
var autoprefixer = require('gulp-autoprefixer');
var importer = require('node-sass-globbing');

var sass_config = {
  importer : importer
};


gulp.task('sass', function () {
  gulp.src('public/libs/scss/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass(sass_config).on('error', sass.logError))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('public/libs/css'));
});

//Type "gulp" on the command line to watch file changes
gulp.task('default', function(){ 
    gulp.watch('./public/libs/scss/**/*.scss', ['sass']);
  
});
