'use strict';

var gulp = require('gulp');
var runSequence = require('run-sequence');
var $ = require('gulp-load-plugins')();

var config = {
  style: {
    src: './scss/**/*.scss'
  },
  script: {
    src: './js/main.js'
  }
}

gulp.task('style', function () {
  return gulp.src(config.style.src)
    .pipe($.plumber())
    .pipe($.sourcemaps.init())
    .pipe($.sass())
    .pipe($.autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe($.sourcemaps.write('.', {
      includeContent: false,
      sourceRoot: '.'
    }))
    .pipe(gulp.dest('css'));
});

gulp.task('minify', function () {
  return gulp.src('./scss/main.scss')
    .pipe($.plumber())
    .pipe($.sourcemaps.init())
    .pipe($.sass())
    .pipe($.cssnano())
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.sourcemaps.write('.', {
      includeContent: false,
      sourceRoot: '.'
    }))
    .pipe(gulp.dest('css'));
});

gulp.task('uglify', function () {
  return gulp.src(config.script.src)
    .pipe($.plumber())
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.uglify())
    .pipe(gulp.dest('js'));
});

gulp.task('watch', function (){
  $.watch(config.style.src, function (event){
    gulp.run(['style', 'minify']);
  });
  $.watch(config.script.src, function (event){
    gulp.run('uglify');
  });
});

gulp.task('default', ['watch']);
