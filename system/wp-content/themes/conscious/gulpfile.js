'use strict';

var gulp    = require('gulp');
var compass = require('gulp-compass');
var rename  = require('gulp-rename');
var uglify  = require('gulp-uglify');

var config = {
  style: {
    src: './scss/**/*.scss'
  },
  script: {
    src: './js/main.js'
  }
}

gulp.task('compass',function(){
  gulp.src(config.style.src)
    .pipe(compass({
      config_file : 'config.rb',
      comments : false,
      css : 'css/',
      sass: 'scss/'
    }));
});

gulp.task('script', function () {
  gulp.src(config.script.src)
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest('js'));
});

gulp.task('watch',function(){
  gulp.watch(config.style.src, function(event){
    gulp.run('compass');
  });
  gulp.watch(config.script.src, function(event){
    gulp.run('script');
  });
});
