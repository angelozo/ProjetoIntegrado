var gulp        = require('gulp');
var sass        = require('gulp-sass');
var bs          = require('browser-sync').create();

gulp.task('serve', ['sass'], function() {
    bs.init({
        server: {
            baseDir: "./"
        }
    });
});

gulp.task('watch', ['browser-sync'], function () {
    gulp.watch("./sass/**/*.scss", ['sass']);
});

gulp.task('sass', function () {
  return gulp.src('./sass/**/*.scss')
    .pipe(sass.sync().on('error', sass.logError))
    .pipe(gulp.dest('./css'))
    .pipe(bs.reload({stream: true}));
});

gulp.task('sass:watch', function () {
  gulp.watch('./sass/**/*.scss', ['sass']);
});

gulp.task('default', ['sass:watch', 'sass', 'serve']);
