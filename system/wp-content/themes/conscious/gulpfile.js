'use strict';

var gulp        = require('gulp');
var compass     = require('gulp-compass');
var SCSS_FILE   = './scss/**/*.scss';


/*
 * Compass task
 */
gulp.task('compass',function(){
  gulp.src([SCSS_FILE])
    .pipe(compass({
      config_file : 'config.rb',
      comments : false,
      css : 'css/',
      sass: 'scss/'
    }));
});


/*
 * Watch task
 */
gulp.task('watch',function(){
  gulp.watch(SCSS_FILE, function(event){
    gulp.run('compass');
  });
});
