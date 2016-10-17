const gulp = require('gulp');
const less = require('gulp-less');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const organiser = require('gulp-organiser');

module.exports = organiser.register((task) => {
  gulp.task(task.name, () => {
    gulp.src(task.src)
    .pipe(sourcemaps.init())
    .pipe(less())
    .pipe(postcss([autoprefixer({ browsers: ['last 15 versions'] })]))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(task.dest));
  });
});
