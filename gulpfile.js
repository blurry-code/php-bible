'use strict';
var gulp = require('gulp');
var livereload = require('gulp-livereload');
var open = require('gulp-open');
var connect = require('gulp-connect-php');
var livereload = require('gulp-livereload');


var EXPRESS_PORT = 8000;
var EXPRESS_ROOT = __dirname;
var LIVERELOAD_PORT = 35729;
var lr;
 
function startExpress() {
  var express = require('express');
  var app = express();
  app.use(require('connect-livereload')());
  app.use(express.static(EXPRESS_ROOT));
  app.listen(EXPRESS_PORT);
}

gulp.task('html', function() {
     gulp.src('*.html')
       .pipe(livereload());
    gulp.src('templates/*.html')
       .pipe(livereload());
});

gulp.task('php', function() {
     gulp.src('*.php')
       .pipe(livereload());
    gulp.src('php/*.php')
       .pipe(livereload());
});

gulp.task('scripts', function() {
     gulp.src('js/**/*.js')
       .pipe(livereload());
}); 

gulp.task('connect', function() {
    var app = connect.server({base:'.', livereload:true});
});


// Default task that will be run
// when no parameter is provided
// to gulp
gulp.task('default', ['html','connect'],function () {
    livereload.listen();
    gulp.watch('js/**/*.js',['scripts']);
    gulp.watch('*.html',['html']);
    gulp.watch('templates/*.html',['html-templates']);
    gulp.watch('*.php',['php']);
    gulp.watch('php/*.php',['php']);
    
 //   startExpress();
    gulp.src('')
        .pipe(open({app: 'chrome', uri: 'http://localhost:8000'}));
});





//
//var httpProxy = require('http-proxy');
//var connect = require('gulp-connect-php');
//var browserSync = require('browser-sync');
//gulp.task('php-serve', [], function () {
//connect.server({
//    port: 9001,
//    base: '.',
//    open: false
//});
//
//var proxy = httpProxy.createProxyServer({});
//
//browserSync({
//    notify: false,
//    port  : 9000,
//    server: {
//        baseDir   : ['example'],
//    },
//    open:false
//});
//
//// watch for changes
//gulp.watch([
//    '*.html',
//    '*.php',
//    'scripts/**/*.js',
//    'images/**/*',
//    '.tmp/fonts/**/*'
//]).on('change', reload);
//
//gulp.watch('app/styles/**/*.scss', ['styles']);
//gulp.watch('app/fonts/**/*', ['fonts']);
//gulp.watch('bower.json', ['wiredep', 'fonts']);
//});
//
//var reload = function () {
//    
//}
