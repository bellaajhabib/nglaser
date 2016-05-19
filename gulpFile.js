
var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var webroot = 'src/AppBundle/Resources/public/';
 
gulp.task('login-sass', function () {
  gulp.src(webroot + 'sass/login.scss')
    .pipe(concat('login.css'))
    .pipe(sass({outputStyle: 'compressed'}))
    .pipe(gulp.dest('./web/css'));
});

gulp.task('login-js', function() {
    
    gulp.src([
        webroot + 'js/thirdparty/html5shiv/dist/html5shiv.min.js', 
        webroot + 'js/thirdparty/respond/dest/respond.min.js',
        webroot + 'js/thirdparty/jquery/dist/jquery.min.js',
        webroot + 'js/thirdparty/bootstrap/dist/js/bootstrap.min.js'
    ])
        .pipe(uglify({}))  
        .pipe(concat('login.js'))
        .pipe(gulp.dest('./web/js'));
});


gulp.task('login',['login-sass', 'login-js']);

gulp.task('website-sass', function () {
  gulp.src(webroot + 'sass/style.scss')
    .pipe(concat('style.css'))
    .pipe(sass({outputStyle: 'compressed'}))
    .pipe(gulp.dest('./web/css'));
});